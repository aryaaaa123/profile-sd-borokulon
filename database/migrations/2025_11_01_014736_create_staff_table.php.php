<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('role',['guru','tendik']);
            $table->string('subject')->nullable();  // mapel (untuk guru)
            $table->string('position')->nullable(); // jabatan (untuk tendik/kepsek)
            $table->string('photo')->nullable();    // path foto
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('staff');
    }
};
