<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class SampleCategorySeeder extends Seeder
{
    /**
     * Seed sample categories for UMKM inventory.
     */
    public function run(): void
    {
        $categories = [
            'Makanan',
            'Minuman',
            'Sembako',
            'Bumbu & Rempah',
            'Snack & Cemilan',
            'Frozen Food',
            'Peralatan Rumah Tangga',
            'Alat Tulis & Kantor',
            'Elektronik',
            'Pakaian & Tekstil',
            'Kerajinan Tangan',
            'Produk Kecantikan',
            'Obat & Kesehatan',
            'Perlengkapan Bayi',
            'Pertanian & Perkebunan',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
