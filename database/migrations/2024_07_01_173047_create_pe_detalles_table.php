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
        Schema::create('pe_detalles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_pdet');
            $table->float('precio_pdet');
            $table->integer('cantidad_pdet');
            $table->float('subtotal_pdet');
            
            $table->foreignId('id_ped')
                    ->nullable()
                    ->constrained('pedidos')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            
            $table->foreignId('id_pro')
                    ->nullable()
                    ->constrained('productos')
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
        Schema::dropIfExists('pe_detalles');
    }
};
