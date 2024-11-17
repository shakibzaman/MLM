<?php

namespace Database\Seeders;

use App\Models\MonthlyPackage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonthlyPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MonthlyPackage::insert([
            [
                'name' => 'Explorer',
                'description' => 'This is the basic package',
                'price' => 5,
                'percentage_label_1' => 30,
                'percentage_label_2' => 5,
                'percentage_label_3' => 1,
            ],
            [
                'name' => 'Pro',
                'description' => 'This is the basic package',
                'price' => 15,
                'percentage_label_1' => 40,
                'percentage_label_2' => 7,
                'percentage_label_3' => 2,
            ],
            [
                'name' => 'Elite',
                'description' => 'This is the basic package',
                'price' => 25,
                'percentage_label_1' => 50,
                'percentage_label_2' => 10,
                'percentage_label_3' => 3,
            ],
            ]);
    }
}
