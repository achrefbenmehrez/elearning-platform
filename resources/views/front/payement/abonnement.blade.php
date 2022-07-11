<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/pay.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">

<div class="container px-4 py-5 mx-auto">
    <h1> Achat abonnement de {{ $type_abonnement->duree }}</h1>
    <form method="POST" action="{{ route('abonnements.store', $type_abonnement->id) }}">
        @csrf
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                @if (session('status'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-3 radio-group">
                        <div class="row d-flex px-3 radio"> <img class="pay" src="{{asset('img/WIAP9Ku.jpg')}} ">
                            <p class="my-auto">Carte de crédit </p>
                        </div>
                        <div class="row d-flex px-3 radio gray"> <img class="pay" src="{{asset('img/OdxcctP.jpg')}}">
                            <p class="my-auto">Carte de débit</p>
                        </div>
                        <div class="row d-flex px-3 radio gray mb-3"> <img class="pay" src="{{asset('img/edinar.jpg')}}">
                            <p class="my-auto mr-2">e-dinar</p>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="row px-2">
                            <div class="form-group col-md-6"> <label class="form-control-label">Nom de la carte</label> <input type="text" id="cname" name="nom_titulaire" placeholder=""> </div>
                            <div class="form-group col-md-6"> <label class="form-control-label">Numéro de la carte</label> <input type="text" id="cnum" name="numero_carte" placeholder=""> </div>
                        </div>
                        <div class="row px-2">
                            <div class="form-group col-md-6"> <label class="form-control-label">Date d'expiration</label> <input type="month" id="exp" name="date_expiration"> </div>
                            <div class="form-group col-md-6"> <label class="form-control-label">CVV</label> <input type="text" id="cvv" name="CVV" placeholder="***"> </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-2">

                        <div class="row d-flex justify-content-between px-4" id="tax">
                            <p class="mb-1 text-left">Total</p>
                            <h6 class="mb-1 text-right">{{ $type_abonnement->prix }} DT</h6>
                        </div> <button style="background-color:#86bce0" class="btn-block btn-blue">Valider<i class="fas fa-check ml-2"></i>   </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>

</x-app-layout>
