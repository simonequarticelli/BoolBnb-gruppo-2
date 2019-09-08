<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        $this->call(FeaturesTableSeeder::class);
        $this->call(PromotionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
    }
}
