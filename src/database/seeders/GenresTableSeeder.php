<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'number' => '4',
            'name' => '寿司',
            'restaurant_id' => '1'
        ];
        DB::table('genres')->insert($param);
        $param = [
            'number' => '5',
            'name' => '焼肉',
            'restaurant_id' => '2'
        ];
        DB::table('genres')->insert($param);
        $param = [
            'number' => '3',
            'name' => '居酒屋',
            'restaurant_id' => '3'
        ];
        DB::table('genres')->insert($param);
        $param = [
            'number' => '1',
            'name' => 'イタリアン',
            'restaurant_id' => '4'
        ];
        DB::table('genres')->insert($param);
        $param = [
            'number' => '2',
            'name' => 'ラーメン',
            'restaurant_id' => '5'
        ];
        DB::table('genres')->insert($param);
        $param = [
            'number' => '5',
            'name' => '焼肉',
            'restaurant_id' => '6'
        ];
        DB::table('genres')->insert($param);
        $param = [
            'number' => '1',
            'name' => 'イタリアン',
            'restaurant_id' => '7'
        ];
        DB::table('genres')->insert($param);
        $param = [
            'number' => '2',
            'name' => 'ラーメン',
            'restaurant_id' => '8'
        ];
        DB::table('genres')->insert($param);
         $param = [
            'number' => '3',
            'name' => '居酒屋',
            'restaurant_id' => '9'
        ];
        DB::table('genres')->insert($param);
        $param = [
            'number' => '4',
            'name' => '寿司',
            'restaurant_id' => '10'
        ];
        DB::table('genres')->insert($param);
        $param = [
            'number' => '5',
            'name' => '焼肉',
            'restaurant_id' => '11'
        ];
        DB::table('genres')->insert($param);
        $param = [
            'number' => '5',
            'name' => '焼肉',
            'restaurant_id' => '12'
        ];
        DB::table('genres')->insert($param);
        $param = [
            'number' => '3',
            'name' => '居酒屋',
            'restaurant_id' => '13'
        ];
        DB::table('genres')->insert($param);
        $param = [
            'number' => '4',
            'name' => '寿司',
            'restaurant_id' => '14'
        ];
        DB::table('genres')->insert($param);
        $param = [
            'number' => '2',
            'name' => 'ラーメン',
            'restaurant_id' => '15'
        ];
         DB::table('genres')->insert($param);
        $param = [
            'number' => '3',
            'name' => '居酒屋',
            'restaurant_id' => '16'
        ];
        DB::table('genres')->insert($param);
        $param = [
            'number' => '4',
            'name' => '寿司',
            'restaurant_id' => '17'
        ];
        DB::table('genres')->insert($param);
        $param = [
            'number' => '5',
            'name' => '焼肉',
            'restaurant_id' => '18'
        ];
        DB::table('genres')->insert($param);
        $param = [
            'number' => '1',
            'name' => 'イタリアン',
            'restaurant_id' => '19'
        ];
        DB::table('genres')->insert($param);
        $param = [
            'number' => '4',
            'name' => '寿司',
            'restaurant_id' => '20'
        ];
    }
}
