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
        Schema::create('bukus', function (Blueprint $table) {

            $table->id();

            $table->foreignId('id_genre')
                    ->constrained('genre')
                    ->onDelete('cascade');

            $table->foreignId('id_pengarang')
                    ->constrained('pengarang')
                    ->onDelete('cascade');

            $table->foreignId('id_penerbit')
                    ->constrained('penerbits')
                    ->onDelete('cascade');

            $table->foreignId('id_rak')
                    ->constrained('rak_buku')
                    ->onDelete('cascade');

            $table->string('judul');

            $table->year('tahun');

            $table->integer('stok');

            $table->string('foto')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};