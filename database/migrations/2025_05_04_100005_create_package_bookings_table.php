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
        Schema::create('package_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('proof');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_tour_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_bank_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('total_amount');
            $table->unsignedInteger('insuance');
            $table->unsignedInteger('tax');
            $table->unsignedInteger('sub_total');
            $table->boolean('is_paid');
            $table->date('start_date');
            $table->date('end_date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_bookings');
    }
};
