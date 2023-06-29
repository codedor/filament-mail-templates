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
        Schema::create('mail_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mail_template_id')->nullable()->constrained()->nullOnDelete();
            $table->morphs('mailed_resource');
            $table->json('to_emails');
            $table->json('cc_emails');
            $table->json('bcc_emails');
            $table->string('from_email');
            $table->string('from_name')->nullable();
            $table->string('subject');
            $table->text('content');
            $table->string('locale');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_history');
    }
};
