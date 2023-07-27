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
        Schema::create('application_keys', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('app-id')->unique();
            $table->string('app-secret')->unique();
            $table->string('obsoletd')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_keys');
    }
};
