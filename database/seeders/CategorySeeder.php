<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('Categories')->insert([
            ['name' => 'Thịt lợn', 'created_at' => now() , 'updated_at' => now()],
            ['name' => 'Thịt gà', 'created_at' => now() , 'updated_at' => now()],
            ['name' => 'Rau', 'created_at' => now() , 'updated_at' => now()],
            ['name' => 'Củ quả', 'created_at' => now() , 'updated_at' => now()],
            ['name' => 'Trái cây', 'created_at' => now() , 'updated_at' => now()],
        ]);
    }
}
