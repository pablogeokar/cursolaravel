<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CodeCommerce\User;


class UserTableSeeder extends Seeder {

    public function run() {
        
        /*
        factory('CodeCommerce\User')->create(['name' => 'Pablo George',
            'email' => 'pablogeokar@hotmail.com',
            'password' => Hash::make('230435')]);
         * 
         */
        
        factory('CodeCommerce\User', 10)->create();
    }

}
