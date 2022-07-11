<x-admin-layout>

    <form action="{{ route('admin.abonnements.update', $abonnement->id) }}" method="post">
        @csrf
        <div class="container"> <div class=" text-center mt-5 ">
            <h1>Modifier abonnement</h1>
        </div>
        <div class="row ">
            <div class="col-lg-7 mx-auto">
                <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">
                        <div class="container">
                            <form id="contact-form" role="form">
                                @csrf
                                @method('PUT')
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="controls">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group"> <label for="nom_utilisateur">User ID (Voir table utilisateurs) *</label> <input id="nom_utilisateur" type="text" value="{{ $abonnement->user_id }}" name="user_id" class="form-control" placeholder="User ID *" required="required" data-error="Firstname is required."> </div>
                                            <div class="form-group"> <label for="email">Type abonnement ID (Voir table Types abonnements) *</label> <input id="email" type="text" value="{{ $abonnement->type_abonnement_id }}" name="type_abonnement_id" class="form-control" placeholder="Formation ID *" required="required" data-error="Lastname is required."> </div>
                                            <div class="form-group"> <label for="password">Carte ID *</label> <input id="password" type="text" name="carte_id" class="form-control" value="{{ $abonnement->carte_id }}" placeholder="Carte ID" required="required" data-error="Lastname is required."> </div>
                                            <div class="form-group"> <label for="password">Montant *</label> <input id="password" type="number" name="montant" class="form-control" placeholder="Montant *" value="{{ $abonnement->montant_paye }}" required="required" data-error="Lastname is required."> </div>
                                            <div class="form-group">
                                                <label for="date">
                                                    Date expiration *
                                                </label>
                                                <input type='date' class="form-control" name="date_de_fin" value="{{ DateTime::createFromFormat('Y-m-d H:i:s', $abonnement->date_de_fin)->format('Y-m-d') }}"/>
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Active *</label>
                                                <select class="form-control" name="active">
                                                    <option value="1" {{ $abonnement->active ? 'selected' : '' }}>Vrai</option>
                                                    <option value="0" {{ !$abonnement->active ? 'selected' : '' }}>Faux</option>
                                                </select>
                                            </div>
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
