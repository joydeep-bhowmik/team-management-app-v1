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
        Schema::create('employee_relatives', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->mediumText('address');
            $table->enum('relation_type', ['spouse', 'mother', 'father', 'guardian']);
            $table->boolean('is_nominee')->default(false);
            $table->string('phone_number');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_relatives');
    }
};
