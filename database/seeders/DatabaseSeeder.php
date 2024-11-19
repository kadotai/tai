<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateDefaultImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 'image_at' が NULL のレコードを更新
        DB::table('tasks')->whereNull('image_at')->update(['image_at' => 'images/default.png']);
    }
}