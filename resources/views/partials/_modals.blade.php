<style>
    .modal {
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    .modal-header {
        padding: 37px 35px 21px 35px;
    }
</style>
<!-- ModalLogin Box -->
<div class="modal fade" id="ModalLogin" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="wm-color">Se connecter / Créer un compte</span>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="wm-modallogin-form wm-login-popup">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <ul>
                            <li>
                                <label for="">Nom d'utilisateur</label>
                                <input type="text" value="{{ old('nom_utilisateur') }}"
                                    placeholder="Nom d'utilisateur" name="nom_utilisateur">
                            </li>
                            <li>
                                <label for="">Mot de passe</label>
                                <input type="password" placeholder="Mot de passe" name="password">
                            </li>
                            <li> <a href="{{ route('password.request') }}" class="wm-forgot-btn">Vous avez oublier
                                    votre mot de passe?</a> </li>
                            <li> <input type="submit" value="Se connecter"> </li>
                        </ul>
                    </form>
                    <p>Pas encore un membre? <a href="#">S'inscrire!</a></p>
                </div>
                <div class="wm-modallogin-form wm-register-popup">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <ul>
                            <label for="">Nom</label>
                            <li> <input type="text" value="{{ old('nom') }}" name="nom"> </li>
                            <label for="">Prenom</label>
                            <li> <input type="text" value="{{ old('prenom') }}" name="prenom"> </li>
                            <label for="">Email</label>
                            <li> <input type="text" value="{{ old('email') }}" name="email"> </li>
                            <label for="">Mot de passe</label>
                            <li> <input type="password" name="password"> </li>
                            <label for="">Confirmer votre mot de passe</label>
                            <li> <input type="password" name="password_confirmation"> </li>
                            <li> <input type="submit" value="S'inscrire"> </li>
                        </ul>
                    </form>
                    <p>Deja un membre? <a>Se connecter!</a></p>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- ModalLogin Box -->

<!-- ModalSearch Box -->
<div class="modal fade" id="ModalSearch" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <div class="wm-modallogin-form">
                    <span class="wm-color">Rechercher une formation</span>
                    <form action="{{ route('search') }}" autocomplete="off">
                        <ul>
                            <li> <input type="text" id="autocomplete" name="q"> </li>
                            <li> <input type="submit" value="Rechercher"> </li>
                        </ul>
                    </form>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
