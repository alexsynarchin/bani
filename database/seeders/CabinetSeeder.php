<?php

namespace Database\Seeders;

use App\Models\Cabinet;
use Illuminate\Database\Seeder;

class CabinetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cabinetes = [
            [
                'number'=> 1,
                'posX' => 2.96,
                'posY' => 225.49,
                'width' => 145.26,
                'height' =>246.49
            ],
            [
                'number'=> 2,
                'posX' => 27.79,
                'posY' => 6.71,
                'width' =>112.61,
                'height' =>163.86
            ],
            [
                'number'=> 3,
                'posX' =>143.48,
                'posY' => 5.97,
                'width' => 122.41,
                'height' =>163.86
            ],
            [
                'number'=> 4,
                'posX' => 270.32,
                'posY' => 5.97,
                'width' => 123.06,
                'height' =>164.64
            ],
            [
                'number'=> 5,
                'posX' => 396.6,
                'posY' => 4.58,
                'width' => 132.36,
                'height' =>165.22
            ],
            [
                'number'=> 6,
                'posX' => 533.42,
                'posY' => 6.16,
                'width' => 128.88,
                'height' =>175.1
            ],
            [
                'number'=> 7,
                'posX' => 664.79,
                'posY' => 5.93,
                'width' => 128.88,
                'height' =>203.05
            ],
        ];
        foreach ($cabinetes as $cabinete) {
            Cabinet::create($cabinete);
        }
    }
}
