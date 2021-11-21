<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
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
            $name=$faker->sentence(6);
            DB::table('employees')->insert([
                'activity_id'=>rand(1,6),
                'first_name'=>$name,
                'last_name'=>$faker->sentence(6),
                'slug'=>Str::slug($name),
                'image'=> $faker->imageUrl(800, 400, 'cats', true),
                'email'=>$faker->email,
                'phone'=>$faker->phoneNumber,
                'job_title'=>$faker->title,
                'created_at'=>$faker->dateTime('now'),
                'updated_at'=>now(),
            ]);
        }
    }
}
