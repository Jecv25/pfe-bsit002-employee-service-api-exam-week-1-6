<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    // GET /api/employees
    // Public: paginated list with search and employment-status filtering
    public function index(Request $request)
    {
        $query = Employee::with('department');

        // Case-insensitive search:
        // employee number, first name, last name, email, department name
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->whereRaw(
                    'LOWER(employee_number) LIKE ?',
                    ['%' . strtolower($search) . '%']
                )
                ->orWhereRaw(
                    'LOWER(first_name) LIKE ?',
                    ['%' . strtolower($search) . '%']
                )
                ->orWhereRaw(
                    'LOWER(last_name) LIKE ?',
                    ['%' . strtolower($search) . '%']
                )
                ->orWhereRaw(
                    'LOWER(email) LIKE ?',
                    ['%' . strtolower($search) . '%']
                )
                ->orWhereHas('department', function ($departmentQuery) use ($search) {
                    $departmentQuery->whereRaw(
                        'LOWER(name) LIKE ?',
                        ['%' . strtolower($search) . '%']
                    );
                });
            });
        }

        // Filter by employment status
        if ($request->filled('status')) {
            $request->validate([
                'status' => ['in:Active,Inactive'],
            ]);

            $query->where('employment_status', $request->status);
        }

        return response()->json([
            'message' => 'Employees retrieved successfully',
            'data' => $query->paginate(
                $request->integer('per_page', 10)
            ),
            'errors' => null,
        ]);
    }

    // POST /api/employees
    // Protected
    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => ['required', 'exists:departments,id'],
            'employee_number' => [
                'required',
                'string',
                'max:30',
                'unique:employees,employee_number',
            ],
            'first_name' => ['required', 'string', 'max:80'],
            'last_name' => ['required', 'string', 'max:80'],
            'email' => [
                'required',
                'email',
                'unique:employees,email',
            ],
            'position' => ['required', 'string', 'max:100'],
            'employment_status' => [
                'required',
                Rule::in(['Active', 'Inactive']),
            ],
        ]);

        $employee = Employee::create($validated);

        return response()->json([
            'message' => 'Employee created successfully',
            'data' => $employee->load('department'),
            'errors' => null,
        ], 201);
    }

    // GET /api/employees/{id}
    // Public
    public function show($id)
    {
        $employee = Employee::with('department')->find($id);

        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found',
                'data' => null,
                'errors' => null,
            ], 404);
        }

        return response()->json([
            'message' => 'Employee retrieved successfully',
            'data' => $employee,
            'errors' => null,
        ]);
    }

    // PUT /api/employees/{id}
    // Protected
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found',
                'data' => null,
                'errors' => null,
            ], 404);
        }

        $validated = $request->validate([
            'department_id' => [
                'sometimes',
                'required',
                'exists:departments,id',
            ],
            'employee_number' => [
                'sometimes',
                'required',
                'string',
                'max:30',
                Rule::unique('employees', 'employee_number')
                    ->ignore($employee->id),
            ],
            'first_name' => [
                'sometimes',
                'required',
                'string',
                'max:80',
            ],
            'last_name' => [
                'sometimes',
                'required',
                'string',
                'max:80',
            ],
            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique('employees', 'email')
                    ->ignore($employee->id),
            ],
            'position' => [
                'sometimes',
                'required',
                'string',
                'max:100',
            ],
            'employment_status' => [
                'sometimes',
                'required',
                Rule::in(['Active', 'Inactive']),
            ],
        ]);

        $employee->update($validated);

        return response()->json([
            'message' => 'Employee updated successfully',
            'data' => $employee->load('department'),
            'errors' => null,
        ]);
    }

    // DELETE /api/employees/{id}
    // Protected
    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found',
                'data' => null,
                'errors' => null,
            ], 404);
        }

        $employee->delete();

        return response()->json([
            'message' => 'Employee deleted successfully',
            'data' => null,
            'errors' => null,
        ]);
    }
}