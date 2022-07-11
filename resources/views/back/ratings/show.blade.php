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
                                        <div class="form-group"> <label for="nom_utilisateur" class="font-weight-bold">Formation ID: </label> <h5>{{ $rating->formation_id }}</h5> </div>
                                        <div class="form-group"> <label for="email" class="font-weight-bold">User ID: </label> <h5>{{ $rating->user_id }}</h5> </div>
                                        <div class="form-group"> <label for="password" class="font-weight-bold">Valeur: </label>  <h5>{{ $rating->value }}</h5>  </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.ratings.index') }}" type="submit" class="btn btn-success btn-send pt-2 btn-block ">Retour</a>
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
