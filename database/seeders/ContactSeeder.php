<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for($i=0;$i<=4;$i++){
            $name=$faker->name;
            DB::table('contacts')->insert([
                'customer_id'=>rand(1,6),
                'first_name'=>$name,
                'last_name'=>$faker->name,
                'slug'=>Str::slug($name),
                'image'=> $faker->imageUrl(400, 530, 'animals', true),
                'email'=>$faker->email,
                'phone'=>$faker->phoneNumber,
                'created_at'=>$faker->dateTime('now'),
                'updated_at'=>now(),
            ]);
        }

    }
}
