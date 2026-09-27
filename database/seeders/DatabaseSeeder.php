<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $password = env('EXAM_ADMIN_PASSWORD');

        if (empty($password)) {
            throw new RuntimeException(
                'EXAM_ADMIN_PASSWORD is not configured in the .env file.'
            );
        }

        // Exam login user
        User::updateOrCreate(
            ['email' => 'admin@employee-api.test'],
            [
                'name' => 'Exam Admin',
                'password' => Hash::make($password),
            ]
        );

        // Departments
        $it = Department::updateOrCreate(
            ['code' => 'IT'],
            ['name' => 'Information Technology']
        );

        $hr = Department::updateOrCreate(
            ['code' => 'HR'],
            ['name' => 'Human Resources']
        );

        $fin = Department::updateOrCreate(
            ['code' => 'FIN'],
            ['name' => 'Finance']
        );

        // Employees
        $employees = [
            [
                'department_id' => $it->id,
                'employee_number' => 'EMP-001',
                'first_name' => 'Juan',
                'last_name' => 'Dela Cruz',
                'email' => 'juan.delacruz@example.test',
                'position' => 'Software Developer',
                'employment_status' => 'Active',
            ],
            [
                'department_id' => $it->id,
                'employee_number' => 'EMP-002',
                'first_name' => 'Maria',
                'last_name' => 'Santos',
                'email' => 'maria.santos@example.test',
                'position' => 'System Analyst',
                'employment_status' => 'Active',
            ],
            [
                'department_id' => $it->id,
                'employee_number' => 'EMP-003',
                'first_name' => 'Pedro',
                'last_name' => 'Reyes',
                'email' => 'pedro.reyes@example.test',
                'position' => 'Database Administrator',
                'employment_status' => 'Inactive',
            ],
            [
                'department_id' => $it->id,
                'employee_number' => 'EMP-004',
                'first_name' => 'Anna',
                'last_name' => 'Garcia',
                'email' => 'anna.garcia@example.test',
                'position' => 'Network Administrator',
                'employment_status' => 'Active',
            ],
            [
                'department_id' => $hr->id,
                'employee_number' => 'EMP-005',
                'first_name' => 'Carlos',
                'last_name' => 'Mendoza',
                'email' => 'carlos.mendoza@example.test',
                'position' => 'HR Specialist',
                'employment_status' => 'Active',
            ],
            [
                'department_id' => $hr->id,
                'employee_number' => 'EMP-006',
                'first_name' => 'Sofia',
                'last_name' => 'Navarro',
                'email' => 'sofia.navarro@example.test',
                'position' => 'Recruitment Officer',
                'employment_status' => 'Inactive',
            ],
            [
                'department_id' => $hr->id,
                'employee_number' => 'EMP-007',
                'first_name' => 'Daniel',
                'last_name' => 'Torres',
                'email' => 'daniel.torres@example.test',
                'position' => 'Training Officer',
                'employment_status' => 'Active',
            ],
            [
                'department_id' => $hr->id,
                'employee_number' => 'EMP-008',
                'first_name' => 'Nicole',
                'last_name' => 'Flores',
                'email' => 'nicole.flores@example.test',
                'position' => 'HR Assistant',
                'employment_status' => 'Active',
            ],
            [
                'department_id' => $fin->id,
                'employee_number' => 'EMP-009',
                'first_name' => 'Mark',
                'last_name' => 'Aquino',
                'email' => 'mark.aquino@example.test',
                'position' => 'Accountant',
                'employment_status' => 'Active',
            ],
            [
                'department_id' => $fin->id,
                'employee_number' => 'EMP-010',
                'first_name' => 'Lisa',
                'last_name' => 'Cruz',
                'email' => 'lisa.cruz@example.test',
                'position' => 'Financial Analyst',
                'employment_status' => 'Inactive',
            ],
            [
                'department_id' => $fin->id,
                'employee_number' => 'EMP-011',
                'first_name' => 'Kevin',
                'last_name' => 'Ramos',
                'email' => 'kevin.ramos@example.test',
                'position' => 'Budget Officer',
                'employment_status' => 'Active',
            ],
            [
                'department_id' => $fin->id,
                'employee_number' => 'EMP-012',
                'first_name' => 'Rachel',
                'last_name' => 'Lim',
                'email' => 'rachel.lim@example.test',
                'position' => 'Payroll Officer',
                'employment_status' => 'Active',
            ],
        ];

        foreach ($employees as $employee) {
            Employee::updateOrCreate(
                ['employee_number' => $employee['employee_number']],
                $employee
            );
        }
    }
}