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
        Schema::create('gps_points', function (Blueprint $table) {
            $table->id();
            $table->decimal('latitude', 10, 7); 
            $table->decimal('longitude', 10, 7);
            $table->decimal('speed_kmh', 8, 2)->default(0);
            $table->decimal('heading', 5, 2)->default(0);
            $table->timestamp('recorded_at');
            $table->foreignId('vehicle_id')->constrained('vehicles')->cascadeOnDelete();
            $table->foreignId('trip_id')->nullable()->constrained('trips')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gps_points');
    }
};
