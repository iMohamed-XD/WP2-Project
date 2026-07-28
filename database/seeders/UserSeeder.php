<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
        {
            $managerRole = Role::where('role', 'manager')->first();
            $employeeRole = Role::where('role', 'employee')->first();

            $departments = [
                'trainers',
                'members',
                'branches',
                'warehouses',
                'classes'
            ];

            foreach ($departments as $departmentName) {

                $department = Department::where('department', $departmentName)->first();

                // Manager for department
                User::create([
                    'name' => ucfirst($departmentName) . ' Manager',
                    'email' => $departmentName . '.manager@gym.com',
                    'password' => Hash::make('password'),
                    'role_id' => $managerRole->id,
                    'department_id' => $department->id,
                ]);

                // Employee for department
                User::create([
                    'name' => ucfirst($departmentName) . ' Employee',
                    'email' => $departmentName . '.employee@gym.com',
                    'password' => Hash::make('password'),
                    'role_id' => $employeeRole->id,
                    'department_id' => $department->id,
                ]);
            }
        }
}
