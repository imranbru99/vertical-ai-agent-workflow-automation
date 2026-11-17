<?php

namespace Tests\Feature;

use App\Services\ModuleRegistry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModuleRegistryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_core_module_cannot_be_disabled(): void
    {
        $registry = app(ModuleRegistry::class);
        $module = $registry->toggle('sales_automation', false);

        $this->assertTrue($module->is_enabled);
        $this->assertTrue($module->is_core);
    }

    public function test_optional_module_can_toggle(): void
    {
        $registry = app(ModuleRegistry::class);
        $module = $registry->toggle('support_copilot', false);

        $this->assertFalse($module->is_enabled);
        $this->assertTrue($registry->toggle('support_copilot', true)->is_enabled);
    }
}
