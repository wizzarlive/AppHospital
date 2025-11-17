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
            $table->foreignId('patient_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('restrict');
            $table->foreignId('specialty_id')->constrained()->onDelete('restrict');

            $table->date('appointment_date');
            $table->time('appointment_time');

            $table->enum('status', ['scheduled', 'confirmed', 'completed', 'canceled', 'missed'])
                  ->default('scheduled');
            $table->string('cancellation_reason')->nullable();
            
            // INDICE CLAVE para control de disponibilidad
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
