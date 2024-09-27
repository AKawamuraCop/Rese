<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'number' => '1',
            'name' => '東京',
            'restaurant_id' => '1'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '2',
            'name' => '大阪',
            'restaurant_id' => '2'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '3',
            'name' => '福岡',
            'restaurant_id' => '3'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '1',
            'name' => '東京',
            'restaurant_id' => '4'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '3',
            'name' => '福岡',
            'restaurant_id' => '5'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '1',
            'name' => '東京',
            'restaurant_id' => '6'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '2',
            'name' => '大阪',
            'restaurant_id' => '7'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '1',
            'name' => '東京',
            'restaurant_id' => '8'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '2',
            'name' => '大阪',
            'restaurant_id' => '9'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '1',
            'name' => '東京',
            'restaurant_id' => '10'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '2',
            'name' => '大阪',
            'restaurant_id' => '11'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '3',
            'name' => '福岡',
            'restaurant_id' => '12'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '1',
            'name' => '東京',
            'restaurant_id' => '13'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '2',
            'name' => '大阪',
            'restaurant_id' => '14'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '1',
            'name' => '東京',
            'restaurant_id' => '15'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '2',
            'name' => '大阪',
            'restaurant_id' => '16'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '1',
            'name' => '東京',
            'restaurant_id' => '17'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '1',
            'name' => '東京',
            'restaurant_id' => '18'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '3',
            'name' => '福岡',
            'restaurant_id' => '19'
        ];
        DB::table('areas')->insert($param);
        $param = [
            'number' => '2',
            'name' => '大阪',
            'restaurant_id' => '20'
        ];
        DB::table('areas')->insert($param);
    }
}
