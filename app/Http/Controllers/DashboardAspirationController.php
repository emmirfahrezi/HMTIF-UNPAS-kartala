<?php

namespace App\Http\Controllers;

use App\Services\Aspiration\GetAspirationsDashboardService;
use Illuminate\Http\Request;

class DashboardAspirationController extends Controller
{
    public function __construct(
        private GetAspirationsDashboardService $getAspirations,
    ) {}

    public function index(Request $request)
    {
        $aspirations = $this->getAspirations->execute($request);

        return view('dashboard.aspirations.index', compact('aspirations'));
    }
}
