<x-app-layout>
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    <div class="container">
        <div class="row justify-content-center wm-form-wrap wm-typography-element">
            <div class="wm-classic-heading" style="text-align: center !important;">
                <h2>Creer une discussion</h2>
            </div>
            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
            <form action="{{ route('discussions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label>Titre *</label>
                <input type="text" name="title" class="form-control">
                <label>Contenu *</label>
                <textarea name="content" id="editor" style="margin: 10px !important;">
                </textarea>
                <label for="">Image *</label>
                <input type="file" name="photo" class="form-control">
                <label>Chaine *</label>
                    <select class="form-control" name="channel_id">
                        @foreach ($channels as $channel)
                            <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                        @endforeach
                    </select>
                <input type="submit" class="wm-all-events" style="margin: 10px !important;" value="Publier">
            </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
