<x-app-layout>
    <!--// Mini Header \\-->
    <div class="wm-mini-header">
        <span class="wm-blue-transparent"></span>
         <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wm-mini-title">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="wm-breadcrumb">
                        <ul>
                            <li><a href="{{ route('home') }}">Accueil</a></li>
                            <li><a href="">Dashboard</a></li>
                            <li>Mes formations</li>
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

                    <aside class="col-md-4">
                        <div class="wm-student-dashboard-nav">
                            <div class="wm-student-nav">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <figure>
                                    <a><img src="{{ asset('storage/'.auth()->user()->photo_url) }}" style="width: 72px !important; height: 72px !important;" alt=""></a>
                                </figure>
                                <div class="wm-student-nav-text">
                                    <h6>{{ auth()->user()->nom_utilisateur }}</h6>
                                    <form action="{{ route('change_photo') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <a>
                                            <input id="profile_picture" style="width:130% !important;" name="photo" type="file">Modifier photo de profile
                                            <input type="submit" value="Modifier photo" class="btn btn-sm btn-success" id="submit_profile_photo">
                                        </a>
                                    </form>
                                </div>
                                <ul>
                                    <li class="{{ Route::is('profile.show') ? 'active' : '' }}">
                                        <a href="{{ route('profile.show') }}">
                                            <i class="far fa-user"></i>
                                            Modifier Profile
                                        </a>
                                    </li>
                                    @role('tuteur')
                                        <li class="{{ Route::is('MesFormations') ? 'active' : '' }}">
                                            <a href="{{ route('MesFormations') }}">
                                                <i class="fas fa-book"></i>
                                                Mes Formations
                                            </a>
                                        </li>
                                    @endrole

                                    @unlessrole('admin')
                                    <li class="{{ Route::is('apprentissage') ? 'active' : '' }}">
                                        <a href="{{ route('apprentissage') }}">
                                            <i class="fas fa-book"></i>
                                            Mon Apprentissage
                                        </a>
                                    </li>
                                    @endunlessrole
                                    <li>
                                        <a onclick="document.getElementById('logout').submit()">
                                            <i class="fas fa-sign-out-alt"></i>
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </aside>

                    <div class="col-md-8">
                        <div class="wm-plane-title"> <h2>Mes formations</h2> </div>
                        <a href="{{ route('CreerFormation') }}" class="btn btn-primary mb-4 float-right" style="margin-bottom: 20px !important; float: right !important;">Creer Formation </a>
                        <div class="wm-courses wm-courses-popular wm-courses-mediumsec">
                            <ul class="row">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                @foreach ($formations as $formation)
                                    <li class="col-md-12">
                                        <div class="wm-courses-popular-wrap">
                                            <figure> <a href="{{ route('formations.show', $formation->slug) }}"><img src="{{ asset('storage/'.$formation->photo_url) }}" style="width: 265px !important; height: 187px !important;" alt=""> <span class="wm-popular-hover"> <small>Voir formation</small> </span> </a>
                                                <figcaption>
                                                    <img src="{{ asset('storage/'.$formation->user->photo_url) }}" style="width: 60px !important; height: 60px !important;" alt="">
                                                    <h6><a>{{ $formation->user->nom_utilisateur }}</a></h6>
                                                </figcaption>
                                            </figure>
                                            <div class="wm-popular-courses-text">
                                                <h6><a href="{{ route('formations.show', $formation->slug) }}">{{ $formation->nom }}</a></h6>
                                                <p>{{ Str::substr($formation->description, 0, 100) }}</p>
                                                <div class="wm-courses-price"> <span>{{ $formation->prix }} DT</span> </div>
                                                <ul style="margin-top: 20px !important;">
                                                    <li><a href="{{ route('formations.edit', $formation->slug) }}" class="btn btn-primary btn-sm">Modifier formation</a></li>
                                                    <li><a href="{{ route('chapitres.index', [$formation->slug]) }}" class="btn btn-success btn-sm">Voir Chapitres</a></li>
                                                    <li><a href="" class="btn btn-danger btn-sm">Supprimer formation</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    {{ $formations->links() }}
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    <!--// Main Content \\-->
</x-app-layout>

<script>
    if($('#profile_photo').files.length == 0){
        $('#submit_profile_photo').hide();
    }
    else {
        $('#submit_profile_photo').show();
    }
</script>
