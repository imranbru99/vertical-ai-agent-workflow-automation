<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vertical_agents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('specialty')->index();
            $table->foreignId('industry_vertical_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('workflow_id')->nullable()->constrained()->nullOnDelete();
            $table->string('status')->default('idle')->index();
            $table->string('model_provider')->default('openai');
            $table->string('model_name')->default('gpt-4.1');
            $table->text('system_prompt')->nullable();
            $table->json('capabilities')->nullable();
            $table->unsignedInteger('tasks_completed')->default(0);
            $table->decimal('success_rate', 5, 2)->default(0);
            $table->boolean('is_enabled')->default(true);
            $table->timestamps();
        });

        Schema::create('pipelines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('industry_vertical_id')->nullable()->constrained()->nullOnDelete();
            $table->string('stage')->default('intake');
            $table->text('description')->nullable();
            $table->json('stages')->nullable();
            $table->unsignedInteger('items_in_flight')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('automation_runs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workflow_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vertical_agent_id')->nullable()->constrained('vertical_agents')->nullOnDelete();
            $table->foreignId('triggered_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('queued')->index();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->unsignedInteger('duration_seconds')->nullable();
            $table->unsignedInteger('minutes_saved')->default(0);
            $table->json('input_payload')->nullable();
            $table->json('output_payload')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();
        });

        Schema::create('time_saving_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('workflow_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('industry_vertical_id')->nullable()->constrained()->nullOnDelete();
            $table->date('metric_date');
            $table->unsignedInteger('hours_saved')->default(0);
            $table->unsignedInteger('tasks_automated')->default(0);
            $table->decimal('estimated_cost_saved', 12, 2)->default(0);
            $table->string('department')->nullable();
            $table->timestamps();

            $table->index(['metric_date', 'department']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_saving_metrics');
        Schema::dropIfExists('automation_runs');
        Schema::dropIfExists('pipelines');
        Schema::dropIfExists('vertical_agents');
    }
};
