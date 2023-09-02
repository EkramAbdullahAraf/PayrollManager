<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('leave_categories')->insert([
            ['name' => 'Vacation', 'description' => 'Annual vacation leave.'],
            ['name' => 'Sick Leave', 'description' => 'Leave due to illness or medical appointments.']
        ]);
    }
}
