<?php

use App\House;
use Illuminate\Database\Seeder;

class HousesTableSeeder extends Seeder
{
    
    public function run()
    {
       $houses = [
           [
               'title' => 'loft con vista montagne',
               'n_beds' => 1,
               'n_wc' => 2,
               'mq' => 70,
               'address' => 'via roma',
               'longitude' => 12.4564,
               'latitude' => 32.7689,
               'img' => 'foto',
               'slug' => 'loft-con-vista-montagne'

           ],
           [
                'title' => 'appartamento città',
                'n_beds' => 1,
                'n_wc' => 2,
                'mq' => 70,
                'address' => 'via mazzini',
                'longitude' => 12.4564,
                'latitude' => 32.7689,
                'img' => 'foto',
                'slug' => 'appartamento-città'

            ],
            [
                'title' => 'appartamento mare',
                'n_beds' => 1,
                'n_wc' => 2,
                'mq' => 70,
                'address' => 'via verdi',
                'longitude' => 12.4564,
                'latitude' => 32.7689,
                'img' => 'foto',
                'slug' => 'appartamento-mare'
 
            ],
            [
                'title' => 'appartamento collina',
                'n_beds' => 1,
                'n_wc' => 2,
                'mq' => 70,
                'address' => 'via rossi',
                'longitude' => 12.4564,
                'latitude' => 32.7689,
                'img' => 'foto',
                'slug' => 'appartamento-collina'
 
            ]
            
        ];
    
        foreach ($houses as $house) {
            
            $new_house = new House();
            $new_house->fill($house);
            $new_house->save();
            
        }
    }
}
