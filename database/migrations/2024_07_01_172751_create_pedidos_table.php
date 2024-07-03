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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('fecha_ped');
            $table->string('nombre_ped');
            $table->string('cedula_ped');
            $table->string('telefono_ped');
            $table->string('email_ped');
            $table->float('total_ped');
            
            $table->foreignId('id_cli')
                    ->nullable()
                    ->constrained('clientes')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
