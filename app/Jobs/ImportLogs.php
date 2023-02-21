<?php

namespace App\Jobs;

use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class ImportLogs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;
    /**
     * Determine the timeout for this job.
     *
     * @var int
     */
    public $timeout = 86400;
    /**
     * Log directory path
     *
     * @var string
     */
    protected $LogPath;

    /**
     * Create a new job instance.
     */
    public function __construct(string $LogPath)
    {
        $this->LogPath = $LogPath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->importLogs();
    }

    /**
     * @return void
     */
    private function importLogs()
    {
        try {
            $handle = fopen($this->LogPath, "r");
            $lines = [];
            $count = 0;
            $insertChunkSize = 500;


            if ($handle) {
                while (!feof($handle)) {
                    $line = fgets($handle);
                    $count++;
                    $matches = $this->parsLog($line);
                    $lines[] = [
                        'service_name' => $matches[1],
                        'date' => Carbon::createFromFormat('d/M/Y:H:i:s', $matches[2])->toDateTimeString(),
                        'http_method' => $matches[3],
                        'method' => $matches[4],
                        'http_version' => $matches[5],
                        'status_code' => $matches[6],
                    ];

                    if ($count === $insertChunkSize) {
                        Log::insert($lines);
                        $lines = [];
                        $count++;
                    }
                }

                // if anything is remaining after the last loop we still need to save it
                if (count($lines) > 0) {
                    Log::insert($lines);
                }
            }
        } catch (Throwable $throwable) {
            \Illuminate\Support\Facades\Log::error($throwable);
            throw $throwable;
        }
    }

    /**
     * parsing log with regex
     *
     * @param string $log
     * @return mixed
     */
    private function parsLog(string $log)
    {
        $pattern = '/^(.*?)\-service - \[(.*?)\] "(POST|GET|PUT|PATCH|DELETE) (\/.*?) (HTTP\/\d+\.\d)" (\d{3})/';
        preg_match($pattern, $log, $matches);
        return $matches;
    }
}
