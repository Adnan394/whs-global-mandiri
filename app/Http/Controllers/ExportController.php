<?php

namespace App\Http\Controllers;

use App\Exports\CrewExport;
use App\Exports\ShipsExport;
use Illuminate\Http\Request;
use App\Exports\CrewingExport;
use App\Exports\CrewListsExport;
use App\Exports\UserLamaransExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportCrew(Request $request)
    {
        $filters = $request->only(['rank_id', 'status']);
        return Excel::download(new CrewExport($filters), 'crew.xlsx');
    }

    public function exportCrewing(Request $request)
    {
        $filters = $request->only(['rank_id', 'status']);
        return Excel::download(new CrewingExport($filters), 'crewing.xlsx');
    }

    public function exportShip(Request $request)
    {
        $filters = $request->only(['status']);
        return Excel::download(new ShipsExport($filters), 'ship.xlsx');
    }

    public function exportCrewList(Request $request)
    {
        $filters = $request->only(['status', 'rank_id']);
        return Excel::download(new CrewListsExport($filters), 'crew_lists.xlsx');
    }

    public function exportScreening(Request $request)
    {
        $filters = $request->only(['month']);
        return Excel::download(new UserLamaransExport($filters), 'screening.xlsx');
    }
}