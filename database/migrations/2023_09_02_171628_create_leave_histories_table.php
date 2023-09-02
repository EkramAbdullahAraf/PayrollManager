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
        Schema::create('leave_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leave_request_id')->constrained();
            $table->string('action'); // e.g. 'requested', 'approved', 'rejected'
            $table->foreignId('action_by')->constrained('users'); // user who took the action
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_histories');
    }
};
