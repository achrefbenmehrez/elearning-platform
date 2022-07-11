<!--// Header \\-->
<header id="wm-header" class="wm-header-one">
    <style>
        .badge {
            padding-left: 9px;
            padding-right: 9px;
            -webkit-border-radius: 9px;
            -moz-border-radius: 9px;
            border-radius: 9px;
        }

        .label-warning[href],
        .badge-warning[href] {
            background-color: #c67605;
        }

        #lblCartCount {
            font-size: 12px;
            background: #b99663;
            color: #fff;
            padding: 0 5px;
            vertical-align: top;
        }
    </style>
    <!--// TopStrip \\-->
    <div class="wm-topstrip">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wm-language">
                        <ul>
                            <li><a href="{{ route('switch-locale', 'fr') }}">{{ __('messages.Francais') }}</a></li>
                            <li><a href="{{ route('switch-locale', 'en') }}">{{ __('messages.Anglais') }}</a></li>
                        </ul>
                    </div>
                    <ul class="wm-stripinfo">
                        <li><i class="fas fa-map-marker-alt"></i> 17, 1005 Avenue Belhassen Ben Chaabane, Tunis</li>
                        <li><i class="fas fa-phone"></i> +216 71 783 055</li>
                        <li><a href="http://www.cni.tn" style="color: white !important;"><i class="fa fa-globe"></i>
                                www.cni.tn</a></li>
                    </ul>
                    <ul class="wm-adminuser-section">
                        @guest
                            <li>
                                <a href="#" data-toggle="modal" data-target="#ModalLogin">{{ __('messages.connecter') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}">S'inscrire</a>
                            </li>
                        @else
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                            <li>
                                <a onclick="document.getElementById('logout').submit()">{{ __('messages.deconnecter') }}</a>
                            </li>
                        @endguest
                        <li>
                            <a href="#" class="wm-search-btn" data-toggle="modal" data-target="#ModalSearch"><i
                                    class="fas fa-search"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--// TopStrip \\-->

    <!--// MainHeader \\-->
    <div class="wm-main-header">
        <div class="container">
            <div class="row">
                <div class="col-md-3"><a href="{{ route('home') }}" class="wm-logo"><img
                            src="{{ asset('storage/Forminy (4).gif') }}" alt=""></a></div>
                <div class="col-md-9">
                    <!--// Navigation \\-->
                    <nav class="navbar navbar-default" style="margin: auto !important;">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#navbar-collapse-1" aria-expanded="true">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="active"><a
                                        href="{{ route('home') }}">{{ __('messages.Accueil') }}</a>
                                </li>
                                <li><a href="{{ route('formations.index') }}">{{ __('messages.Formations') }}</a>
                                </li>
                                <li><a>{{ __('messages.Categories') }}</a>
                                    <ul class="wm-dropdown-menu">
                                        <?php
                                        $categories = App\Models\Categorie::get();
                                        ?>
                                        @foreach ($categories as $categorie)
                                            <li><a
                                                    href="{{ route('CategorieFormations', $categorie->slug) }}">{{ $categorie->nom }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li><a href="{{ route('discussions.index') }}">
                                        {{ __('messages.Forum') }}
                                    </a>

                                <li><a>{{ __('messages.Contact') }}</a>
                                    <ul class="wm-dropdown-menu">
                                        <li><a
                                                href="{{ route('contact.index') }}">{{ __('messages.Contacteznous') }}</a>
                                        </li>
                                        <li><a href="{{ route('propos') }}">{{ __('messages.Apropos') }}</a></li>
                                    </ul>
                                </li>

                                @auth
                                    <li><a><i class="fas fa-user"></i></a>
                                        <ul class="wm-dropdown-menu">
                                            @role('tuteur')
                                                <li><a
                                                        href="{{ route('MesFormations') }}">{{ __('messages.MesFormations') }}</a>
                                                </li>
                                            @endrole
                                            @unlessrole('admin')
                                                <li><a
                                                        href="{{ route('apprentissage') }}">{{ __('messages.MonApprentissage') }}</a>
                                                </li>
                                            @endunlessrole
                                            @role('admin')
                                                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                            @endrole
                                            <li><a href="{{ route('profile.show') }}">Profile</a></li>
                                            <form id="logout" action="{{ route('logout') }}" method="post">
                                                @csrf
                                            </form>
                                            <li><a
                                                    onclick="document.getElementById('logout').submit()">{{ __('messages.Logout') }}</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endauth

                                <?php $total = 0; ?>
                                @foreach ((array) session('cart') as $id => $details)
                                    <?php $total += $details['prix']; ?>
                                @endforeach

                                @unlessrole('admin')
                                    <li><a href="{{ route('PagePayement') }}"><i class="fas fa-shopping-cart"></i><span
                                                class='badge badge-warning' id='lblCartCount'>
                                                {{ count((array) session('cart')) }} </span></a>
                                        <ul class="wm-dropdown-menu">
                                            @if (session('cart'))
                                                <li class="list-group-item cart-item"
                                                    style="border-bottom: gray 0.1em solid;">
                                                    <div class="row w-80 container">
                                                        <p class="ml-auto">Total: <span
                                                                class="primary">{{ $total }} DT</span></p>
                                                    </div>
                                                </li>
                                                @foreach ((array) session('cart') as $id => $details)
                                                    <li class="list-group-item cart-item">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <img src="{{ asset('storage/' . $details['photo']) }}"
                                                                    style="width: 150px; height: 80px;">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <b>{{ $details['nom'] }}</b>
                                                                <br><small>{{ $details['prix'] }} DT</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                <li class="list-group-item cart-item">
                                                    <a class="btn btn-primary btn-sm w-50 container text-white"
                                                        style="color: white !important;"
                                                        href="{{ route('PagePayement') }}">
                                                        {{ __('Panier') }} <i class="fa fa-arrow-right "></i>
                                                    </a>
                                                </li>
                                            @else
                                                <li class="list-group-item">{{ __('messages.paniervide') }}</li>
                                            @endif
                                        </ul>
                                    </li>
                                @endunlessrole
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--// MainHeader \\-->
</header>
