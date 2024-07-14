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
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cycle_id')->constrained('cycles', 'id')->onDelete('cascade');
            $table->foreignId('jurusan_id')->constrained('jurusan', 'id')->onDelete('cascade');
            $table->foreignId('prodi_id')->constrained('prodi', 'id')->onDelete('cascade');
            $table->foreignId('auditor_1_id')->constrained('auditors', 'id')->onDelete('cascade');
            $table->foreignId('auditor_2_id')->constrained('auditors', 'id')->onDelete('cascade');
            $table->foreignId('auditor_3_id')->constrained('auditors', 'id')->onDelete('cascade');
            $table->boolean('is_mechanism')->default(false);
            $table->boolean('is_audit')->default(false);
            $table->boolean('is_conclusion')->default(false);
            $table->date('rtm')->nullable();
            $table->boolean('is_locked')->default(false);
            $table->boolean('is_done')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
