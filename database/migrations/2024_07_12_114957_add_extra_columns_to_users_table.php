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
        Schema::table('users', function (Blueprint $table) {
            $table->string('blood_group')->nullable();
            $table->string('uniqid')->unique();
            $table->string('phone_number')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->mediumText('bio')->nullable();
            $table->enum('role', ['admin', 'employee', 'mod', 'user', 'suspended'])->default('user');
            $table->string('father_name')->nullable();
            $table->mediumText('address')->nullable();
            $table->date('joining_date')->nullable();
            $table->unsignedBigInteger('user_designation_id')->nullable();
            $table->string('salary')->nullable();
            $table->string('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
