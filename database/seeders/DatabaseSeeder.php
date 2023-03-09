<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Month;
use App\Models\Tuition;
use App\Models\Classe;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::insert([
            'id' => Str::ulid(),
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'level' => 'admin',
            'password' => Hash::make('admin123'),
        ]);

        Month::insert([['month_name'=>'Januari'],['month_name'=>'Februari'],['month_name'=>'Maret'],['month_name'=>'April'],['month_name'=>'Mei'],['month_name'=>'Juni'],['month_name'=>'Juli'],['month_name'=>'Agustus'],['month_name'=>'September'],['month_name'=>'Oktober'],['month_name'=>'November'],['month_name'=>'Desember']]);

        Tuition::insert([
            ['id' => Str::ulid(),
            'enter' => '2020',
            'out' => '2023',
            'price' => '900000',],
            ['id' => Str::ulid(),
            'enter' => '2021',
            'out' => '2024',
            'price' => '1000000',],
            ['id' => Str::ulid(),
            'enter' => '2022',
            'out' => '2025',
            'price' => '1200000',],
           
        ]);
        Classe::insert([
            ['id' => Str::ulid(),
            'grade' => 'X',
            'major' => 'MMD',],
            ['id' => Str::ulid(),
            'grade' => 'XI',
            'major' => 'TKJT',],
            ['id' => Str::ulid(),
            'grade' => 'XII',
            'major' => 'RPL',],
        ]);
    }
}
