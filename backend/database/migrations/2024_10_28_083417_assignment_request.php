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
        Schema::create("assignment_requests", function (Blueprint $table) {
            $table->id();

            $table->foreignId("user_request_id");
            $table->foreignId("user_access_id");
            $table->string("location_assignment",255);
            $table->string("reason",255);
            $table->foreignId('status_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_requests');
    }
};
