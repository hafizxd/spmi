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
        Schema::create('mechanisms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_id')->constrained('audits', 'id')->onDelete('cascade');
            $table->string('name');
            $table->boolean('is_yes')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mechanisms');
    }
};
