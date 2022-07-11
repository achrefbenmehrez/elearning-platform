<x-app-layout>
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css" media="all"
        rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-fa/theme.css"
        media="all" rel="stylesheet" type="text/css" />
    <!--// Mini Header \\-->
    <div class="wm-mini-header">
        <span class="wm-blue-transparent"></span>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wm-mini-title">
                        <h1>Nos Formations</h1>
                    </div>
                    <div class="wm-breadcrumb">
                        <ul>
                            <li><a href="{{ route('home') }}">Accueil</a></li>
                            <li><a href="{{ route('formations.index') }}">Formations</a></li>
                            <li>{{ $formation->nom }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Mini Header \\-->

    <!--// Main Content \\-->
    <div class="wm-main-content">

        <!--// Main Section \\-->
        <div class="wm-main-section">
            <div class="container">
                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <aside class="col-md-3">
                        <div class="widget widget_course-price">
                            <div class="wm-widget-heading">
                                <h4>Prix formation</h4>
                            </div>
                            <span>{{ $formation->prix }} DT</span>
                            <a href="{{ route('addToCart', $formation->slug) }}">Ajouter au panier</a>
                            <ul>
                                <li><a href="#"><i class=" fas fa-users"></i>{{ count($formation->payements) }}</a>
                                </li>
                                <li><a href="#"><i class=" far fa-clock"></i><time datetime="2017-02-14">Duration:
                                            *** min</time></a></li>
                                <li><a href="#"><i class=" fas fa-book"></i>{{ count($formation->episodes) }}
                                        Episodes</a></li>
                                @foreach ($formation->categories as $categorie)
                                    <li><a href="#"><i class=" fab fa-discourse"></i>{{ $categorie->nom }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget widget_futurecourse">
                            <div class="wm-widget-title">
                                <h2>Nouveautes</h2>
                            </div>
                            <ul>
                                @foreach ($nouveautes as $nouveaute)
                                    <li>
                                        <figure>
                                            <a href="{{ route('formations.show', $nouveaute->slug) }}">
                                                <img alt="" src="{{ asset('storage/' . $nouveaute->photo_url) }}"
                                                    style="height: 70px !important; width:70px !important;">
                                            </a>
                                        </figure>
                                        <div class="wm-futurecourse">
                                            <div class="wm-futurecourse-info">
                                                <h4>
                                                    <a
                                                        href="{{ route('formations.show', $nouveaute->slug) }}">{{ $nouveaute->nom }}</a>
                                                </h4>
                                                <br>
                                                <span>{{ $nouveaute->prix }} DT</span>
                                            </div>
                                            <ul>
                                                <li><a><i class="fas fa-users" aria-hidden="true"></i>{{ count($nouveaute->payements) }}</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget widget_categories" style="margin-bottom: 60px !important;">
                            <div class="wm-widget-title">
                                <h2>Categories</h2>
                            </div>
                            <ul>
                                @foreach ($categories as $categorie)
                                    <li><a
                                            href="{{ route('CategorieFormations', $categorie->slug) }}">{{ $categorie->nom }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget widget_professor-info">
                            <div class="wm-widget-title">
                                <h2>Tuteur</h2>
                            </div>
                            <figure>
                                <a><img src="{{ asset('storage/' . $formation->user->photo_url) }}" height="62px"
                                        style="width: 60px !important" width="60px" alt=""></a>
                            </figure>
                            <div class="wm-Professor-info">
                                <h6><a>{{ $formation->user->nom_utilisateur }}</a></h6>
                            </div>
                        </div>
                        <div class="widget widget_latestnews">
                            <div class="wm-widget-title">
                                <h2>Nouveautes forum</h2>
                            </div>
                            <ul>
                                @foreach ($discussions as $discussion)
                                    <li>
                                        <figure>
                                            <a href="{{ route('discussions.show', $discussion->slug) }}"><img
                                                    src="{{ asset('storage/' . $discussion->photo_url) }}"
                                                    style="width: 70px !important; height: 70px !important;" alt=""></a>
                                        </figure>
                                        <div class="wm-latestnews">
                                            <h5><a
                                                    href="{{ route('discussions.show', $discussion->slug) }}">{{ $discussion->title }}</a>
                                            </h5>
                                            <p>{!! Str::substr($discussion->content, 0, 35) !!} ...</p>
                                            <time
                                                datetime="2008-02-14 20:00">{{ $discussion->created_at->format('d/m/Y') }}</time>
                                            <a href="#"><i class="fas fa-users"></i>{{ count($discussion->replies) }}</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                    <div class="col-md-9">
                        <div class="wm-blog-single wm-courses">
                            <figure class="wm-detail-thumb">
                                <img src="{{ asset('storage/' . $formation->photo_url) }}"
                                    style="width: 850px !important; height: 315px;" width="315px" height="850px" alt="">
                            </figure>
                            <div class="wm-blog-author wm-ourcourses">
                                <div class="wm-blogauthor-left">
                                    <img src="{{ asset('storage/' . $formation->user->photo_url) }}"
                                        style="height: 60px !important; height: 62px !important;" alt="">
                                    <a class="wm-authorpost">{{ $formation->user->nom_utilisateur }}</a>
                                </div>
                                <div class="wm-our-courses">
                                    <ul>
                                        <li>
                                            <a><i class="fas fa-eye"></i>{{ $formation->view_count }} Vues</a>
                                        </li>
                                        <li>
                                            <a><i class="fas fa-pen"></i>Quizs: Oui</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="wm-courses-reviewes">
                            <div class="wm-ourcourses-left">
                                <h6>Reviews</h6>
                                <input id="input-4-ltr-star-sm" name="rate" class="rating"
                                    value="{{ $rating_count }}" data-size="xs">
                                <a>{{ $rating_count }} Reviews</a>
                            </div>
                        </div>
                        <div class="wm-our-course-detail">
                            <div class="wm-title-full">
                                <h2>{{ $formation->nom }}</h2>
                            </div>
                            <p class="wm-text">{{ $formation->description }}</p>
                            <div class="wm-courses-info">
                                <div class="wm-title-full">
                                    <h2>Ce que vous allez apprendre</h2>
                                </div>
                                <ul>
                                    @foreach ($formation->categories as $categorie)
                                        <li><a href="{{ route('CategorieFormations', $categorie->slug) }}"
                                                class="fas fa-lock-open"></a>{{ $categorie->nom }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="wm-courses-getting-started">
                            <div class="wm-title-full">
                                <h2>Curriculum</h2>
                            </div>
                            <div class="wm-courses-started">
                                @foreach ($formation->chapitres as $key => $chapitre)
                                    <span data-toggle="collapse" data-target="#collapseExample{{ $chapitre->id }}"
                                        id="collapse{{ $chapitre->id }}" aria-expanded="false"
                                        aria-controls="collapseExample{{ $chapitre->id }}">Chapitre
                                        {{ $key + 1 }}: {{ $chapitre->nom }}</span>
                                    <ul class="wm-courses-started-listing" id="collapseExample{{ $chapitre->id }}"
                                        data-parent="#collapse{{ $chapitre->id }}">
                                        @foreach ($chapitre->episodes as $episode)
                                            <li style="background-color: rgba(246,246,246,1); border-radius: 1rem;">
                                                <a
                                                    href="{{ route('episodes.show', [$formation->slug, $episode->numero]) }}">
                                                    <span class="badge badge-pill badge-secondary"
                                                        style="border-radius: 50%; width: 50px">
                                                        <h3 style="color:white !important;">{{ $episode->numero }}
                                                        </h3>
                                                    </span>
                                                </a>
                                                <div class="wm-courses-started-text">
                                                    <h6><a
                                                            href="{{ route('episodes.show', [$formation->slug, $episode->numero]) }}">{{ $episode->nom }}</a>
                                                    </h6>
                                                    <br>
                                                    <span><a href="{{ route('episodes.show', [$formation->slug, $episode->numero]) }}"
                                                            class="far fa-clock"></a><time
                                                            datetime="2017-02-14">{{ $episode->created_at->format('Y/m/d') }}</time></span>
                                                    <span><a href="{{ route('episodes.show', [$formation->slug, $episode->numero]) }}"
                                                            class=" far fa-clock"></a><time
                                                            datetime="2017-02-14">Duration: 1hr30mins</time></span>
                                                </div>
                                                <div class="wm-courses-preview">
                                                    <a
                                                        href="{{ route('episodes.show', [$formation->slug, $episode->numero]) }}">Regarder</a>
                                                </div>
                                            </li>
                                        @endforeach
                                        @if ($chapitre->tests && $chapitre->tests->published)
                                            <li style="background-color: rgba(246,246,246,1); border-radius: 1rem;"
                                                class="p-4 m-3 color-white shadow-sm episode-container">
                                                <a
                                                    href="{{ route('tests.show', [$formation->slug, $chapitre->id, $chapitre->tests->id]) }}">
                                                    <span class="badge badge-pill badge-secondary"
                                                        style="border-radius: 50%; width: 50px">
                                                        <h3 style="color:white !important;"><i class="fas fa-check"></i>
                                                        </h3>
                                                    </span>
                                                </a>
                                                <div class="wm-courses-started-text">
                                                    <h6><a
                                                            href="{{ route('tests.show', [$formation->slug, $chapitre->id, $chapitre->tests->id]) }}">{{ $chapitre->tests->title }}</a>
                                                    </h6>
                                                    <span><a href="{{ route('tests.show', [$formation->slug, $chapitre->id, $chapitre->tests->id]) }}"
                                                            class="far fa-clock"></a><time
                                                            datetime="2017-02-14">{{ $chapitre->tests->created_at->format('Y/m/d') }}</time></span>
                                                    <span><a href="{{ route('tests.show', [$formation->slug, $chapitre->id, $chapitre->tests->id]) }}"
                                                            class=" far fa-clock"></a></span>
                                                </div>
                                                <div class="wm-courses-preview">
                                                    <a
                                                        href="{{ route('tests.show', [$formation->slug, $chapitre->id, $chapitre->tests->id]) }}">Passer
                                                        le test</a>
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                        <div class="wm-title-full">
                            <h2>Feedback</h2>
                        </div>
                        <div class="wm-courses-rating">
                            <div class="wm-average-rating">
                                <span>Note moyenne</span>
                                <div class="wm-courses-average-rating">
                                    <span>{{ $avg_rating + 0 }}</span>
                                    <small>basée sur</small>
                                    <div class="wm-rating">
                                        <input id="input-3-ltr-star-sm" value="{{ $avg_rating }}" data-size="xs">
                                    </div>
                                    <p>{{ $rating_count }} evaluations</p>
                                </div>
                            </div>
                            <div class="wm-detailed-rating">
                                <span>Detailed Rating</span>
                                <div class="wm-courses-detail-rating">
                                    <ul>
                                        <li>
                                            <span>5 Stars</span>
                                            <div class="wm-rating">
                                                <span class="wm-rating-box" style="width:100%"></span>
                                            </div>
                                            <small>3</small>
                                        </li>
                                        <li>
                                            <span>4 Stars</span>
                                            <div class="wm-rating">
                                                <span class="wm-rating-box" style="width:0%"></span>
                                            </div>
                                            <small>4</small>
                                        </li>
                                        <li>
                                            <span>3 Stars</span>
                                            <div class="wm-rating">
                                                <span class="wm-rating-box" style="width:0%"></span>
                                            </div>
                                            <small>3</small>
                                        </li>
                                        <li>
                                            <span>2 Stars</span>
                                            <div class="wm-rating">
                                                <span class="wm-rating-box" style="width:0%"></span>
                                            </div>
                                            <small>2</small>
                                        </li>
                                        <li>
                                            <span>1 Stars</span>
                                            <div class="wm-rating">
                                                <span class="wm-rating-box" style="width:0%"></span>
                                            </div>
                                            <small>1</small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="wm-form">
                            <div class="wm-widgettitle">
                                <?php $evaluer =
                                auth()->user() &&
                                count(
                                \App\Models\Rating::where('user_id', auth()->user()->id)
                                ->where('formation_id', $formation->id)
                                ->get(),
                                ) > 0; ?>
                                @if (!$evaluer)
                                    <h2>Evaluer la <span>Formation</span></h2>
                                @else
                                    <h2>Merci pour votre <span>Evaluation</span></h2>
                                @endif
                            </div>
                            @if ($evaluer)
                                <?php $user_rating = DB::table('ratings')
                                ->select('value')
                                ->where('user_id', auth()->user()->id)
                                ->where('formation_id', $formation->id)
                                ->get()[0]->value; ?>
                                <input id="input-1-ltr-star-sm" name="rate" class="rating" value="{{ $user_rating }}"
                                    data-size="md">
                            @else
                                <input id="input-2-ltr-star-sm" name="rate" class="rating" value="5" data-size="md">
                            @endif

                            <div class="alert alert-success" role="alert" style="display: none;"></div>
                            <div class="alert alert-danger" role="alert" style="display: none;"></div>
                        </div>
                        <div class="wm-title-full">
                            <h2>Plus visites</h2>
                        </div>
                        <div class="wm-courses wm-courses-popular">
                            <ul class="row">
                                @foreach ($plus_visites as $plus_visite)
                                    <li class="col-md-4">
                                        <div class="wm-courses-popular-wrap">
                                            <figure> <a
                                                    href="{{ route('formations.show', $plus_visite->slug) }}"><img
                                                        src="{{ asset('storage/' . $plus_visite->photo_url) }}"
                                                        style="width: 260px !important; height: 184px !important;"
                                                        alt=""> <span class="wm-popular-hover"> <small>Voir
                                                            formation</small> </span> </a>
                                                <figcaption>
                                                    <img src="{{ asset('storage/' . $plus_visite->user->photo_url) }}"
                                                        height="62px" style="width: 60px !important" width="60px"
                                                        alt="">
                                                    <h6><a>{{ $plus_visite->user->nom_utilisateur }}</a></h6>
                                                </figcaption>
                                            </figure>
                                            <div class="wm-popular-courses-text">
                                                <h6><a href="{{ route('formations.show', $plus_visite->slug) }}">
                                                        {{ $plus_visite->nom }}
                                                    </a>
                                                </h6>
                                                <div class="wm-courses-price"> <span>{{ $plus_visite->prix }}
                                                        DT</span> </div>
                                                <ul>
                                                    <li><a href="{{ route('formations.show', $plus_visite->slug) }}"
                                                            class="wm-color"><i class="fas fa-users"></i>{{ count($plus_visite->payements) }}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

        <!--// Main Section \\-->
    </div>
    <!--// Main Content \\-->
</x-app-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js"
    type="text/javascript" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-fa/theme.js" defer>
</script>

<script defer>
    $(document).ready(function() {
        $('#input-2-ltr-star-sm').rating({
            filledStar: '<i class="fa fa-star"></i>',
            emptyStar: '<i class="fa fa-star-o"></i>',
        });
        $('#input-1-ltr-star-sm').rating({
            filledStar: '<i class="fa fa-star"></i>',
            emptyStar: '<i class="fa fa-star-o"></i>',
            disabled: true,
        });
        $('#input-3-ltr-star-sm').rating({
            filledStar: '<i class="fa fa-star"></i>',
            emptyStar: '<i class="fa fa-star-o"></i>',
            disabled: true,
            showClear: false,
            showCaption: false
        });
        $('#input-4-ltr-star-sm').rating({
            filledStar: '<i class="fa fa-star"></i>',
            emptyStar: '<i class="fa fa-star-o"></i>',
            disabled: true,
        });
        $('.rating-stars').on('click', function() {
            var rate = $('.rating').val();
            $.ajax({
                url: "{{ route('ratings.store', $formation->slug) }}",
                method: "POST",
                data: {
                    rate: rate,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.msg) {
                        $(".alert-success").html(response.msg);
                        $(".alert-success").show();
                        $('#input-2-ltr-star-sm').rating('refresh', {
                            disabled: true,
                            showClear: false,
                            showCaption: true
                        });
                    } else {
                        $(".alert-danger").html(response.error);
                        $(".alert-danger").show();
                        $('#input-2-ltr-star-sm').rating('refresh', {
                            disabled: true,
                            showClear: false,
                            showCaption: true
                        });
                    }
                }
            });
        });

        $("#input-4-ltr-star-sm").remove();
        $('.clear-rating').remove();
    });

</script>
