<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_comments', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            
            $table->string('guest_name')->nullable();
            $table->string('section');
            $table->unsignedBigInteger('item_id')->nullable();
            $table->text('content');
            $table->boolean('approved')->default(false);
            
            // 🚨 SINTAXIS CORREGIDA
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');

            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
                        
            $table->index(['section', 'item_id', 'approved']);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('content_comments');
    }
};