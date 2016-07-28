<?php

// Dashboard
Breadcrumbs::register('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('home'));
});

// Dashboard > Settings
Breadcrumbs::register('settings', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Settings', '/settings');
});

// Dashboard > Kiosk
Breadcrumbs::register('kiosk', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Kiosk', '/spark/kiosk');
});

// Dashboard > Your Projects
Breadcrumbs::register('company.projects.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Your Projects', route('company.projects.index'));
});

// Dashboard > Your Projects > New project
Breadcrumbs::register('company.projects.create', function ($breadcrumbs) {
    $breadcrumbs->parent('company.projects.index');
    $breadcrumbs->push('New Project', route('company.projects.create'));
});

// Dashboard > Your Projects > [Project Title]
Breadcrumbs::register('company.projects.edit', function ($breadcrumbs, $project) {
    $breadcrumbs->parent('company.projects.index');
    $breadcrumbs->push($project->title, route('company.projects.edit', $project));
});

// Dashboard > All Projects
Breadcrumbs::register('projects.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('All Projects', route('projects.index'));
});

// Dashboard > All Projects > [Project Title]
Breadcrumbs::register('projects.show', function ($breadcrumbs, $project) {
    $breadcrumbs->parent('projects.index');
    $breadcrumbs->push($project->title, route('projects.show', $project));
});

// Dashboard > Our Bloggers
Breadcrumbs::register('bloggers.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Our Bloggers', route('bloggers.index'));
});

// Dashboard > Our Bloggers > [Blogger name]
Breadcrumbs::register('bloggers.show', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('bloggers.index');
    $breadcrumbs->push($user->name, route('bloggers.show', $user));
});

// Dashboard > Our Companies
Breadcrumbs::register('companies.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Our Companies', route('companies.index'));
});

// Dashboard > Our Companies > [Company name]
Breadcrumbs::register('companies.show', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('companies.index');
    $breadcrumbs->push($user->title, route('companies.show', $user));
});