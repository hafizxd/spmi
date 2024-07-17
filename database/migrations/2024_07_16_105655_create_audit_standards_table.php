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
        Schema::create('audit_standards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_id')->constrained('audits', 'id')->onDelete('cascade');
            $table->foreignId('standard_id')->constrained('standards', 'id')->onDelete('cascade');
            $table->tinyInteger('repairment_status')->nullable();
            $table->foreignId('incompatibility_id')->nullable()->constrained('incompatibilities', 'id')->onDelete('cascade');
            $table->text('incompatibility_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_standards');
    }
};
