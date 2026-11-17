<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MarketingPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_home_page_loads(): void
    {
        $this->get('/')->assertOk()->assertSee('Vertical AI Agent');
    }

    public function test_modules_page_lists_toggles(): void
    {
        $this->get('/modules')->assertOk()->assertSee('Sales Automation');
    }

    public function test_demo_page_shows_credentials(): void
    {
        $this->get('/demo')->assertOk()->assertSee(config('vertical-ai.demo.email'));
    }
}
