<x-admin-layout>

    <div class="container">
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" role="form">
                            <div class="controls">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group"> <label for="nom_utilisateur" class="font-weight-bold">Nom du titulaire: </label> <h5>{{ $carte->Nom_du_titulaire_de_la_carte }}</h5> </div>
                                        <div class="form-group"> <label for="email" class="font-weight-bold">Numero: </label> <h5>{{ $carte->Numero_de_la_carte }}</h5> </div>
                                        <div class="form-group"> <label for="password" class="font-weight-bold">Date expiration: </label>  <h5>{{ $carte->date_expiration }}</h5>  </div>
                                        <div class="form-group"> <label for="password" class="font-weight-bold">CVV: </label>  <h5>{{ $carte->CVV }}</h5>  </div>
                                        <div class="form-group"> <label for="password" class="font-weight-bold">Solde: </label>  <h5>{{ $carte->Solde_de_la_carte }}</h5>  </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.cartes.index') }}" type="submit" class="btn btn-success btn-send pt-2 btn-block ">Retour</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div> <!-- /.8 -->
        </div> <!-- /.row-->
    </div>
</div>
</form>


</x-admin-layout>
