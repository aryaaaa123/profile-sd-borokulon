<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('sarpras', function (Blueprint $table) {
      $table->id();
      $table->string('title');                 // nama fasilitas
      $table->string('icon')->nullable();      // ex: bi-pc-display
      $table->string('image')->nullable();     // path gambar (public storage)
      $table->text('description')->nullable(); // deskripsi singkat
      $table->unsignedInteger('sort_order')->default(0);
      $table->boolean('is_active')->default(true);
      $table->timestamps();
    });
  }
  public function down(): void { Schema::dropIfExists('sarpras'); }
};
