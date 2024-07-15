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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_pro');
            $table->string('descripcion_pro');
            $table->float('precio_pro');
            $table->boolean('disponibilidad_pro')->default(true);
            $table->string('imagenRef_pro');
            
            $table->foreignId('id_categoria')
                    ->nullable()
                    ->constrained('categorias')
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
        Schema::dropIfExists('productos');
    }
};
