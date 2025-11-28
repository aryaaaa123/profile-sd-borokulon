<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
  public function run(): void
  {
    $data = [
      ['Judul Kegiatan Literasi', 'Kegiatan', 'Kepala Sekolah'],
      ['Prestasi Lomba Sains', 'Prestasi', 'Waka Kurikulum'],
      ['Pengumuman PPDB 2025', 'Pengumuman', 'Admin'],
    ];

    foreach ($data as [$title,$cat,$author]) {
      Post::updateOrCreate(
        ['slug' => Str::slug($title)],
        [
          'title' => $title,
          'category' => $cat,
          'author' => $author,
          'excerpt' => 'Ringkasan singkat tentang '.$title.'.',
          'content' => '<p>Ini adalah isi lengkap untuk <strong>'.$title.'</strong>. Tambahkan foto dan paragraf lain.</p>',
          'published_at' => now()->subDays(rand(1,10)),
          'cover' => null, // isi URL gambar jika ada
        ]
      );
    }
  }
}
