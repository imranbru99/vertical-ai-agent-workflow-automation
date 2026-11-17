<?php

return [
    'name' => 'Vertical AI Agent',
    'tagline' => 'Industry-specific workflow automation that measures every hour saved.',
    'accent' => '#0F766E',
    'hourly_cost_rate' => env('VERTICAL_AI_HOURLY_RATE', 45),
    'monthly_platform_cost' => env('VERTICAL_AI_MONTHLY_COST', 1200),
    'demo' => [
        'email' => env('DEMO_USER_EMAIL', 'demo@vertical-ai.test'),
        'password' => env('DEMO_USER_PASSWORD', 'password'),
    ],
    'modules' => [
        'sales_automation' => ['name' => 'Sales Automation', 'category' => 'sales'],
        'ops_orchestration' => ['name' => 'Ops Orchestration', 'category' => 'operations'],
        'support_copilot' => ['name' => 'Support Copilot', 'category' => 'support'],
        'hr_onboarding' => ['name' => 'HR Onboarding Agent', 'category' => 'hr'],
        'finance_reconcile' => ['name' => 'Finance Reconciliation', 'category' => 'finance'],
        'compliance_audit' => ['name' => 'Compliance Audit Trail', 'category' => 'compliance'],
        'knowledge_rag' => ['name' => 'Knowledge RAG Hub', 'category' => 'knowledge'],
        'attendance_bridge' => ['name' => 'Attendance Machine Bridge', 'category' => 'workforce'],
        'pdf_reporting' => ['name' => 'Unicode PDF Reporting', 'category' => 'reporting'],
        'catalog_scrape' => ['name' => 'AI Catalog Scraper', 'category' => 'data'],
    ],
];
