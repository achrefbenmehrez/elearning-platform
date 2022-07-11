<x-admin-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" />
    <form action="{{ route('admin.discussions.update', $discussion->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="container"> <div class=" text-center mt-5 ">
            <h1>Modifier discussion {{ $discussion->title }}</h1>
        </div>
        <div class="row ">
            <div class="col-lg-7 mx-auto">
                <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">
                        <div class="container">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <form id="contact-form" role="form">
                                <div class="controls">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group"> <label for="nom_utilisateur">writer ID(voir table utilisateurs) *</label> <input id="nom_utilisateur" type="text" value="{{ $discussion->user_id }}" name="user_id" class="form-control" placeholder="User id *" required="required" data-error="Firstname is required."> </div>
                                            <div class="form-group"> <label for="nom_utilisateur">Titre *</label> <input id="nom_utilisateur" type="text" name="title" value="{{ $discussion->title }}" class="form-control" placeholder="Titre *" required="required" data-error="Firstname is required."> </div>
                                            <div class="form-group">
                                                <label for="nom_utilisateur">Contenu *</label>
                                                <input type="text" value="{{ $discussion->content }}" class="form-control" name="content" id="x" hidden/>
                                                <trix-editor input="x"></trix-editor>
                                            </div>
                                            <div class="form-group">
                                                <label for="nom_utilisateur">Chaine *</label>
                                                <select class="form-control" name="channel_id">
                                                    @foreach ($channels as $channel)
                                                        <option value="{{ $channel->id }}" >{{ $channel->name }}</option>
                                                    @endforeach
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js" integrity="sha512-2RLMQRNr+D47nbLnsbEqtEmgKy67OSCpWJjJM394czt99xj3jJJJBQ43K7lJpfYAYtvekeyzqfZTx2mqoDh7vg==" crossorigin="anonymous"></script>
</x-admin-layout>
