<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantGenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'restaurant_id' => '1',
            'genre_id' => '4'
        ];
        DB::table('restaurant_genres')->insert($param);
        $param = [
            'restaurant_id' => '2',
            'genre_id' => '5'
        ];
        DB::table('restaurant_genres')->insert($param);
        $param = [
            'restaurant_id' => '3',
            'genre_id' => '3'
        ];
        DB::table('restaurant_genres')->insert($param);
        $param = [
            'restaurant_id' => '4',
            'genre_id' => '1'
        ];
        DB::table('restaurant_genres')->insert($param);
         $param = [
            'restaurant_id' => '5',
            'genre_id' => '2'
        ];
        DB::table('restaurant_genres')->insert($param);
         $param = [
            'restaurant_id' => '6',
            'genre_id' => '5'
        ];
        DB::table('restaurant_genres')->insert($param);
         $param = [
            'restaurant_id' => '7',
            'genre_id' => '1'
        ];
        DB::table('restaurant_genres')->insert($param);
         $param = [
            'restaurant_id' => '8',
            'genre_id' => '2'
        ];
        DB::table('restaurant_genres')->insert($param);
         $param = [
            'restaurant_id' => '9',
            'genre_id' => '3'
        ];
        DB::table('restaurant_genres')->insert($param);
         $param = [
            'restaurant_id' => '10',
            'genre_id' => '4'
        ];
        DB::table('restaurant_genres')->insert($param);
         $param = [
            'restaurant_id' => '11',
            'genre_id' => '5'
        ];
        DB::table('restaurant_genres')->insert($param);
         $param = [
            'restaurant_id' => '12',
            'genre_id' => '5'
        ];
        DB::table('restaurant_genres')->insert($param);
         $param = [
            'restaurant_id' => '13',
            'genre_id' => '3'
        ];
        DB::table('restaurant_genres')->insert($param);
         $param = [
            'restaurant_id' => '14',
            'genre_id' => '4'
        ];
        DB::table('restaurant_genres')->insert($param);
         $param = [
            'restaurant_id' => '15',
            'genre_id' => '2'
        ];
        DB::table('restaurant_genres')->insert($param);
         $param = [
            'restaurant_id' => '16',
            'genre_id' => '3'
        ];
        DB::table('restaurant_genres')->insert($param);
         $param = [
            'restaurant_id' => '17',
            'genre_id' => '4'
        ];
        DB::table('restaurant_genres')->insert($param);
         $param = [
            'restaurant_id' => '18',
            'genre_id' => '5'
        ];
        DB::table('restaurant_genres')->insert($param);
         $param = [
            'restaurant_id' => '19',
            'genre_id' => '1'
        ];
        DB::table('restaurant_genres')->insert($param);
         $param = [
            'restaurant_id' => '20',
            'genre_id' => '4'
        ];
        DB::table('restaurant_genres')->insert($param);
    }
}
