<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workflows', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('industry_vertical_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('module_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('owner_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('draft')->index();
            $table->string('trigger_type')->default('manual');
            $table->text('description')->nullable();
            $table->json('definition')->nullable();
            $table->unsignedInteger('steps_count')->default(0);
            $table->unsignedInteger('runs_count')->default(0);
            $table->decimal('avg_minutes_saved', 8, 2)->default(0);
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });

        Schema::create('workflow_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workflow_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('step_type')->default('action');
            $table->unsignedInteger('position')->default(0);
            $table->json('config')->nullable();
            $table->unsignedInteger('estimated_seconds')->default(30);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workflow_steps');
        Schema::dropIfExists('workflows');
    }
};
