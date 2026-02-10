<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// query builder
use Illuminate\Support\Facades\DB;
// faker/data generator/dummy
use Faker\Factory as Faker;
// Carbon/date time
use Carbon\Carbon;
class HrisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Insert table roles
        DB::table('roles')->insert([
            [
                'title' => 'HR',
                'description' => 'Handling Team Role',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Developer',
                'description' => 'Handling Code',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        // Insert Departments
        DB::table('departments')->insert([
            [
                'name' => 'HR',
                'description' => 'Human Resources Department',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'IT',
                'description' => 'Information Technology Department',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Production',
                'description' => 'Production Department',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Insert Employees
        for ($i = 0; $i < 3; $i++) {
            DB::table('employees')->insert(
                [
                    'fullname' => $faker->name,
                    'email' => $faker->unique()->safeEmail,
                    'phone_number' => $faker->phoneNumber,
                    'address' => $faker->address,
                    'birth_day' => $faker->dateTimeBetween('-40 years', '-20 years')->format('Y-m-d'),
                    'hire_date' => Carbon::now(),
                    'department_id' => 1,
                    'role_id' => 1,
                    'status' => 'active',
                    'salary' => $faker->randomFloat(2, 30000, 100000),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => null

                ]
            );
        }

                // insert payroll
        DB::table('payroll')->insert([
            [
                'employee_id' => 1,
                'salary' => $faker->randomFloat(2, 30000, 100000),
                'bonuses' => $faker->randomFloat(2, 1000, 5000),
                'deductions' => $faker->randomFloat(2, 500, 2000),
                'net_salary' => $faker->randomFloat(2, 25000, 95000),
                'pay_date' => Carbon::parse('2026-01-22'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'employee_id' => 2,
                'salary' => $faker->randomFloat(2, 30000, 100000),
                'bonuses' => $faker->randomFloat(2, 1000, 5000),
                'deductions' => $faker->randomFloat(2, 500, 2000),
                'net_salary' => $faker->randomFloat(2, 25000, 95000),
                'pay_date' => Carbon::parse('2026-01-22'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

                // Insert Presences
        DB::table('presences')->insert([
            [
                'employee_id' => 1,
                'check_in' => Carbon::parse('2026-01-20 09:00:00'),
                'check_out' => Carbon::parse('2026-01-20 17:00:00'),
                'date' => Carbon::parse('2026-01-20'),
                'status' => 'present',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'employee_id' => 2,
                'check_in' => Carbon::parse('2026-01-20 09:00:00'),
                'check_out' => Carbon::parse('2026-01-20 17:00:00'),
                'date' => Carbon::parse('2026-01-20'),
                'status' => 'present',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

                // Insert Leaves Request
        DB::table('leave_requests')->insert([
            [
                'employee_id' => 1,
                'leave_type' => 'Sick Leave',
                'start_date' => Carbon::parse('2026-01-20'),
                'end_date' => Carbon::parse('2026-01-23'),
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'employee_id' => 2,
                'leave_type' => 'Vacations',
                'start_date' => Carbon::parse('2026-01-20'),
                'end_date' => Carbon::parse('2026-01-23'),
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        // Insert Tasks
        for ($i = 0; $i < 2; $i++) {
            DB::table('tasks')->insert([
                [
                    'title' => $faker->sentence(3),
                    'description' => $faker->paragraph,
                    'assigned_to' => 1,
                    'due_date' => Carbon::parse('2026-01-22'),
                    'status' => 'pending',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            ]);
        }


    }
}
