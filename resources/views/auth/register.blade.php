<x-app-layout>
    <style>
        .bg-login-image {
            background: url(https://source.unsplash.com/K4mSJ7kc0As/600x800);
            background-position: center;
            background-size: cover
        }

        .bg-register-image {
            background: url(https://picsum.photos/600/800);
            background-position: center;
            background-size: cover
        }

        .bg-password-image {
            background: url(https://picsum.photos/600/800);
            background-position: center;
            background-size: cover
        }

        form.user .custom-checkbox.small label {
            line-height: 1.5rem
        }

        form.user .form-control-user {
            border-radius: 10rem;
            padding: 1.5rem 1rem
        }

        form.user .btn-user {
            border-radius: 10rem;
            padding: .75rem 1rem
        }

        .btn-google {
            color: #fff;
            background-color: #ea4335;
            border-color: #fff
        }

        .btn-google:hover {
            color: #fff;
            background-color: #e12717;
            border-color: #e6e6e6
        }

        .btn-google.focus,
        .btn-google:focus {
            color: #fff;
            background-color: #e12717;
            border-color: #e6e6e6;
            box-shadow: 0 0 0 .2rem rgba(255, 255, 255, .5)
        }

        .btn-google.disabled,
        .btn-google:disabled {
            color: #fff;
            background-color: #ea4335;
            border-color: #fff
        }

        .btn-google:not(:disabled):not(.disabled).active,
        .btn-google:not(:disabled):not(.disabled):active,
        .show>.btn-google.dropdown-toggle {
            color: #fff;
            background-color: #d62516;
            border-color: #dfdfdf
        }

        .btn-google:not(:disabled):not(.disabled).active:focus,
        .btn-google:not(:disabled):not(.disabled):active:focus,
        .show>.btn-google.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(255, 255, 255, .5)
        }

        .btn-facebook {
            color: #fff;
            background-color: #3b5998;
            border-color: #fff
        }

        .btn-facebook:hover {
            color: #fff;
            background-color: #30497c;
            border-color: #e6e6e6
        }

        .btn-facebook.focus,
        .btn-facebook:focus {
            color: #fff;
            background-color: #30497c;
            border-color: #e6e6e6;
            box-shadow: 0 0 0 .2rem rgba(255, 255, 255, .5)
        }

        .btn-facebook.disabled,
        .btn-facebook:disabled {
            color: #fff;
            background-color: #3b5998;
            border-color: #fff
        }

        .btn-facebook:not(:disabled):not(.disabled).active,
        .btn-facebook:not(:disabled):not(.disabled):active,
        .show>.btn-facebook.dropdown-toggle {
            color: #fff;
            background-color: #2d4373;
            border-color: #dfdfdf
        }

        .btn-facebook:not(:disabled):not(.disabled).active:focus,
        .btn-facebook:not(:disabled):not(.disabled):active:focus,
        .show>.btn-facebook.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(255, 255, 255, .5)
        }

        .error {
            color: #5a5c69;
            position: relative;
            line-height: 1
        }

        ;
    </style>

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row wm-form-wrap wm-typography-element">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"
                        style="height: 500px !important; width: 465px !important;"></div>
                    <div class="col-lg-7"
                        style="height: 500px !important; width: 600px !important; padding: 60px 90px !important;"">
                            <div class="  p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4" style="margin-bottom: 30px !important;">Creer un compte!
                            </h1>
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
                        <form class="user" action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="nom"
                                    id="exampleInputEmail" placeholder="Nom">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="prenom"
                                    id="exampleInputEmail" placeholder="Prenom">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" name="email"
                                    id="exampleInputEmail" placeholder="Email">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" name="password" placeholder="Mot de passe">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleRepeatPassword" name="password_confirmation"
                                        placeholder="Confirmation mot de passe">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Creer un compte
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{ route('password.request') }}">Vous avez oublier votre
                                mot de passe?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{ route('login') }}">Vous avez deja un compte? Se
                                connecter!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</x-app-layout>
