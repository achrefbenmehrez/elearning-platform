<?php

    use Illuminate\Support\Facades\Route;


    /*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::group(['middleware' => 'setLocale'], function () {
        //Page d'accueil
        Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::get('/switch-langugage/{lang}', function ($locale) {
            App::setLocale($locale);
            session()->put('locale', $locale);
            return redirect()->back();
        })->name('switch-locale');

        Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
        Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
        Route::get('/propos', [\App\Http\Controllers\HomeController::class, 'propos'])->name('propos');

        //Profile
        Route::post('/profile/photo', [\App\Http\Controllers\Front\ProfileController::class, 'change_photo'])->name('change_photo');
        Route::post('/profile/password', [\App\Http\Controllers\Front\ProfileController::class, 'change_password'])->name('change_password');
        Route::post('/profile/infos', [\App\Http\Controllers\Front\ProfileController::class, 'change_infos'])->name('change_infos');

        //Payement
        Route::get('/payement', [\App\Http\Controllers\Front\PayementController::class, 'create'])->name('PagePayement');
        Route::post('/payement', [\App\Http\Controllers\Front\PayementController::class, 'store'])->middleware(['auth']);

        //Abonnement
        Route::get('/abonnement', [\App\Http\Controllers\Front\AbonnementController::class, 'create'])->middleware(['auth'])->name('abonnements.create');
        Route::post('/abonnement/{type_abonnement_id}', [\App\Http\Controllers\Front\AbonnementController::class, 'store'])->middleware(['auth'])->name('abonnements.store');

        //Rechercher une formation
        Route::get('/search', [\App\Http\Controllers\Front\SearchController::class, 'search'])->name('search');

        Route::get('/autocomplete', [\App\Http\Controllers\Front\SearchController::class, 'autocomplete'])->name('autocomplete'); //Instead of Theme your Controller name

        //Panier
        Route::get('cart', [\App\Http\Controllers\Front\FormationController::class, 'Cart'])->name('cart.show');
        Route::get('add-to-cart/{formation:slug}', [\App\Http\Controllers\Front\FormationController::class, 'addToCart'])->name('addToCart');
        Route::patch('update-cart', [\App\Http\Controllers\Front\FormationController::class, 'updateCart']);
        Route::delete('remove-from-cart', [\App\Http\Controllers\Front\FormationController::class, 'removeFromCart']);
        Route::get('clear-cart', [\App\Http\Controllers\Front\FormationController::class, 'clearCart'])->name('ClearCart');

        //Toutes les formations
        Route::get('/formations', [\App\Http\Controllers\Front\FormationController::class, 'index'])->name('formations.index');

        //Stream episode
        Route::get('stream-episode/{formation:slug}/{episode:numero}', [\App\Http\Controllers\Front\StreamController::class, 'create'])->name('stream.create');

        //Discussions
        Route::resource('discussions', \App\Http\Controllers\Front\DiscussionController::class)->scoped([
            'discussion' => 'slug'
        ]);

        //Replies
        Route::resource('discussions.replies', \App\Http\Controllers\Front\ReplyController::class)->scoped([
            'discussion' => 'slug'
        ]);

        Route::post('discussions/{discussion:slug}/replies/{reply}/mark-as-best-reply', [\App\Http\Controllers\Front\ReplyController::class, 'reply'])->name('BestReply');

        Route::group(['middleware' => 'auth'], function () {

            Route::post('/saveTime/{episode:numero}', [\App\Http\Controllers\Front\VideoController::class, 'store'])->name('video.saveTime');
            Route::get('/getTime/{episode:numero}', [\App\Http\Controllers\Front\VideoController::class, 'show'])->name('video.getTime'); //Route for getting the saved time

            Route::post('/replies/{reply}/like', [\App\Http\Controllers\Front\LikeController::class, 'like'])->name('likes.like');
            Route::post('/replies/{reply}/dislike', [\App\Http\Controllers\Front\LikeController::class, 'dislike'])->name('likes.dislike');
            Route::delete('/replies/{reply}/like', [\App\Http\Controllers\Front\LikeController::class, 'unlike'])->name('likes.unlike');
            Route::delete('/replies/{reply}/dislike', [\App\Http\Controllers\Front\LikeController::class, 'undislike'])->name('likes.undislike');

            Route::group(['middleware' => 'role:tuteur'], function () {
                Route::get('/mes-formations', [\App\Http\Controllers\Front\FormationController::class, 'MesFormations'])->name('MesFormations');
                //formations
                Route::get('/formations/create', [\App\Http\Controllers\Front\FormationController::class, 'create'])->name('CreerFormation');
                Route::post('/formations', [\App\Http\Controllers\Front\FormationController::class, 'store'])->name('formations.store');

                //Tuteur qui a creer la formation
                Route::group(['middleware' => 'MaFormation'], function () {
                    Route::get('/formations/{formation:slug}/edit', [\App\Http\Controllers\Front\FormationController::class, 'edit'])->name('formations.edit');
                    Route::put('/formations/{formation:slug}', [\App\Http\Controllers\Front\FormationController::class, 'update'])->name('formations.update');
                    Route::delete('/formations/{formation}', [\App\Http\Controllers\Front\FormationController::class, 'destroy'])->name('formations.delete');

                    //chapitres
                    Route::resource('formations.chapitres', \App\Http\Controllers\Front\ChapitreController::class)->scoped([
                        'formation' => 'slug'
                    ])
                        ->names([
                            'index' => 'chapitres.index',
                            'create' => 'chapitres.create',
                            'store' => 'chapitres.store',
                            'show' => 'chapitres.show',
                            'edit' => 'chapitres.edit',
                            'update' => 'chapitres.update',
                            'destroy' => 'chapitres.destroy'
                        ]);

                    //episodes
                    Route::get('/formations/{formation:slug}/episodes/create', [\App\Http\Controllers\Front\EpisodeController::class, 'create'])->name('episodes.create');
                    Route::post('/formations/{formation:slug}/episodes', [\App\Http\Controllers\Front\EpisodeController::class, 'store'])->name('episodes.store');
                    Route::get('/formations/{formation:slug}/chapitres/{chapitre}/episodes', [\App\Http\Controllers\Front\EpisodeController::class, 'index'])->name('episodes.index');
                    Route::get('/formations/{formation:slug}/chapitres/{chapitre}/episodes/{episode:numero}/edit', [\App\Http\Controllers\Front\EpisodeController::class, 'edit'])->name('episodes.edit');
                    Route::put('/formations/{formation:slug}/chapitres/{chapitre}/episodes/{episode:numero}', [\App\Http\Controllers\Front\EpisodeController::class, 'update'])->name('episodes.update');
                    Route::delete('/formations/{formation}/chapitres/{chapitre}/episodes/{episode}', [\App\Http\Controllers\Front\EpisodeController::class, 'destroy'])->name('episodes.destroy');

                    //Tests
                    Route::resource('formations.chapitres.tests', \App\Http\Controllers\Front\TestController::class)->scoped([
                        'formation' => 'slug'
                    ])
                        ->except('show')
                        ->names([
                            'index' => 'tests.index',
                            'create' => 'tests.create',
                            'store' => 'tests.store',
                            'show' => 'tests.show',
                            'edit' => 'tests.edit',
                            'update' => 'tests.update',
                            'destroy' => 'tests.destroy'
                        ]);

                    Route::post('/{formation:slug}/activation', [\App\Http\Controllers\Front\TestController::class, 'activation'])->name('test.activation');

                    //Questions
                    Route::resource('formations.chapitres.tests.questions', \App\Http\Controllers\Front\QuestionController::class)->scoped([
                        'formation' => 'slug'
                    ])
                        ->names([
                            'index' => 'questions.index',
                            'create' => 'questions.create',
                            'store' => 'questions.store',
                            'show' => 'questions.show',
                            'edit' => 'questions.edit',
                            'update' => 'questions.update',
                            'destroy' => 'questions.destroy'
                        ]);

                    //Options
                    Route::resource('formations.tests.questions.options', \App\Http\Controllers\Front\OptionController::class)->scoped([
                        'formation' => 'slug'
                    ])
                        ->except('show')
                        ->names([
                            'index' => 'options.index',
                            'create' => 'options.create',
                            'store' => 'options.store',
                            'show' => 'options.show',
                            'edit' => 'options.edit',
                            'update' => 'options.update',
                            'destroy' => 'options.destroy'
                        ]);
                });
            });

            Route::group(['middleware' => 'role:client|tuteur'], function () {
                Route::get('/apprentissage', [\App\Http\Controllers\Front\FormationController::class, 'MonApprentissage'])->name('apprentissage');
                //Pass test
                Route::get('/formations/{formation:slug}/chapitres/{chapitre}/tests/{test}', [\App\Http\Controllers\Front\TestController::class, 'show'])->name('tests.show');

                //Store test results
                Route::post('/formations/{formation:slug}/chapitres/{chapitre}/tests/{test}', [\App\Http\Controllers\Front\TestResultController::class, 'store'])->name('test_result.store');

                //Show test results
                Route::get('/formations/{formation:slug}/chapitres/{chapitre}/tests/{test}/test-results/{testResult}', [\App\Http\Controllers\Front\TestResultController::class, 'show'])->name('test_result.show');
            });

            Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
                Route::get('/', [\App\Http\Controllers\Back\DashboardController::class, 'index'])->name('dashboard');
                Route::resource('users', \App\Http\Controllers\Back\UserController::class);
                Route::resource('categories', \App\Http\Controllers\Back\CategoriesController::class);
                Route::resource('cartes', \App\Http\Controllers\Back\CarteController::class)->only([
                    'index', 'show'
                ]);
                Route::resource('type_abonnements', \App\Http\Controllers\Back\TypeAbonnementController::class)->only([
                    'index', 'show'
                ]);
                Route::resource('formations', \App\Http\Controllers\Back\FormationController::class);
                Route::resource('payements', \App\Http\Controllers\Back\PayementController::class);
                Route::resource('abonnements', \App\Http\Controllers\Back\AbonnementController::class);
                Route::resource('channels', \App\Http\Controllers\Back\ChaineController::class);
                Route::resource('discussions', \App\Http\Controllers\Back\DiscussionController::class);
                Route::resource('replies', \App\Http\Controllers\Back\ReplyController::class);
                Route::resource('ratings', \App\Http\Controllers\Back\RatingController::class);
            });
        });

        //Les formations dans une categorie
        Route::get('/{categorie:slug}', [\App\Http\Controllers\Front\FormationCategorieController::class, 'index'])->name('CategorieFormations');

        Route::get('/formations/{formation:slug}/episodes/{episode:numero}', [\App\Http\Controllers\Front\EpisodeController::class, 'show'])->name('episodes.show');

        Route::get('/formations/{formation:slug}', [\App\Http\Controllers\Front\FormationController::class, 'show'])->name('formations.show');

        //5 star rating
        Route::post('/rating/{formation:slug}', [\App\Http\Controllers\Front\RatingController::class, 'store'])->name('ratings.store');
    });
