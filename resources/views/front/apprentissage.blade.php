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
                                <figure>
                                    <a href="#"><img src="{{ asset('storage/' . auth()->user()->photo_url) }}"
                                            style="width: 72px !important; height: 72px !important;" alt=""></a>
                                </figure>
                                <div class="wm-student-nav-text">
                                    <h6>{{ auth()->user()->nom_utilisateur }}</h6>
                                    <a href="#">update image</a>
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
                        <div class="wm-plane-title">
                            <h2>Mon apprentissage</h2>
                        </div>
                        <div class="wm-courses wm-courses-popular wm-courses-mediumsec">
                            <ul class="row">
                                @foreach ($formations as $formation)
                                    <li class="col-md-12">
                                        <div class="wm-courses-popular-wrap">
                                            <figure> <a href="{{ route('formations.show', $formation->slug) }}"><img
                                                        src="{{ asset('storage/' . $formation->photo_url) }}"
                                                        style="width: 265px !important; height: 187px !important;"
                                                        alt=""> <span class="wm-popular-hover"> <small>Voir
                                                            formation</small> </span> </a>
                                                <figcaption>
                                                    <img src="{{ asset('storage/' . $formation->user->photo_url) }}"
                                                        style="width: 60px !important; height: 60px !important;" alt="">
                                                    <h6><a>{{ $formation->user->nom_utilisateur }}</a></h6>
                                                </figcaption>
                                            </figure>
                                            <div class="wm-popular-courses-text">
                                                <h6><a
                                                        href="{{ route('formations.show', $formation->slug) }}">{{ $formation->nom }}</a>
                                                </h6>
                                                <p>{{ Str::substr($formation->description, 0, 100) }}</p>
                                                <div class="wm-courses-price"> <span>{{ $formation->prix }} DT</span>
                                                </div>
                                                <ul>
                                                    <li><a href="{{ route('formations.show', $formation->slug) }}"
                                                            class="wm-color"><i
                                                                class="fas fa-users"></i>{{ count($formation->payements) }}</a>
                                                    </li>
                                                    <li><a href="{{ route('formations.show', $formation->slug) }}"
                                                            class="wm-color"><i class="far fa-clock"></i> 1hr 30</a>
                                                    </li>
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
