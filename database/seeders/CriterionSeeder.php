<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Criterion; // <- pastikan baris ini ADA

class CriterionSeeder extends Seeder
{
    public function run()
    {
        $criteria = [
            ['code' => 'C01', 'name' => 'Sistem Rem', 'weight' => 0.3],
            ['code' => 'C02', 'name' => 'Lampu Utama', 'weight' => 0.2],
            ['code' => 'C03', 'name' => 'Emisi Gas', 'weight' => 0.25],
            ['code' => 'C04', 'name' => 'Kelayakan Ban', 'weight' => 0.25],
        ];

        foreach ($criteria as $c) {
            Criterion::updateOrCreate(['code' => $c['code']], $c);
        }
    }
}
