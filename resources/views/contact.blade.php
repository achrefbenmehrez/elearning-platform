<x-app-layout>
    <!--// Mini Header \\-->
    <div class="wm-mini-header">
        <span class="wm-blue-transparent"></span>
         <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wm-mini-title">
                        <h1>Contactez nous</h1>
                    </div>
                    <div class="wm-breadcrumb">
                        <ul>
                            <li><a href="{{ route('home') }}">Accueil</a></li>
                            <li>Contactez nous</li>
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
    <div class="wm-main-section wm-contact-full">
        <div class="container">
            <div class="row">

                <div class="col-md-12">

                    <div class="wm-contact-tab">

                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" aria-controls="home" data-toggle="tab">Contactez nous</a></li>
                        <li><a href="#profile" aria-controls="profile" data-toggle="tab">Informations contact</a></li>
                      </ul>

                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mapouter"><div class="gmap_canvas"><iframe width="360" height="502" id="gmap_canvas" src="https://maps.google.com/maps?q=centre%20national%20de%20l'informatique&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org">123movies</a><br><style>.mapouter{position:relative;text-align:right;height:502px;width:360px;}</style><a href="https://www.embedgooglemap.net">embedding google map in web page</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:502px;width:360px;}</style></div></div>
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
                                                    <input type="text" value="{{ old('email') }}" name="email">
                                                </li>
                                                <li>
                                                    <i class="fas fa-phone"></i>
                                                    <input type="text" value="{{ old('sujet') }}" name="subject">
                                                </li>
                                                <li>
                                                    <i class="fas fa-paper-plane"></i>
                                                    <textarea placeholder="Message" name="message">{{ old('message') }}</textarea>
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
                                        <span class="wm-service-icon"><i class="fas fa-search-location"></i></span>
                                        <h5 class="wm-color">Adresse</h5>
                                        <p>17, 1005 Avenue Belhassen Ben Chaabane, Tunis</p>
                                    </li>
                                    <li class="col-md-4">
                                        <span class="wm-service-icon"><i class="fas fa-phone"></i></span>
                                        <h5 class="wm-color">Telephone & Fax</h5>
                                        <p>+216 71 783 055 +216 71781862</p>
                                    </li>
                                    <li class="col-md-4">
                                        <span class="wm-service-icon"><i class="fas fa-envelope-open-text"></i></span>
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
