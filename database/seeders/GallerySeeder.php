<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
  \App\Models\GalleryItem::insert([
    ['title'=>'Upacara Bendera','category'=>'Kegiatan','image_path'=>'gallery/upacara1.jpg','created_at'=>now(),'updated_at'=>now()],
    ['title'=>'Juara Lomba','category'=>'Prestasi','image_path'=>'gallery/prestasi1.jpg','created_at'=>now(),'updated_at'=>now()],
    ['title'=>'Perpustakaan','category'=>'Fasilitas','image_path'=>'gallery/perpus1.jpg','created_at'=>now(),'updated_at'=>now()],
  ]);
}

}
