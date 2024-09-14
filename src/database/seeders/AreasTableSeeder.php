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
            'area_name' => '東京',
        ];
        DB::table('areas')->insert($param);
        $param = [
            'area_name' => '大阪',
        ];
        DB::table('areas')->insert($param);
        $param = [
            'area_name' => '福岡',
        ];
        DB::table('areas')->insert($param);
    }
}
