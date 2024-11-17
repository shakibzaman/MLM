<?php

namespace Database\Seeders;

use App\Models\LifetimePackage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LifetimePackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LifetimePackage::insert([
            [
                'name' => 'Explorer',
                'description' => 'This is the basic package',
                'price' => 20,
                'percentage_label_1' => 30,
                'percentage_label_2' => 5,
                'percentage_label_3' => 1,
            ],
            [
                'name' => 'Pro',
                'description' => 'This is the basic package',
                'price' => 58,
                'percentage_label_1' => 40,
                'percentage_label_2' => 7,
                'percentage_label_3' => 2,
            ],
            [
                'name' => 'Elite',
                'description' => 'This is the basic package',
                'price' => 98,
                'percentage_label_1' => 50,
                'percentage_label_2' => 10,
                'percentage_label_3' => 3,
            ],

        ]);
    }
}
