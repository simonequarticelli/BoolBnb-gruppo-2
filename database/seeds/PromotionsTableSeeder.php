<?php

use App\Promotion;
use Illuminate\Database\Seeder;

class PromotionsTableSeeder extends Seeder
{
    
    public function run()
    {
        $promotions = [
            [
                'name' => 'promo-24',
                'price' => 2.99,
                'duration' => 24
            ],
            [
                'name' => 'promo-72',
                'price' => 5.99,
                'duration' => 72
            ],
            [
                'name' => 'promo-144',
                'price' => 9.99,
                'duration' => 144
            ]
        ];

        foreach ($promotions as $promotion) {
            
            $new_promotion = new Promotion();
            $new_promotion->fill($promotion);
            $new_promotion->save();
            
        }
    }
}
