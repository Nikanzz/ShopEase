<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['S','A','B','C','D','E','F'];

        foreach($data as $i){
            DB::table('categories')->insert([
                'name' => $i
            ]);
        }
    }
}
