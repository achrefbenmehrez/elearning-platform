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
                                        <div class="form-group"> <label for="nom_utilisateur" class="font-weight-bold">user ID: </label> <h5>{{ $discussion->user_id }}</h5> </div>
                                        <div class="form-group"> <label for="email" class="font-weight-bold">Title: </label> <h5>{{ $discussion->title }}</h5> </div>
                                        <div class="form-group"> <label for="email" class="font-weight-bold">Content: </label> <h5>{!! $discussion->content !!}</h5> </div>
                                        <div class="form-group"> <label for="email" class="font-weight-bold">Slug: </label> <h5>{{ $discussion->slug }}</h5> </div>
                                        <div class="form-group"> <label for="email" class="font-weight-bold">Channel ID: </label> <h5>{{ $discussion->channel_id }}</h5> </div>
                                        <div class="form-group"> <label for="email" class="font-weight-bold">Meilleure reponse ID: </label> <h5>{{ $discussion->reply_id ?? 'Aucune' }}</h5> </div>
                                        <div class="form-group"> <label for="password" class="font-weight-bold">Date creation: </label>  <h5>{{ $discussion->created_at }}</h5>  </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{ route('admin.channels.index') }}" type="submit" class="btn btn-info btn-send pt-2 btn-block ">Retour</a>
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
