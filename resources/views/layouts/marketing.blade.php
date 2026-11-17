<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Vertical AI Agent') — Industry Workflow Automation</title>
    <meta name="description" content="@yield('meta_description', 'Enterprise vertical AI agent platform for industry-specific workflow automation, modular ops, and measurable time savings across sales, ops, and support.')">
    <meta name="keywords" content="vertical AI agent, workflow automation, industry AI, modular ops, sales automation, support copilot, ROI automation, Laravel Filament">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <style>
        :root {
            --accent: #0F766E;
            --accent-dark: #0B5A54;
            --ink: #0f172a;
            --muted: #475569;
            --sand: #f0fdfa;
            --line: #ccfbf1;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "DM Sans", system-ui, sans-serif;
            color: var(--ink);
            background:
                radial-gradient(1200px 600px at 10% -10%, #99f6e4 0%, transparent 55%),
                radial-gradient(900px 500px at 100% 0%, #5eead4 0%, transparent 45%),
                linear-gradient(180deg, #f8fffd 0%, #ffffff 40%, #f0fdfa 100%);
            min-height: 100vh;
        }
        a { color: var(--accent); text-decoration: none; }
        .wrap { width: min(1120px, 92%); margin: 0 auto; }
        header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.25rem 0; gap: 1rem; flex-wrap: wrap;
        }
        .brand {
            font-family: "Instrument Serif", Georgia, serif;
            font-size: 1.65rem; color: var(--accent-dark); letter-spacing: -0.02em;
        }
        nav { display: flex; gap: 1rem; flex-wrap: wrap; align-items: center; }
        nav a { color: var(--muted); font-weight: 500; font-size: .95rem; }
        nav a:hover { color: var(--accent); }
        .btn {
            display: inline-flex; align-items: center; justify-content: center;
            background: var(--accent); color: #fff !important; border-radius: 999px;
            padding: .7rem 1.2rem; font-weight: 700; border: 0; cursor: pointer;
            box-shadow: 0 10px 30px rgba(15, 118, 110, .25);
        }
        .btn.secondary { background: transparent; color: var(--accent) !important; border: 1.5px solid var(--accent); box-shadow: none; }
        .hero { padding: 3.5rem 0 2.5rem; display: grid; gap: 1.25rem; max-width: 760px; }
        .hero h1 {
            font-family: "Instrument Serif", Georgia, serif;
            font-size: clamp(2.4rem, 5vw, 3.8rem); line-height: 1.08; margin: 0;
            color: var(--ink);
        }
        .hero p { font-size: 1.15rem; color: var(--muted); margin: 0; line-height: 1.6; }
        .cta-row { display: flex; gap: .8rem; flex-wrap: wrap; margin-top: .5rem; }
        .grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }
        .card {
            background: rgba(255,255,255,.82); border: 1px solid var(--line);
            border-radius: 18px; padding: 1.2rem 1.25rem;
            backdrop-filter: blur(6px);
        }
        .card h3 { margin: 0 0 .4rem; font-size: 1.1rem; }
        .card p { margin: 0; color: var(--muted); line-height: 1.5; font-size: .95rem; }
        .section { padding: 2.5rem 0; }
        .section h2 {
            font-family: "Instrument Serif", Georgia, serif;
            font-size: clamp(1.8rem, 3vw, 2.4rem); margin: 0 0 .5rem;
        }
        .eyebrow { color: var(--accent); font-weight: 700; text-transform: uppercase; letter-spacing: .08em; font-size: .75rem; }
        .pill {
            display: inline-block; padding: .2rem .55rem; border-radius: 999px;
            background: #ccfbf1; color: var(--accent-dark); font-size: .75rem; font-weight: 700;
        }
        .pill.off { background: #fee2e2; color: #991b1b; }
        footer { border-top: 1px solid var(--line); margin-top: 3rem; padding: 2rem 0 3rem; color: var(--muted); font-size: .92rem; }
        .kpi { font-size: 1.8rem; font-weight: 700; color: var(--accent-dark); }
        table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 16px; overflow: hidden; }
        th, td { text-align: left; padding: .85rem 1rem; border-bottom: 1px solid var(--line); font-size: .95rem; }
        th { background: #ecfdf5; color: var(--accent-dark); }
    </style>
</head>
<body>
<div class="wrap">
    <header>
        <a class="brand" href="{{ route('home') }}">Vertical AI Agent</a>
        <nav>
            <a href="{{ route('features') }}">Features</a>
            <a href="{{ route('modules') }}">Modules</a>
            <a href="{{ route('workflows') }}">Workflows</a>
            <a href="{{ route('agents') }}">Agents</a>
            <a href="{{ route('pricing') }}">Pricing / ROI</a>
            <a href="{{ route('demo') }}">Demo</a>
            <a class="btn" href="/admin">Admin Login</a>
        </nav>
    </header>

    @yield('content')

    <footer>
        <strong style="color:var(--ink)">Vertical AI Agent</strong> — industry-specific workflow automation by
        <a href="https://imrandev.bd">Imran Ahmed</a> · <a href="https://imrandev.bd/contact">Contact</a>
    </footer>
</div>
</body>
</html>
