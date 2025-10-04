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
        Schema::create('campaign_validators_users', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_id');
            $table->unsignedBigInteger('invited_by');
            $table->string('invite_email');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('token');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->dateTime('accepted_at')->nullable();
            $table->timestamps();

            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
            $table->foreign('invited_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_validators_users');
    }
};
