<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Announcement, Post, GalleryItem};
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class ExampleHomeSeeder extends Seeder
{
    public function run(): void
    {
        Announcement::factory()->create(['text'=>'PPDB dibuka 10 Desember–10 Januari.','is_active'=>true]);
        Announcement::factory()->create(['text'=>'Libur semester mulai 20 Desember.','is_active'=>true]);

        for ($i=1; $i<=4; $i++){
            Post::updateOrCreate(
                ['slug'=>Str::slug("Contoh Berita $i")],
                [
                    'title'=>"Contoh Berita $i",
                    'content'=>'Isi contoh berita...',
                    'published_at'=>Carbon::now()->subDays($i),
                ]
            );
        }

        for ($i=1; $i<=8; $i++){
            GalleryItem::updateOrCreate(
                ['image_path'=>"/assets/images/sample-$i.jpg"],
                ['title'=>"Foto $i"]
            );
        }
    }
}
