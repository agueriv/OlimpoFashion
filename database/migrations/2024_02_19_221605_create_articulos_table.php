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
            // nombre
            $table->string('nombre', 120);
            // seccion enum
            $table->enum('seccion', ['h', 'm', 'n', 'all'])->default('all');
            // temporada del articulo
            $table->enum('temporada', ['pri-ver', 'oto-inv', 'all'])->default('all');
            // foto del articulo, se podrian convertir en fotos
            $table->binary('picture');
            // id de la categoria
            $table->foreignId('idcategoria');
            // Definimos la clave foránea
            $table->foreign('idcategoria')->references('id')->on('categoria')->onUpdate('cascade')->onDelete('cascade');
            // esta rebajado o no
            $table->boolean('en_rebaja')->default(false);
            // precio del articulo
            $table->decimal('precio', 8, 2);
            // precio rebajado que puede ser null
            $table->decimal('precio_rebaja', 8, 2)->nullable();
            // descripcion del producto
            $table->string('descripcion', 1000);
            $table->timestamps();
        });

        // Vamos a cambiar el tipo del campo cover para subir fotos mas grandes
        $sql = 'alter table articulo change picture picture longblob';
        //las migraciones de Laravel no ofrecen el tipo longblob
        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulo');
    }
};
