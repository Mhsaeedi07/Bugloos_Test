<?php

namespace App\Http\Controllers;


use App\Models\Log;
use Illuminate\Http\Request;
use App\Services\LogService;


class LogController extends Controller
{

    /**
     * @var LogService
     */
    private $logService;

    /**
     * @param LogService $logService
     */
    public function __construct(LogService $logService)
    {
        $this->logService = $logService;

    }

    /**
     * Number of logs
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function count(Request $request)
    {
        $query = Log::query();
        $query = $this->logService->applyFilters($query);
        return response()->json([
            'count' => $query->count()
        ]);
    }
}
