<x-admin-layout>

    <div class="container">
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <div class="controls">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group"> <label for="nom_utilisateur" class="font-weight-bold">ID: </label> <h5>{{ $type_abonnement->id }}</h5> </div>
                                    <div class="form-group"> <label for="email" class="font-weight-bold">Duree: </label> <h5>{{ $type_abonnement->duree }}</h5> </div>
                                    <div class="form-group"> <label for="password" class="font-weight-bold">Prix: </label>  <h5>{{ $type_abonnement->prix }}</h5>  </div>
                                    <div class="form-group"> <label for="password" class="font-weight-bold">Description: </label>
                                        @foreach ($type_abonnement->description as $desc)
                                            <h5>{{ $desc }}</h5>
                                            <br>
                                        @endforeach
                                    </div>
                                    <div class="form-group"> <label for="password" class="font-weight-bold">Date creation: </label>  <h5>{{ $type_abonnement->created_at }}</h5>  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('admin.type_abonnements.index') }}" type="submit" class="btn btn-info btn-send pt-2 btn-block ">Retour</a>
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
