
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Si la tabla ya existe, no modificarla.
        // Esto conserva los registros actuales.
        if (Schema::hasTable('personal')) {
            return;
        }

        Schema::create('personal', function (Blueprint $table) {
            $table->integer('ID')->primary();

            $table->string('apellido', 20);
            $table->string('nombre', 20);
            $table->date('fecha_nacimiento');
            $table->integer('codigo_estudiantil');
            $table->string('programa', 25);
            $table->integer('semestre');
            $table->string('correo', 40)->unique();
            $table->string('telefono', 20);
            $table->string('direccion', 30);
        });
    }

    public function down(): void
    {
        // No eliminar la tabla existente ni sus registros.
    }
};
