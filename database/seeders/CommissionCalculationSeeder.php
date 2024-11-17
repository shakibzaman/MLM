<?php

namespace Database\Seeders;

use App\Models\CommissionCalculation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommissionCalculationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CommissionCalculation::insert([
                [
                    'lead_user_package_id' => 1,
                    'label' => 'label_1',
                    'commission' => 25,
                ],
                [
                    'lead_user_package_id' => 1,
                    'label' => 'label_2',
                    'commission' => 5,
                ],
                [
                    'lead_user_package_id' => 1,
                    'label' => 'label_3',
                    'commission' => 1.5,
                ],
                [
                    'lead_user_package_id' => 2,
                    'label' => 'label_1',
                    'commission' => 35,
                ],
                [
                    'lead_user_package_id' => 2,
                    'label' => 'label_2',
                    'commission' => 8,
                ],
                [
                    'lead_user_package_id' => 2,
                    'label' => 'label_3',
                    'commission' => 3.5,
                ],
                [
                    'lead_user_package_id' => 3,
                    'label' => 'label_1',
                    'commission' => 45,
                ],
                [
                    'lead_user_package_id' => 3,
                    'label' => 'label_2',
                    'commission' => 15,
                ],
                [
                    'lead_user_package_id' => 3,
                    'label' => 'label_3',
                    'commission' => 7.5,
                ]

        ]);
    }
}
