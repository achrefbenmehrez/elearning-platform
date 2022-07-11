<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
        integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ=="
        crossorigin="anonymous" />
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="alert alert-danger">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!--// Main Banner \\-->
    <div class="wm-main-banner">

        <div class="wm-banner-one">
            <div class="wm-banner-one-for">
                <div class="wm-banner-one-for-layer"> <img src="{{ asset('images/extra-images/banner-view1-1.jpg') }}"
                        alt=""> </div>
                <div class="wm-banner-one-for-layer"> <img src="{{ asset('images/extra-images/banner-view1-2.jpg') }}"
                        alt=""> </div>
                <div class="wm-banner-one-for-layer"> <img src="{{ asset('images/extra-images/banner-view1-3.jpg') }}"
                        alt=""> </div>
                <div class="wm-banner-one-for-layer"> <img src="{{ asset('images/extra-images/banner-view1-1.jpg') }}"
                        alt=""> </div>
            </div>
            <div class="wm-banner-one-nav">
                <div class="wm-banner-one-nav-layer">
                    <h1>Formations</h1>
                    <p>Formation et Organisation de cycles de formation de différents niveaux et de séminaires d’expertise et de perfectionnement.
                    </p>
                    <a href="#" class="wm-banner-btn">Voir plus</a>
                </div>
                <div class="wm-banner-one-nav-layer">
                    <h1>Applications Nationales</h1>
                    <p> Développement des tests de principales applications nationales, sectorielles et à usage commun au profit de plusieurs ministères.</p>
                    <a href="#" class="wm-banner-btn">Voir plus</a>
                </div>
                <div class="wm-banner-one-nav-layer banner-bgcolor">
                    <h1>Research & Business</h1>
                    <p>The scientific community nominates CRISPR System, based on research developed at the UA.</p>
                    <a href="#" class="wm-banner-btn">learn more</a>
                </div>
                <div class="wm-banner-one-nav-layer">
                    <h1>Formations</h1>
                    <p>Formation et Organisation de cycles de formation de différents niveaux et de séminaires d’expertise et de perfectionnement, au profit de la plupart des départements ministériels et organismes publics.
                    </p>
                    <a href="#" class="wm-banner-btn">Voir plus</a>
                </div>
            </div>
        </div>

    </div>
    <!--// Main Banner \\-->

    <!--// Main Content \\-->
    <div class="wm-main-content">

        <!--// Main Section \\-->
        <div class="wm-main-section">
            <div class="container">
                <div class="row">

                    <div class="col-md-4">
                        <div class="wm-search-course">
                            <h3 class="wm-short-title wm-color">Trouver votre formation</h3>
                            <p>Remplir le formulaire pour trouver votre formation:</p>
                            <form action="{{ route('search') }}">
                                @csrf
                                <ul>
                                    <li> <input type="text" placeholder="Nom Formation" name="q" id="autocomplete"> <i
                                            class="fas fa-search"></i> </li>
                                    <li> <input type="submit" value="Rechercher formation"> </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="wm-service wm-box-service">
                            <ul>
                                @foreach ($categories as $categorie)
                                    <li>
                                        <div class="wm-box-service-wrap wm-bgcolor">
                                            <i class="fa fa-list-alt"></i>
                                            <h6><a href="{{ $categorie->slug }}">{{ $categorie->nom }}</a></h6>
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
        <div class="wm-main-section wm-courses-popular-full">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <div class="wm-fancy-title">
                            <h2>Nouvelles <span>Formations</span></h2>
                        </div>
                        <div class="wm-courses wm-courses-popular">
                            <ul class="row">
                                @foreach ($nouveautes as $nouveaute)
                                    <li class="col-md-3">
                                        <div class="wm-courses-popular-wrap">
                                            <figure> <a href="{{ route('formations.show', $nouveaute->slug) }}"><img
                                                        src="{{ asset('storage/' . $nouveaute->photo_url) }}"
                                                        style="width: 260px !important; height: 184px !important;"
                                                        alt="" width="261px" height="184px"> <span
                                                        class="wm-popular-hover"> <small>see course</small> </span> </a>
                                                <figcaption>
                                                    <img src="{{ asset('storage/' . $nouveaute->user->photo_url) }}"
                                                        alt="" width="60px" height="60px">
                                                    <h6><a>{{ $nouveaute->user->nom_utilisateur }}</a></h6>
                                                </figcaption>
                                            </figure>
                                            <div class="wm-popular-courses-text">
                                                <h6>
                                                    <a href="{{ route('formations.show', $nouveaute->slug) }}">
                                                        {{ $nouveaute->nom }}
                                                    </a>
                                                </h6>
                                                <div class="wm-courses-price"> <span>{{ $nouveaute->prix }} DT</span>
                                                </div>
                                                <ul>
                                                    <li><a class="wm-color"><i
                                                                class="fas fa-users"></i>{{ count($nouveaute->payements) }}</a>
                                                    </li>
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
        <div class="wm-main-section wm-whychooseus-full">
            <div class="container">
                <div class="row">

                    <div class="col-md-8">
                        <div class="whychooseus-list">
                            <div class="wm-fancy-title">
                                <h2>Why <span>Choose Us</span></h2>
                            </div>
                            <ul class="row">
                                <li class="col-md-4">
                                    <span>209</span>
                                    <h6>of our trainees have got a prestigious job</h6>
                                </li>
                                <li class="col-md-4">
                                    <span>91%</span>
                                    <h6>students have established successful business</h6>
                                </li>
                                <li class="col-md-4">
                                    <span>35%</span>
                                    <h6>have already earned their first million</h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="wm-questions-studying">
                            <img src="extra-images/ask-questoin-bg.png" alt="">
                            <h3 class="wm-color">Questions about studying with us?</h3>
                            <p>We have a team of student advisers & officers to answer any questions:</p>
                            <a class="wm-banner-btn" href="#">ask us now</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--// Main Section \\-->

        <!--// Main Section \\-->
        <div class="wm-main-section wm-learn-listing-full">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <div class="wm-fancy-title">
                            <h2>Vous pouvez <span>apprendre</span></h2>
                        </div>
                        <div class="wm-learn-listing">
                            <ul class="row">
                                @for ($i = 0; $i < 4; $i++)
                                    @if (isset($categories[$i]))
                                    <?php $categorie = $categories[$i]; ?>
                                        <li class="col-md-6">
                                            <figure><a href="#"><img
                                                        src="{{ asset('images/extra-images/learn-listing-1.png') }}"
                                                        alt=""></a>
                                                <figcaption>
                                                    <h2>{{ $categorie->nom }}</h2>
                                                    <a href="{{ $categorie->slug }}" class="wm-banner-btn">Voir plus</a>
                                                </figcaption>
                                            </figure>
                                        </li>
                                    @endif
                                @endfor
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--// Main Section \\-->

        <!--// Main Section \\-->
        <div class="wm-main-section wm-courses-popular-full">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <div class="wm-fancy-title">
                            <h2>Plus visités</h2>
                        </div>
                        <div class="wm-courses wm-courses-popular">
                            <ul class="row">
                                @foreach ($plus_visites as $plus_visite)
                                    <li class="col-md-3">
                                        <div class="wm-courses-popular-wrap">
                                            <figure> <a
                                                    href="{{ route('formations.show', $plus_visite->slug) }}"><img
                                                        src="{{ asset('storage/' . $plus_visite->photo_url) }}"
                                                        alt=""
                                                        style="width: 260px !important; height: 184px !important;">
                                                    <span class="wm-popular-hover"> <small>see course</small> </span>
                                                </a>
                                                <figcaption>
                                                    <img src="{{ asset('storage/' . $plus_visite->user->photo_url) }}"
                                                        alt="" width="60px" height="60px">
                                                    <h6><a>{{ $plus_visite->user->nom_utilisateur }}</a></h6>
                                                </figcaption>
                                            </figure>
                                            <div class="wm-popular-courses-text">
                                                <h6>
                                                    <a href="{{ route('formations.show', $plus_visite->slug) }}">
                                                        {{ $plus_visite->nom }}
                                                    </a>
                                                </h6>
                                                <div class="wm-courses-price"> <span>{{ $plus_visite->prix }}
                                                        DT</span> </div>
                                                <ul>
                                                    <li><a class="wm-color"><i
                                                                class="fas fa-users"></i>{{ count($plus_visite->payements) }}</a>
                                                    </li>
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

        <div class="container">
            <div class="col-md-12" id="subscribe">
                <div class="wm-title-typoelements">
                    <h2>Tarifs <span>Abonnement</span></h2>
                </div>
            </div>
            <div class="col-md-12">
                <div class="wm-pricesplan wm-typography-element">
                    <ul class="row">
                        @foreach ($type_abonnements as $type)
                            <li class="col-md-3">
                                <div class="wm-price-plans">
                                    <form action="{{ route('abonnements.create') }}" method="GET">
                                        <h2>Abonnement {{ $type->duree }}</h2>
                                        <span>{{ $type->prix }} DT/{{ $type->duree }}</span>
                                        <ul>
                                            @foreach ($type->description as $desc)
                                                <li>
                                                    <i class="fas fa-check"></i>
                                                    {{ $desc }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        <button type="submit" class="wm-buyplan" name="submit"
                                            value="{{ $type->duree }}">
                                            <i class="fas fa-shopping-basket"></i>
                                            Abonnez vous
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!--// Main Section \\-->
        <div class="wm-main-section wm-contact-full">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">

                        <div class="wm-contact-tab">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" aria-controls="home" data-toggle="tab">Contactez
                                        nous</a></li>
                                <li><a href="#profile" aria-controls="profile" data-toggle="tab">Informations
                                        contact</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mapouter">
                                                <div class="gmap_canvas"><iframe width="360" height="502"
                                                        id="gmap_canvas"
                                                        src="https://maps.google.com/maps?q=centre%20national%20de%20l'informatique&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                                        frameborder="0" scrolling="no" marginheight="0"
                                                        marginwidth="0"></iframe><a
                                                        href="https://123movies-to.org">123movies</a><br>
                                                    <style>
                                                        .mapouter {
                                                            position: relative;
                                                            text-align: right;
                                                            height: 502px;
                                                            width: 360px;
                                                        }

                                                    </style><a href="https://www.embedgooglemap.net">embedding google
                                                        map in web page</a>
                                                    <style>
                                                        .gmap_canvas {
                                                            overflow: hidden;
                                                            background: none !important;
                                                            height: 502px;
                                                            width: 360px;
                                                        }

                                                    </style>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="wm-contact-form">
                                                <span>Contactez nous</span>
                                                <form action="{{ route('contact.store') }}" method="POST">
                                                    @csrf
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
                                                    <ul>
                                                        <li>
                                                            <i class="far fa-user"></i>
                                                            <input type="text" value="{{ old('nom') }}" name="name">
                                                        </li>
                                                        <li>
                                                            <i class="fas fa-paper-plane"></i>
                                                            <input type="text" value="{{ old('email') }}"
                                                                name="email">
                                                        </li>
                                                        <li>
                                                            <i class="fas fa-phone"></i>
                                                            <input type="text" value="{{ old('sujet') }}"
                                                                name="subject">
                                                        </li>
                                                        <li>
                                                            <i class="fas fa-paper-plane"></i>
                                                            <textarea placeholder="Message"
                                                                name="message">{{ old('message') }}</textarea>
                                                        </li>
                                                        <li> <input type="submit" value="Ecrire message"> </li>
                                                    </ul>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="profile">
                                    <span class="wm-contact-title">Informations contact</span>
                                    <div class="wm-contact-service">
                                        <ul class="row">
                                            <li class="col-md-4">
                                                <span class="wm-service-icon"><i
                                                        class="fas fa-search-location"></i></span>
                                                <h5 class="wm-color">Adresse</h5>
                                                <p>17, 1005 Avenue Belhassen Ben Chaabane, Tunis</p>
                                            </li>
                                            <li class="col-md-4">
                                                <span class="wm-service-icon"><i class="fas fa-phone"></i></span>
                                                <h5 class="wm-color">Telephone & Fax</h5>
                                                <p>+216 71 783 055 +216 71781862</p>
                                            </li>
                                            <li class="col-md-4">
                                                <span class="wm-service-icon"><i
                                                        class="fas fa-envelope-open-text"></i></span>
                                                <h5 class="wm-color">E-mail</h5>
                                                <p><a href="mailto:name@email.com">ksaadaoui@cni.tn</a></p>
                                            </li>
                                        </ul>
                                    </div>
                                    <ul class="contact-social-icon">
                                        <li><a href="#"><i class="wm-color fab fa-twitter"></i> Facebook</a></li>
                                        <li><a href="#"><i class="wm-color fab fa-google-plus-g"></i> Twitter</a></li>
                                        <li><a href="#"><i class="wm-color fab fa-facebook"></i> Linkedin</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    <!--// Main Content \\-->
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
    integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
    crossorigin="anonymous"></script>
<script type="text/javascript">
    $('#autocomplete').autocomplete({
        source: '{!! URL::route('autocomplete') !!}',
        minlength: 1,
        autoFocus: true,
        select: function(e, ui) {
            $('#searchname').val(ui.item.value);
        }
    });

</script>
