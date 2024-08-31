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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->timestamps();
        });

        Schema::create('titles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('prologue');
            $table->unsignedBigInteger('category_id');
            $table->string('user_id')->nullable();
            $table->boolean('is_final')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::create('tutorials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('title_id');
            $table->string('sub_title');
            $table->longText('contents');
            $table->boolean('is_publish')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('title_id')->references('id')->on('titles')->onDelete('cascade');
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tutorial_id');
            $table->unsignedBigInteger('user_id');
            $table->text('comment');
            $table->boolean('is_approve')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tutorial_id')->references('id')->on('tutorials')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->longText('contents');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->longText('contents');
            $table->string('profile_picture')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('titles');
        Schema::dropIfExists('tutorials');

        Schema::dropIfExists('homes');
        Schema::dropIfExists('abouts');
    }
};
