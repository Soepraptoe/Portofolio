<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('period');          // contoh: "Feb 2024 - Jul 2024"
            $table->string('title');           // posisi / kegiatan
            $table->string('org');             // perusahaan / organisasi
            $table->text('description')->nullable();
            $table->json('tags')->nullable();
            $table->unsignedInteger('sort_order')->default(0); // 1 = paling atas
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};