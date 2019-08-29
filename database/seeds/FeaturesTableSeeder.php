<?php

use App\Feature;
use Illuminate\Database\Seeder;

class FeaturesTableSeeder extends Seeder
{
    
    public function run()
    {
       $features = [
           [
            'name' => 'wifi' 
           ],
           [
            'name' => 'posto macchina' 
           ],
           [
            'name' => 'piscina' 
           ],
           [
            'name' => 'portineria' 
           ],
           [
            'name' => 'sauna' 
           ],
           [
            'name' => 'vista mare'
           ]
        ];

       foreach ($features as $feature) {
           $new_feature = new Feature();
           $new_feature->fill($feature);
           $new_feature->save();
       }
    }
}
