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
                                        <div class="form-group"> <label for="nom_utilisateur" class="font-weight-bold">Nom utilisateur: </label> <h5>{{ $payement->user->nom_utilisateur }}</h5> </div>
                                        <div class="form-group"> <label for="email" class="font-weight-bold">Nom formation: </label> <h5>{{ $payement->formation->nom }}</h5> </div>
                                        <div class="form-group"> <label for="password" class="font-weight-bold">Montant paye: </label>  <h5>{{ $payement->montant_paye }}</h5>  </div>
                                        <div class="form-group"> <label for="password" class="font-weight-bold">Carte ID: </label>  <h5>{{ $payement->carte_id }}</h5>  </div>
                                        <div class="form-group"> <label for="password" class="font-weight-bold">Date creation: </label>  <h5>{{ $payement->created_at }}</h5>  </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{ route('admin.payements.index') }}" type="submit" class="btn btn-info btn-send pt-2 btn-block ">Retour</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('admin.payements.edit', $payement->id) }}" type="submit" class="btn btn-success btn-send pt-2 btn-block ">Modifier</a>
                                    </div>
                                    <div class="col-md-4">
                                        <form id="deleteuser" action="{{ route('admin.payements.destroy', $payement->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" data-toggle="modal" data-target="#user_modal" class="btn btn-danger btn-send pt-2 btn-block " value="Supprimer">Supprimer</button>
                                        </form>
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
