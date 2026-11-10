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
        Schema::create('machines', function (Blueprint $table) {
        $table->id();
        $table->foreignId('production_line_id')->constrained('production_lines');
        $table->string('code');
        $table->string('name');
        $table->string('type');
        $table->string('status');
        $table->string('criticality');
        $table->date('installation_date');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
