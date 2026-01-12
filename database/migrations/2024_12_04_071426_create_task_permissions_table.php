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
        Schema::create('task_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assigner_designation_id'); // Designation that can assign tasks
            $table->unsignedBigInteger('assignee_designation_id'); // Designation that can be assigned tasks
            $table->timestamps();

            $table->foreign('assigner_designation_id')
                ->references('id')
                ->on('user_designations')
                ->onDelete('cascade');

            $table->foreign('assignee_designation_id')
                ->references('id')
                ->on('user_designations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_permissions');
    }
};
