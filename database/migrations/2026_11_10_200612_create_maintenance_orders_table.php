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
        Schema::create('maintenance_orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('machine_id')->constrained('machines');
        $table->string('order_number');
        $table->string('maintenance_type');
        $table->text('description');
        $table->string('status');
        $table->decimal('estimated_cost', 10, 2);
        $table->decimal('actual_cost', 10, 2)->nullable();
        $table->string('technician');
        $table->date('scheduled_at');
        $table->date('completed_at')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_orders');
    }
};
