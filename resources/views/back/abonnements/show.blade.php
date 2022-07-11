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
                                        <div class="form-group"> <label for="nom_utilisateur" class="font-weight-bold">Nom utilisateur: </label> <h5>{{ $abonnement->user->nom_utilisateur }}</h5> </div>
                                        <div class="form-group"> <label for="email" class="font-weight-bold">Duree: </label> <h5>{{ $abonnement->typeAbonnement->duree }}</h5> </div>
                                        <div class="form-group"> <label for="password" class="font-weight-bold">Carte ID: </label>  <h5>{{ $abonnement->carte_id }}</h5>  </div>
                                        <div class="form-group"> <label for="password" class="font-weight-bold">Montant: </label>  <h5>{{ $abonnement->montant_paye }}</h5>  </div>
                                        <div class="form-group"> <label for="password" class="font-weight-bold">Active: </label>  <h5>{{ $abonnement->carte_id }}</h5>  </div>
                                        <div class="form-group"> <label for="password" class="font-weight-bold">Date creation: </label>  <h5>{{ $abonnement->created_at }}</h5>  </div>
                                        <div class="form-group"> <label for="password" class="font-weight-bold">Date de fin: </label>  <h5>{{ $abonnement->date_de_fin }}</h5>  </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{ route('admin.abonnements.index') }}" type="submit" class="btn btn-info btn-send pt-2 btn-block ">Retour</a>
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

<!-- Modal -->
<div class="modal fade" id="user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-body">
    Are you sure you want to delete this?
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="document.getElementById(`deleteuser`).submit()">Save changes</button>
    </div>
</div>
</div>
</div>

</x-admin-layout>
