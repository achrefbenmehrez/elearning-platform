<x-admin-layout>

    <form action="{{ route('admin.payements.update', $payement->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="container"> <div class=" text-center mt-5 ">
            <h1>Modifier payement</h1>
        </div>
        <div class="row ">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-lg-7 mx-auto">
                <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">
                        <div class="container">
                            <form id="contact-form" role="form">
                                <div class="controls">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group"> <label for="nom_utilisateur">User ID (Voir table utilisateurs) *</label> <input id="nom_utilisateur" type="text" value="{{ $payement->user_id }}" name="user_id" class="form-control" placeholder="User ID *" required="required" data-error="Firstname is required."> </div>
                                            <div class="form-group"> <label for="email">Formation ID (Voir table formations) *</label> <input id="email" type="text" name="formation_id" value="{{ $payement->formation_id }}" class="form-control" placeholder="Formation ID *" required="required" data-error="Lastname is required."> </div>
                                            <div class="form-group"> <label for="password">Carte ID *</label> <input id="password" type="text" name="carte_id" class="form-control" placeholder="Carte ID" value="{{ $payement->carte_id }}" required="required" data-error="Lastname is required."> </div>
                                            <div class="form-group"> <label for="password">Montant *</label> <input id="password" type="text" name="montant" class="form-control" placeholder="Montant *" value="{{ $payement->montant_paye }}" required="required" data-error="Lastname is required."> </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12"> <input type="submit" class="btn btn-success btn-send pt-2 btn-block "> </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- /.8 -->
            </div> <!-- /.row-->
        </div>
    </div>
</form>

</x-admin-layout>
