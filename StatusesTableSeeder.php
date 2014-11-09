<?php

use Faker\Factory as Faker;

class StatusesTableSeeder extends Seeder {
    public function run(){
        $faker= Faker::create();
        foreach(range(1,50)) as $index){
            Status::create([
                'user_id',
                'body' => $faker->sentence()
            ]);
        }
    }
}