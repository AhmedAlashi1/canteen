<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
//            AdminSeeder::class,
//            ClientSatisfactionsSeeder::class,
//            CompaniesSeeder::class,
//            QuestionsSeeder::class,
//            ServicesSeeder::class,
//            TermSeeder::class,
//            WorksSeeder::class,
//            ProcessSeeder::class,
//            BlogTypeSeeder::class,
//            MemberSeeder::class,
//            SettingSeeder::class,
            SettingSeoSeeder::class,

        ]);
    }
}
