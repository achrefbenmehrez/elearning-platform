<x-app-layout>

    <style>
        .active-channel {
            background-color: rgba(237, 237, 237, 1);
            color: black;
        }

    </style>

    <!--// Mini Header \\-->
    <div class="wm-mini-header">
        <span class="wm-blue-transparent"></span>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wm-mini-title">
                        <h1>Forum</h1>
                    </div>
                    <div class="wm-breadcrumb">
                        <ul>
                            <li><a href="{{ route('home') }}">Accueil</a></li>
                            <li><a href="{{ route('discussions.index') }}">Forum</a></li>
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

                    <aside class="col-md-3">
                        <div class="widget widget_categories">
                            <div class="wm-widget-title">
                                <h2>Chaines</h2>
                            </div>
                            <ul>
                                <li><a href="{{ route('discussions.index') }}"
                                        class="nav-link nav-link-faded has-icon {{ empty(request()->query('channel')) ? 'active-channel' : '' }}">Toutes
                                        les chaines</a></li>
                                @foreach ($channels as $channel)
                                    <li><a href="{{ route('discussions.index') }}?channel={{ $channel->slug }}"
                                            class="nav-link nav-link-faded has-icon {{ request()->query('channel') == $channel->slug ? 'active-channel' : '' }}">{{ $channel->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget widget_tags">
                            <div class="wm-widget-title">
                                <h2>Categories</h2>
                            </div>
                            <div class="tags">
                                @foreach ($categories as $categorie)
                                    <a
                                        href="{{ route('CategorieFormations', $categorie->slug) }}">{{ $categorie->nom }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="widget widget_latestnews">
                            <div class="wm-widget-title">
                                <h2>Formations recentes</h2>
                            </div>
                            <ul>
                                @foreach ($nouveautes as $nouveaute)
                                    <li>
                                        <figure>
                                            <a href="{{ route('formations.show', $nouveaute->slug) }}"><img
                                                    src="{{ asset('storage/' . $nouveaute->photo_url) }}" alt=""
                                                    style="height: 70px !important; width:70px !important;"></a>
                                        </figure>
                                        <div class="wm-latestnews">
                                            <h5><a
                                                    href="{{ route('formations.show', $nouveaute->slug) }}">{{ $nouveaute->nom }}</a>
                                            </h5>
                                            <p>{{ Str::substr($nouveaute->description, 0, 100) }} ...</p>
                                            <time
                                                datetime="2008-02-14 20:00">{{ $nouveaute->created_at->format('d/m/Y') }}</time>
                                            <a href="{{ route('formations.show', $nouveaute->slug) }}"><i
                                                    class="fas fa-users"></i>{{ count($nouveaute->payements) }}</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                    <div class="col-md-9">
                        <a href="{{ route('discussions.create') }}" class="btn btn-success"
                            style="margin-bottom: 20px !important; float: right !important;">
                            Creer une discussion
                        </a>

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="wm-news wm-news-medium">
                            <ul class="row">
                                @foreach ($discussions as $discussion)
                                    <li class="col-md-12">
                                        <form action="{{ route('admin.discussions.destroy', $discussion) }}"
                                            id="discussion{{ $discussion->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <figure>
                                                <a href="{{ route('discussions.show', $discussion->slug) }}"><img
                                                        src="{{ asset('storage/' . $discussion->photo_url) }}"
                                                        style="height: 214px !important; width: 365px !important;"
                                                        alt=""> <span class="wm-transparent-hover"></span> </a>
                                                <figcaption class="wm-bgcolor">
                                                    <img src="{{ asset('storage/' . $discussion->author->photo_url) }}"
                                                        style="height: 60px !important; width: 60px !important;" alt="">
                                                    <h6>Publié par: <a
                                                            href="{{ route('discussions.show', $discussion->slug) }}">{{ $discussion->author->nom_utilisateur }}</a>
                                                    </h6>
                                                </figcaption>
                                            </figure>
                                            <div class="wm-newsgrid-text">
                                                <ul class="wm-post-options">
                                                    <li>{{ $discussion->created_at->format('d/m/Y') }}</li>
                                                    <li><a href="#"><i class="fas fa-comment"></i>
                                                            {{ count($discussion->replies) }} Reponses</a></li>
                                                    <li><a href="#"><i class="fas fa-folder-open"></i>
                                                            {{ $discussion->channel->name }} </a></li>
                                                    @role('admin')
                                                    <li><button class="btn btn-danger btn-sm"
                                                            style="color: white !important;">Supprimer</button></li>
                                                    @endrole
                                                </ul>
                                                <h5><a href="#" class="wm-color">{{ $discussion->title }}</a></h5>
                                                <p>{!! Str::substr($discussion->content, 0, 100) !!}</p>
                                                <a class="wm-banner-btn"
                                                    href="{{ route('discussions.show', $discussion->slug) }}">Voir
                                                    discussion</a>
                                            </div>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        {{ $discussions->links() }}
                        <div class="wm-pagination">
                            <ul>
                                <li><a href="#" aria-label="Previous"> <i class="wmicon-arrows4"></i> Previous</a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li>...</li>
                                <li><a href="#">18</a></li>
                                <li><a href="#" aria-label="Next"> <i class="wmicon-arrows4"></i> Next</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    <!--// Main Content \\-->

</x-app-layout>
