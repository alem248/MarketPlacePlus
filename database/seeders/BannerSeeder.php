<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiamos banners anteriores para evitar duplicados al re-sembrar
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Banner::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $banners = [
            // Banner principal del hero (aparece en la zona central grande)
            [
                'title'      => 'Future Tech Unleashed',
                'image_path' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=1200',
                'link_url'   => 'https://www.theverge.com',
                'end_date'   => '2026-12-31',
                'is_active'  => true,
            ],
            // Banner secundario del sidebar (publicidad lateral)
            [
                'title'      => 'Just Do It.',
                'image_path' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600',
                'link_url'   => 'https://www.nike.com',
                'end_date'   => '2026-12-31',
                'is_active'  => true,
            ],
        ];

        foreach ($banners as $data) {
            Banner::create($data);
        }

        $this->command->info('BannerSeeder OK: 2 banners de muestra creados.');
    }
}
