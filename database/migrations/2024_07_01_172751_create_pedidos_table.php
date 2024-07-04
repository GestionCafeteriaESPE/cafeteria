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
            $table->date('fecha_ped');
            $table->string('nombre_ped');
            $table->string('cedula_ped');
            $table->string('telefono_ped')->nullable();
            $table->string('email_ped')->nullable();
            $table->decimal('total_ped',6,2);
            $table->string('modoPago_ped');
            $table->boolean('estado_ped')->default(false);
            
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
