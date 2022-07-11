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
                                    <div class="form-group"> <label for="nom_utilisateur" class="font-weight-bold">ID: </label> <h5>{{ $formation->id }}</h5> </div>
                                    <div class="form-group"> <label for="email" class="font-weight-bold">Nom: </label> <h5>{{ $formation->duree }}</h5> </div>
                                    <div class="form-group"> <label for="password" class="font-weight-bold">Description: </label>  <h5>{{ $formation->description }}</h5>  </div>
                                    <div class="form-group"> <label for="password" class="font-weight-bold">Prix: </label>  <h5>{{ $formation->prix }}</h5>  </div>
                                    <div class="form-group"> <label for="password" class="font-weight-bold">Photo: </label><br>
                                        <img src="{{ asset('storage/'.$formation->photo_url) }}" height="200em" width="300em">
                                    </div>
                                    <div class="form-group"> <label for="password" class="font-weight-bold">Slug: </label>  <h5>{{ $formation->slug }}</h5>  </div>
                                    <div class="form-group"> <label for="password" class="font-weight-bold">View count: </label>  <h5>{{ $formation->view_count }}</h5>  </div>
                                    <div class="form-group"> <label for="password" class="font-weight-bold">User ID: </label>  <h5>{{ $formation->user_id }}</h5>  </div>
                                    <div class="form-group"> <label for="password" class="font-weight-bold">Date creation: </label>  <h5>{{ $formation->created_at }}</h5>  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('admin.formations.index') }}" type="submit" class="btn btn-info btn-send pt-2 btn-block ">Retour</a>
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
