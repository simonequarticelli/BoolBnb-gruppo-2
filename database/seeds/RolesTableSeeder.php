<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    
    public function run()
    {
        $roles = [
            [
                'name' => 'upra',
                'display_name' => 'UPRA',
                'description' => 'utente Auth con appartamento'
                
            ]
        ];

        foreach ($roles as $role) {
            
            $new_role = new Role();
            $new_role->fill($role);
            $new_role->save();
            
        }
    }
}
