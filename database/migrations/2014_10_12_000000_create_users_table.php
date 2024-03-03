<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('puesto', ['jefe', 'empleado'])->default('empleado');
            $table->rememberToken();
            $table->timestamps();
        });

        $pass = Hash::make('31102004');
        $sql = "insert into users (name, email, email_verified_at, password, puesto, created_at, updated_at) VALUES ('Ariel', 'ariel@gmail.com', '2024-02-21 10:07:58', '" . $pass . "', 'jefe', '2024-02-21 10:07:58', '2024-02-21 10:07:58');";
        DB::statement($sql);

        $pass2 = Hash::make('12345678');
        $sql2 = "insert into users (name, email, email_verified_at, password, puesto, created_at, updated_at) VALUES ('Empleado', 'empleado@gmail.com', '2024-02-21 10:07:58', '" . $pass2 . "', 'empleado', '2024-02-21 10:07:59', '2024-02-21 10:07:59');";
        DB::statement($sql2);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
