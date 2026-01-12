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
        Schema::table('user_designations', function (Blueprint $table) {
            $table->integer('CL')->nullable()->default(0);
            $table->integer('EL')->nullable()->default(0);
            $table->integer('SL')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_
        designations', function (Blueprint $table) {
            $table->dropColumn('CL');
            $table->dropColumn('EL');
            $table->dropColumn('SL');
        });
    }
};
