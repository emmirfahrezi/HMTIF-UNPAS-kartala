<?php

namespace App\Http\Controllers;

use App\Http\Resources\DivisionResource;
use App\Http\Resources\ResponseResource;
use App\Http\Resources\StaffResource;
use App\Services\Staff\GetAllStaffsService;
use App\Services\Staff\GetDivisionsService;
use Illuminate\Http\JsonResponse;

class StaffController extends Controller
{
    public function __construct(
        private GetAllStaffsService $getAllStaffs,
        private GetDivisionsService $getDivisions,
    ) {}

    public function index(): JsonResponse
    {
        $staffs = $this->getAllStaffs->execute();

        return ResponseResource::success(
            StaffResource::collection($staffs),
            'Staff retrieved successfully'
        );
    }

    public function divisions(): JsonResponse
    {
        $divisions = $this->getDivisions->execute();

        return ResponseResource::success(
            DivisionResource::collection($divisions),
            'Divisions retrieved successfully'
        );
    }
}
