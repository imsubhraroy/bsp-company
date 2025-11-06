<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
            'Headquarters',
            'Sales Office',
            'Support Center',
            'R&D Center',
            'Marketing Office',
            'Production Facility',
            'Distribution Center',
            'Training Center',
            'Regional Office',
            'Service Center',
        ];

        foreach ($branches as $branch) {
            Branch::create(['name' => $branch]);
        }
    }
}
