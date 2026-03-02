<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('email', 150)->unique();
            $table->string('password');
            $table->string('name', 100);

            $table->integer('age')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();

            $table->text('bio')->nullable();
            $table->string('location', 150)->nullable();

            $table->string('height', 20)->nullable();
            $table->string('weight', 20)->nullable();

            $table->unsignedBigInteger('vibe_id')->nullable();

            $table->text('interested')->nullable();
            $table->text('brings_you_here')->nullable();
            $table->text('see_yourself')->nullable();
            $table->text('gets_you_excited')->nullable();
            $table->text('open_to')->nullable();

            $table->text('instagram_url')->nullable();
            $table->string('profile_photo')->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamp('email_verified_at')->nullable();

            $table->timestamps();
    
            // $table->foreign('vibe_id')->references('id')->on('vibes')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};