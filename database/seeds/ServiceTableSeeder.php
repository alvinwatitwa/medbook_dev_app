<?php

use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('services')->insert([
            'name' => 'Outpatient'
           
        ]);
        DB::table('services')->insert([
            'name' => 'Inpatient'
           
        ]);
    }
}
