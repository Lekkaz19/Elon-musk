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
        Schema::table('content_comments', function (Blueprint $table) {
            // Add the new polymorphic columns, making them nullable temporarily for the transition
            $table->string('commentable_type')->nullable()->after('user_id');
            $table->unsignedBigInteger('commentable_id')->nullable()->after('user_id');
            $table->index(['commentable_id', 'commentable_type']);
        });

        // Data migration logic
        $comments = DB::table('content_comments')->get();
        foreach ($comments as $comment) {
            $modelType = null;
            switch ($comment->section) {
                case 'curiosidades':
                    $modelType = 'App\\Models\\Curiosidad';
                    break;
                case 'innovaciones':
                    $modelType = 'App\\Models\\Innovacion';
                    break;
                case 'biografia':
                    $modelType = 'App\\Models\\BiografiaEvento';
                    break;
            }

            if ($modelType) {
                DB::table('content_comments')
                    ->where('id', $comment->id)
                    ->update([
                        'commentable_type' => $modelType,
                        'commentable_id' => $comment->item_id,
                    ]);
            }
        }

        Schema::table('content_comments', function (Blueprint $table) {
            // Now that data is migrated, we can drop the old columns
            $table->dropColumn('section');
            $table->dropColumn('item_id');

            // And make the new columns not nullable
            $table->string('commentable_type')->nullable(false)->change();
            $table->unsignedBigInteger('commentable_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // To reverse, we'd need to convert back, which is more complex.
        // For this application, a simple column recreation is sufficient for rollback.
        Schema::table('content_comments', function (Blueprint $table) {
            $table->string('section');
            $table->unsignedBigInteger('item_id');
            $table->dropIndex(['commentable_id', 'commentable_type']);
            $table->dropColumn(['commentable_id', 'commentable_type']);
        });
    }
};
