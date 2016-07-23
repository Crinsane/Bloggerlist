<?php

// Home
Breadcrumbs::register('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('home'));
});

// Home > Settings
Breadcrumbs::register('settings', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Settings', '/settings');
});

// Home > Kiosk
Breadcrumbs::register('kiosk', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Kiosk', '/spark/kiosk');
});

// Home > Projects
Breadcrumbs::register('projects.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Projects', '/projects');
});

// Home > Projects > New project
Breadcrumbs::register('projects.create', function ($breadcrumbs) {
    $breadcrumbs->parent('projects.index');
    $breadcrumbs->push('New project', '/projects/create');
});

// Home > Projects > [Project Title]
Breadcrumbs::register('projects.edit', function ($breadcrumbs, $project) {
    $breadcrumbs->parent('projects.index');
    $breadcrumbs->push($project->title, route('projects.edit', $project));
});