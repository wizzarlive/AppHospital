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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            
            // 1. CORRECCIÓN: Apuntamos a la tabla 'patients' (tu tabla administrativa)
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->foreignId('specialty_id')->constrained('specialties')->onDelete('cascade');

            $table->date('appointment_date');
            $table->string('appointment_time'); // Usamos string para evitar problemas de formato con el input time

            $table->enum('status', ['scheduled', 'confirmed', 'completed', 'canceled', 'missed'])
                  ->default('scheduled');
            
            $table->string('cancellation_reason')->nullable();
            
            // 2. SOLUCIÓN AL ERROR: Agregamos la columna que falta
            $table->text('observation')->nullable(); 
            
            // Evitar duplicados de horario
            $table->unique(['doctor_id', 'appointment_date', 'appointment_time'], 'unique_doctor_slot');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};