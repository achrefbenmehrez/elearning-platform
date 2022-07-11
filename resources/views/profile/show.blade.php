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
                            <li><a href="index-2.html">Accueil</a></li>
                            <li><a href="index-2.html">Dashboard</a></li>
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

                                    @role('admin')
                                        <li>
                                            <a href="{{ route('admin.dashboard') }}">
                                                <i class="fas fa-cogs"></i>
                                                Dashboard
                                            </a>
                                        </li>
                                    @endrole

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
                        <div class="wm-plane-title"> <h2>Modifier profile</h2> </div>
                        <div class="wm-courses wm-courses-popular wm-courses-mediumsec">
                            <ul class="row">
                                <li class="col-md-12">
                                    <div class="wm-courses-popular-wrap mt-2 mb-2">
                                        <form action="{{ route('change_infos') }}" method="POST">
                                            @csrf
                                            <div class="form-row">
                                                @if (session('status'))
                                                    <div class="alert alert-success" role="alert">
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
                                                <div class="form-group col-md-6">
                                                <label for="inputEmail4">Nom d'utilisateur</label>
                                                <input type="text" class="form-control" id="inputEmail4" name="nom_utilisateur" value="{{ auth()->user()->nom_utilisateur }}" placeholder="Nom utilisateur">
                                                </div>
                                                <div class="form-group col-md-6">
                                                <label for="inputPassword4">Email</label>
                                                <input type="email" class="form-control" name="email" id="inputPassword4" value="{{ auth()->user()->email }}" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="row gutters">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="text-right mb-2 mr-2">
                                                        <a href="{{ route('home') }}" type="button" id="submit" name="submit" class="btn btn-danger">Annuler</a>
                                                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Modifier</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>

                                <li class="col-md-12">
                                    <div class="wm-courses-popular-wrap mt-2 mb-2">
                                        <form action="{{ route('change_password') }}" method="POST">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-4 mb-3">
                                                <label for="inputEmail4">Ancien Mot de passe</label>
                                                <input type="password" class="form-control" id="inputEmail4" name="current_password" placeholder="Mot de passe">
                                                </div>
                                                <div class="form-group col-md-4 mb-3">
                                                <label for="inputPassword4">Nouveau mot de passe</label>
                                                <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Nouveau mot de passe">
                                                </div>
                                                <div class="form-group col-md-4 mb-3">
                                                    <label for="inputPassword4">Confirmer mot de passe</label>
                                                    <input type="password" class="form-control" name="password_confirmation" id="inputPassword4" placeholder="Confirmation">
                                                </div>
                                            </div>
                                            <div class="row gutters">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="text-right mb-2 mr-2">
                                                        <a href="{{ route('home') }}" type="button" id="submit" name="submit" class="btn btn-danger">Annuler</a>
                                                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Modifier</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
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

<script>
    if($('#profile_photo').files.length == 0){
        $('#submit_profile_photo').hide();
    }
    else {
        $('#submit_profile_photo').show();
    }
</script>
