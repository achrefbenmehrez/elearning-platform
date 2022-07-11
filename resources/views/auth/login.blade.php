<x-app-layout>
        <style>
            .bg-login-image{
                background:url(https://picsum.photos/600/800);background-position:center;background-size:cover
            }
            .bg-register-image{background:url(https://picsum.photos/600/800);background-position:center;background-size:cover}
            .bg-password-image{background:url(https://picsum.photos/600/800);background-position:center;background-size:cover}form.user .custom-checkbox.small label{line-height:1.5rem}form.user .form-control-user{border-radius:10rem;padding:1.5rem 1rem}form.user .btn-user{border-radius:10rem;padding:.75rem 1rem}.btn-google{color:#fff;background-color:#ea4335;border-color:#fff}.btn-google:hover{color:#fff;background-color:#e12717;border-color:#e6e6e6}.btn-google.focus,.btn-google:focus{color:#fff;background-color:#e12717;border-color:#e6e6e6;box-shadow:0 0 0 .2rem rgba(255,255,255,.5)}.btn-google.disabled,.btn-google:disabled{color:#fff;background-color:#ea4335;border-color:#fff}.btn-google:not(:disabled):not(.disabled).active,.btn-google:not(:disabled):not(.disabled):active,.show>.btn-google.dropdown-toggle{color:#fff;background-color:#d62516;border-color:#dfdfdf}.btn-google:not(:disabled):not(.disabled).active:focus,.btn-google:not(:disabled):not(.disabled):active:focus,.show>.btn-google.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(255,255,255,.5)}.btn-facebook{color:#fff;background-color:#3b5998;border-color:#fff}.btn-facebook:hover{color:#fff;background-color:#30497c;border-color:#e6e6e6}.btn-facebook.focus,.btn-facebook:focus{color:#fff;background-color:#30497c;border-color:#e6e6e6;box-shadow:0 0 0 .2rem rgba(255,255,255,.5)}.btn-facebook.disabled,.btn-facebook:disabled{color:#fff;background-color:#3b5998;border-color:#fff}.btn-facebook:not(:disabled):not(.disabled).active,.btn-facebook:not(:disabled):not(.disabled):active,.show>.btn-facebook.dropdown-toggle{color:#fff;background-color:#2d4373;border-color:#dfdfdf}.btn-facebook:not(:disabled):not(.disabled).active:focus,.btn-facebook:not(:disabled):not(.disabled):active:focus,.show>.btn-facebook.dropdown-toggle:focus{box-shadow:0 0 0 .2rem rgba(255,255,255,.5)}.error{color:#5a5c69;position:relative;line-height:1};
        </style>

        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center wm-form-wrap wm-typography-element">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image" style="height: 370px !important; width: 465px !important;"></div>
                                <div class="col-lg-6" style="height: 370px !important; width: 600px !important; padding: 80px 80px !important;">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Bienvenu!</h1>
                                        </div>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li class="text-dark">{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <form class="user" action="{{ route('login') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="nom_utilisateur" placeholder="Nom d'utilisateur" class="form-control form-control-user"
                                                    id="exampleInputEmail">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-user"
                                                    id="exampleInputPassword" placeholder="********">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" style="display: block !important;" for="customCheck">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Se connecter
                                            </button>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="{{ route('password.request') }}">Vous avez oubliez votre mot de passe?</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="{{ route('register') }}">Creer un compte!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
</x-app-layout>



