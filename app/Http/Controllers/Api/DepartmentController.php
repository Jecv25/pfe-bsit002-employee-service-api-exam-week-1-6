<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // GET /api/departments
    // Public
    public function index()
    {
        $departments = Department::query()
            ->orderBy('name')
            ->get([
                'id',
                'name',
                'code',
                'created_at',
                'updated_at',
            ]);

        return response()->json([
            'message' => 'Departments retrieved successfully',
            'data' => $departments,
            'errors' => null,
        ]);
    }
}