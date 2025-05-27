<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use WW\Countries\Models\Country;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $countries = Country::orderBy('name')->pluck('name')->toArray();

        Schema::create('products', function (Blueprint $table) use ($countries) {
            $table->id();
            $table->enum('origin', $countries)->default('Bangladesh');
            $table->string('name');
            $table->enum('value', [1, 2, 5, 10, 20, 50, 100, 500, 1000])->default(10);
            $table->enum('category', ['regular', 'memorial'])->default('regular');
            $table->enum('type', ['note', 'bundle', 'penny', 'penny-stack'])->default('note');
            $table->integer('year')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('commission')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['draft', 'publish', 'private', 'NA'])->default('publish');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
