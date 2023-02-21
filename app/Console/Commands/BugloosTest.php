<?php

namespace App\Console\Commands;

use App\Jobs\ImportLogs;
use Illuminate\Console\Command;

class BugloosTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Bugloos:log {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read file and store in DB:)';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        $path = $this->option('path') ?? storage_path('app/logs.txt');
        ImportLogs::dispatch($path);
    }
}
