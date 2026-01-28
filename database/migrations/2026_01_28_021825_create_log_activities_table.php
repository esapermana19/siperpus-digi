<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('log_activities', function (Blueprint $table) {
        $table->id();
        $table->string('subject'); // Contoh: "Menambah Kategori"
        $table->string('url');     // URL saat aksi dilakukan
        $table->string('method');  // POST, PUT, DELETE
        $table->string('agent');   // Browser yang digunakan
        $table->unsignedBigInteger('user_id')->nullable(); // Siapa yang melakukan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_activities');
    }
};
