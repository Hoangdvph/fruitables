<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $collect1 = collect(['Organic', 'Fresh']);
        $collect2 = collect(['OrganicFood', 'C.P', 'Bách hóa xanh']);
        $now = now();

        for ($i = 0; $i < 20; $i++) {
            # code...
           
            $quality = $collect1->random();
            $origin = $collect2->random();
            $data[] = [
                'name' => fake()->name,
                'category_id' => rand(1,5),
                'price' => rand(10000, 55000),
                'weight' => rand(400, 600),
                'origin' => $origin,
                'quality' => $quality,
                'image' => fake()->imageUrl(),
                'created_at' => $now,
                'updated_at' => $now,
            ];

            if($i % 4 == 0){
                $data = [];
            }

            DB::table('products')->insert($data);
        };
    }
}
