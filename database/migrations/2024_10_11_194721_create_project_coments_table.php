<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_content_id');
            $table->unsignedBigInteger('user_id');
            $table->text('comment');
            $table->boolean('is_approve')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('project_content_id')->references('id')->on('project_contents')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_coments');
    }
};
