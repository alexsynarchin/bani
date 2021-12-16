<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Seeder;

class PlacesFirstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $places = [
            [
                'number'=> 1,
                'type'=>'right',
                'posX' => 202.68,
                'posY' => 177.31,
            ],
            [
                'number'=> 2,
                'type'=>'right',
                'posX' => 202.92,
                'posY' => 133.65,
            ],
            [
                'number'=> 3,
                'type'=>'left',
                'posX' => 295.92,
                'posY' => 177.31,
            ],
            [
                'number'=> 4,
                'type'=>'left',
                'posX' => 295.92,
                'posY' => 133.65,
            ],
            [
                'number'=> 5,
                'type'=>'right',
                'posX' => 340.04,
                'posY' => 177.85,
            ],
            [
                'number'=> 6,
                'type'=>'right',
                'posX' => 339.58,
                'posY' => 133.65,
            ],
            [
                'number'=> 7,
                'type'=>'left',
                'posX' => 433.56,
                'posY' => 134.66,
            ],
            [
                'number'=> 8,
                'type'=>'left',
                'posX' => 433.56,
                'posY' => 178.32,
            ],
            [
                'number'=> 9,
                'type'=>'right',
                'posX' => 310.23,
                'posY' => 7.33,
            ],
            [
                'number'=> 10,
                'type'=>'left',
                'posX' => 402.46,
                'posY' => 7.39,
            ],
            [
                'number'=> 11,
                'type'=>'right',
                'posX' => 446.11,
                'posY' => 51.37,
            ],
            [
                'number'=> 12,
                'type'=>'right',
                'posX' => 446.34,
                'posY' => 7.53,
            ],
            [
                'number'=> 13,
                'type'=>'left',
                'posX' => 539.12,
                'posY' => 7.39,
            ],
            [
                'number'=> 14,
                'type'=>'left',
                'posX' => 539.12,
                'posY' => 51.04,
            ],
            [
                'number'=> 15,
                'type'=>'right',
                'posX' => 611.92,
                'posY' => 7.39,
            ],
            [
                'number'=> 16,
                'type'=>'left',
                'posX' => 704.47,
                'posY' => 7.39,
            ],
            [
                'number'=> 17,
                'type'=>'left',
                'posX' => 787.18,
                'posY' => 7.39,
            ],
            [
                'number'=> 18,
                'type'=>'left',
                'posX' => 787.18,
                'posY' => 51.05,
            ],
            [
                'number'=> 19,
                'type'=>'down',
                'posX' => 590.09,
                'posY' => 119.11,
            ],
            [
                'number'=> 20,
                'type'=>'down',
                'posX' => 633.75,
                'posY' => 119.11,
            ],
            [
                'number'=> 21,
                'type'=>'down',
                'posX' => 678.04,
                'posY' => 119.67,
            ],
            [
                'number'=> 22,
                'type'=>'top',
                'posX' => 590.09,
                'posY' => 216.93,
            ],
            [
                'number'=> 23,
                'type'=>'top',
                'posX' => 633.75,
                'posY' => 216.93,
            ],
            [
                'number'=> 24,
                'type'=>'top',
                'posX' => 677.4,
                'posY' => 216.93,
            ],
            [
                'number'=> 25,
                'type'=>'down',
                'posX' => 769.72,
                'posY' => 119.11,
            ],
            [
                'number'=> 26,
                'type'=>'down',
                'posX' => 813.38,
                'posY' => 119.11,
            ],
            [
                'number'=> 27,
                'type'=>'top',
                'posX' => 769.72,
                'posY' => 216.93,
            ],
            [
                'number'=> 28,
                'type'=>'top',
                'posX' => 813.38,
                'posY' => 216.93,
            ],
            [
                'number'=> 29,
                'type'=>'down',
                'posX' => 769.57,
                'posY' => 368.77,
            ],
            [
                'number'=> 30,
                'type'=>'down',
                'posX' => 813.31,
                'posY' => 368.84,
            ],
            [
                'number'=> 31,
                'type'=>'down',
                'posX' => 769.82,
                'posY' => 447.11,
            ],
            [
                'number'=> 32,
                'type'=>'down',
                'posX' => 813.55,
                'posY' => 447.18,
            ],
            [
                'number'=> 33,
                'type'=>'top',
                'posX' => 769.82,
                'posY' => 527.89,
            ],
            [
                'number'=> 34,
                'type'=>'top',
                'posX' => 813.75,
                'posY' => 527.91,
            ],
            [
                'number'=> 35,
                'type'=>'down',
                'posX' => 567.42,
                'posY' => 371.51,
            ],
            [
                'number'=> 36,
                'type'=>'down',
                'posX' => 611.16,
                'posY' => 371.57,
            ],
            [
                'number'=> 37,
                'type'=>'top',
                'posX' => 567.42,
                'posY' => 452.29,
            ],
            [
                'number'=> 38,
                'type'=>'top',
                'posX' => 611.35,
                'posY' => 452.29,
            ],
        ];
        foreach ($places as $place) {
            $place = Place::create($place);
        }
    }
}
