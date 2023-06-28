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
        Schema::create('mail_templates', function (Blueprint $table) {
            $table->id();

            $table->string('identifier')->unique();

            $table->string('from_name')->nullable();
            $table->string('from_email')->nullable();
            $table->string('to_email')->nullable();

            $table->json('subject')->nullable();
            $table->json('body')->nullable();
            $table->json('online')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_templates');
    }
};
