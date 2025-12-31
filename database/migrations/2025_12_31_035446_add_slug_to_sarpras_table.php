<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sarpras', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });
        
        // Generate slugs for existing records
        $sarpras = DB::table('sarpras')->get();
        $usedSlugs = [];
        
        foreach ($sarpras as $item) {
            $slug = \Illuminate\Support\Str::slug($item->title);
            $originalSlug = $slug;
            $count = 1;
            
            // Ensure uniqueness against already used slugs in this migration
            while (in_array($slug, $usedSlugs)) {
                $slug = $originalSlug . '-' . $count++;
            }
            
            $usedSlugs[] = $slug;
            DB::table('sarpras')->where('id', $item->id)->update(['slug' => $slug]);
        }
        
        // Now make the slug column unique and not nullable
        Schema::table('sarpras', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sarpras', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
