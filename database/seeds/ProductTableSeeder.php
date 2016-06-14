<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CodeCommerce\Product;
//use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder {

    public function run() {
        
        /* Usando a classe faker manualmente sem usar o factory
        DB::table('products')->truncate();

        $faker = Faker::create();

        foreach (range(1, 40) as $i) {
            Product::create([
                'name' => $faker->word(),
                'description' => $faker->sentence(),
                'price' => $faker->randomNumber(2),
                'category_id' => $faker->numberBetween(1,15)
            ]);
        } 
         * 
         */
        
         factory('CodeCommerce\Product', 20)->create();
        
        
    }

}
