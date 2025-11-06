<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            'Web Development',
            'Mobile App Development',
            'UI/UX Design',
            'Digital Marketing',
            'SEO Services',
            'Cloud Computing',
            'Data Analytics',
            'AI & Machine Learning',
            'Cybersecurity',
            'DevOps Services',
            'E-commerce Solutions',
            'Content Management',
            'Quality Assurance',
            'IT Consulting',
            'Blockchain Development',
        ];

        foreach ($services as $service) {
            Service::create(['name' => $service]);
        }
    }
}
