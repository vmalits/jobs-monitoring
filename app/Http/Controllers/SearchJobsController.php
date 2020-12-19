<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Vacansy;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class SearchJobsController extends Controller
{
    public function index()
    {
        return view('jobs.jobs');
    }

    public function search(): JsonResponse
    {
        $jobs = QueryBuilder::for(Vacansy::class)
            ->allowedFilters(['position', 'salary'])
            ->get();
        return response()->json($jobs);
    }
}
