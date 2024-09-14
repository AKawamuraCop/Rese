<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantAreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'restaurant_id' => '1',
            'area_id' => '1'
        ];
        DB::table('restaurant_areas')->insert($param);
        $param = [
            'restaurant_id' => '2',
            'area_id' => '2'
        ];
        DB::table('restaurant_areas')->insert($param);
        $param = [
            'restaurant_id' => '3',
            'area_id' => '3'
        ];
        DB::table('restaurant_areas')->insert($param);
        $param = [
            'restaurant_id' => '4',
            'area_id' => '1'
        ];
        DB::table('restaurant_areas')->insert($param);
         $param = [
            'restaurant_id' => '5',
            'area_id' => '3'
        ];
        DB::table('restaurant_areas')->insert($param);
         $param = [
            'restaurant_id' => '6',
            'area_id' => '1'
        ];
        DB::table('restaurant_areas')->insert($param);
         $param = [
            'restaurant_id' => '7',
            'area_id' => '2'
        ];
        DB::table('restaurant_areas')->insert($param);
         $param = [
            'restaurant_id' => '8',
            'area_id' => '1'
        ];
        DB::table('restaurant_areas')->insert($param);
         $param = [
            'restaurant_id' => '9',
            'area_id' => '2'
        ];
        DB::table('restaurant_areas')->insert($param);
         $param = [
            'restaurant_id' => '10',
            'area_id' => '1'
        ];
        DB::table('restaurant_areas')->insert($param);
         $param = [
            'restaurant_id' => '11',
            'area_id' => '2'
        ];
        DB::table('restaurant_areas')->insert($param);
         $param = [
            'restaurant_id' => '12',
            'area_id' => '3'
        ];
        DB::table('restaurant_areas')->insert($param);
         $param = [
            'restaurant_id' => '13',
            'area_id' => '1'
        ];
        DB::table('restaurant_areas')->insert($param);
         $param = [
            'restaurant_id' => '14',
            'area_id' => '2'
        ];
        DB::table('restaurant_areas')->insert($param);
         $param = [
            'restaurant_id' => '15',
            'area_id' => '1'
        ];
        DB::table('restaurant_areas')->insert($param);
         $param = [
            'restaurant_id' => '16',
            'area_id' => '2'
        ];
        DB::table('restaurant_areas')->insert($param);
         $param = [
            'restaurant_id' => '17',
            'area_id' => '1'
        ];
        DB::table('restaurant_areas')->insert($param);
         $param = [
            'restaurant_id' => '18',
            'area_id' => '1'
        ];
        DB::table('restaurant_areas')->insert($param);
         $param = [
            'restaurant_id' => '19',
            'area_id' => '3'
        ];
        DB::table('restaurant_areas')->insert($param);
         $param = [
            'restaurant_id' => '20',
            'area_id' => '2'
        ];
        DB::table('restaurant_areas')->insert($param);
        
    }
}
