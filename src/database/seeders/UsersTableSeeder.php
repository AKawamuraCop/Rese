<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'name' => '管理者',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin001'),
            'auth' => '1',
            'email_verified_at' => Carbon::now(),
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '店舗代表',
            'email' => 'manager@mail.com',
            'password' => Hash::make('manager001'),
            'auth' => '2',
            'email_verified_at' => Carbon::now(),
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'テストユーザー1',
            'email' => 'test001@mail.com',
            'password' => Hash::make('testuser001'),
            'auth' => '3',
            'email_verified_at' => Carbon::now(),
        ];
        DB::table('users')->insert($param);
    }
}
