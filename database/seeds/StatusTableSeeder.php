<?php

use Illuminate\Database\Seeder;
use CodeCommerce\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'description' => 'Aguardando pagamento'
        ]);
        
        Status::create([
            'description' => 'Pagamento Confirmado'
        ]);
        
        Status::create([
            'description' => 'Entregue'
        ]);
    }
}
