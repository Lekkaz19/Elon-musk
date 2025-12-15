<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Arreglar innovaciones con timestamps NULL
        DB::statement("
            UPDATE blog_innovations 
            SET created_at = COALESCE(created_at, NOW()),
                updated_at = COALESCE(updated_at, NOW())
            WHERE created_at IS NULL OR updated_at IS NULL
        ");

        // Arreglar curiosidades con timestamps NULL
        DB::statement("
            UPDATE blog_curiosities 
            SET created_at = COALESCE(created_at, NOW()),
                updated_at = COALESCE(updated_at, NOW())
            WHERE created_at IS NULL OR updated_at IS NULL
        ");

        // Arreglar biografia_eventos con timestamps NULL
        DB::statement("
            UPDATE biography_timeline 
            SET created_at = COALESCE(created_at, NOW()),
                updated_at = COALESCE(updated_at, NOW())
            WHERE created_at IS NULL OR updated_at IS NULL
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No revertir - los timestamps son datos válidos
    }
};
