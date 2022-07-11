<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

// Home
Breadcrumbs::for('Accueil', function ($trail) {
    $trail->push('Accueil', route('home'));
});

//Tuteur

// Home > Formations
Breadcrumbs::for('Formations', function ($trail) {
    $trail->parent('Accueil');
    $trail->push('Formations', route('MesFormations'));
});

// Home > Formations > [Chapitres]
Breadcrumbs::for('Chapitres', function ($trail, $formation) {
    $trail->parent('Formations');
    $trail->push('Chapitres', route('chapitres.index', $formation->slug));
});

// Home > Formations > [Chapitres] > [Episodes]
Breadcrumbs::for('Episodes', function ($trail, $formation, $chapitre) {
    $trail->parent('Chapitres', $formation);
    $trail->push('Episodes', route('episodes.index', [$formation->slug, $chapitre->id]));
});

// Home > Formations > [Chapitres] > [Questions]
Breadcrumbs::for('Questions', function ($trail, $formation, $chapitre, $test) {
    $trail->parent('Chapitres', $formation, $chapitre);
    $trail->push('Questions', route('questions.index', [$formation->slug, $chapitre->id, $test->id]));
});

// Home > Formations > [Chapitres] > [Questions] > [Options]
Breadcrumbs::for('Options', function ($trail, $formation, $test, $question) {
    $trail->parent('Questions', $formation, $test->chapitre, $test);
    $trail->push('Options', route('options.index', [$formation->slug, $test->id, $question->id]));
});


//Client

// Home > Formationss
Breadcrumbs::for('Toutes les formations', function ($trail) {
    $trail->parent('Accueil');
    $trail->push('Toutes les formations', route('formations.index'));
});

// Home > Formations > [Chapitres]
Breadcrumbs::for('formation', function ($trail, $formation) {
    $trail->parent('Toutes les formations');
    $trail->push($formation->nom, route('chapitres.index', $formation->slug));
});
