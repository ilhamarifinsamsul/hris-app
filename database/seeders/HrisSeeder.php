<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// query builder
use Illuminate\Support\Facades\DB;
// faker/data generator/dummy
use Faker\Factory as Faker;
// Carbon/date time
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
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
                'title' => 'Employee',
                'description' => 'Handling Employee Role',
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
                    'salary' => $faker->numberBetween(3000000, 15000000),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => null

                ]
            );
        }
        // Insert Users
        DB::table('users')->insert([
            [
                'name' => 'Admin HRIS',
                'email' => 'admin@hris.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
                'employee_id' => 1
            ]
        ]);

        // insert payrolls
        DB::table('payrolls')->insert([
            [
                'employee_id' => 1,
                'salary' => $faker->numberBetween(3000000, 15000000),
                'bonuses' => $faker->numberBetween(100000, 2000000),
                'deductions' => $faker->numberBetween(50000, 1000000),
                'net_salary' => $faker->numberBetween(3000000, 15000000),
                'pay_date' => Carbon::parse('2026-01-22'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'employee_id' => 2,
                'salary' => $faker->numberBetween(3000000, 15000000),
                'bonuses' => $faker->numberBetween(100000, 2000000),
                'deductions' => $faker->numberBetween(50000, 1000000),
                'net_salary' => $faker->numberBetween(3000000, 15000000),
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
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph,
                'assigned_to' => 1,
                'due_date' => Carbon::parse('2026-01-22'),
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
