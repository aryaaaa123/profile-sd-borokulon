<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('posts', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->string('slug')->unique();
      $table->string('cover')->nullable();     // URL/path gambar sampul
      $table->string('category')->nullable();  // misal: Pengumuman, Kegiatan, Prestasi
      $table->string('author')->nullable();    // opsional
      $table->text('excerpt')->nullable();     // ringkasan singkat
      $table->longText('content');             // boleh HTML
      $table->timestamp('published_at')->nullable(); // null = draft
      $table->timestamps();
    });
  }
  public function down(): void { Schema::dropIfExists('posts'); }
};
