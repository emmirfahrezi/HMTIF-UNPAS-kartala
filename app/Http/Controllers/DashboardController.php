<?php

namespace App\Http\Controllers;

use App\Services\Dashboard\GetDashboardIndexService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(private GetDashboardIndexService $getDashboardIndex) {}

    public function index(Request $request)
    {
        $user = $request->user();
        $data = $this->getDashboardIndex->execute();

        return view('dashboard.index', array_merge(['user' => $user], $data));
    }
}
