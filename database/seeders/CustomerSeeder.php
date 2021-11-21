<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
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
            $title=$faker->sentence(6);
            DB::table('customers')->insert([
                'name'=>$title,
                'slug'=>Str::slug($title),
                'image'=> $faker->imageUrl(800, 400, 'cats', true),
                'adress'=>$faker->paragraph(6),
                'website'=>$faker->sentence(6),
                'source'=>$faker->title,
                'created_at'=>$faker->dateTime('now'),
                'updated_at'=>now(),
            ]);
        }

    }
}
