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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_user');
            $table->string('name');
            $table->string('price');
            $table->unsignedInteger('id_category');
            $table->unsignedInteger('id_brand');
            $table->unsignedInteger('status');
            $table->unsignedInteger('sale');
            $table->string('company');
            $table->string('hinhanh', 1000);
            $table->string('detail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
