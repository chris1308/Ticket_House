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
        Schema::create('tikets', function (Blueprint $table) {
            $table->string('id_tiket')->primary();
            $table->string('id_penjual');
            $table->string('nama');
            $table->integer('harga');
            $table->integer('quantity');
            $table->string('kota');
            $table->string('alamat_lokasi');
            $table->json('gambar');
            $table->integer('jumlah_view');
            $table->char('status')->default(1); //1 means ticket active and not deleted
            $table->longText('deskripsi');
            $table->string('kategori');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tikets');
    }
};
