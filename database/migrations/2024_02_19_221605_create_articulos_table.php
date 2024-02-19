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
        Schema::create('articulo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 120);
            $table->enum('seccion', ['h', 'm', 'n', 'all'])->default('all');
            $table->enum('temporada', ['pri-ver', 'oto-inv', 'all'])->default('all');
            $table->binary('picture');
            $table->foreignId('idcategoria');
            // Definimos la clave foránea
            $table->foreign('idcategoria')->references('id')->on('categoria')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('en_rebaja')->default(false);
            $table->decimal('precio', 8, 2);
            $table->decimal('precio_rebaja', 8, 2)->nullable();
            $table->string('descripcion', 1000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulo');
    }
};
