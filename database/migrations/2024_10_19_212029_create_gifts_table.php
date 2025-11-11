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
        Schema::create('gifts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('wish_list_users_id')->constrained();
            $table->string('title', 80);
            $table->string('description', 150)->nullable();
            $table->string('image')->nullable();
            $table->text('link')->nullable();
            $table->foreignUuid('added_by')->constrained('users');
            $table->foreignUuid('reserved_by')->nullable()->constrained('users');
            $table->dateTime('reserved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gifts');
    }
};
