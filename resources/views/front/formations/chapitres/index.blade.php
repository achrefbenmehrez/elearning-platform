<x-app-layout>
    <style>
        ol li{
            display: inline !important;
        }
    </style>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <div class="container mt-4 background-secondary">
    <div>
        <a href="{{ route('chapitres.create', $formation->slug) }}" class="btn btn-primary mb-4 float-right">Creer Chapitre </a>
        <a href="{{ route('episodes.create', $formation->slug) }}" class="btn btn-primary mb-4 float-right">Creer Episode </a>
        <div class="row" style="margin-top: 10px !important; margin-left: 2px !important;">
            {{ Breadcrumbs::render('Chapitres', $formation) }}
            <h3>Chapitres de la formation {{ $formation->nom }}</h3>
        </div>
    </div>
    <x-jet-validation-errors class="mb-4 mt-4" />
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <span id="status"></span>
    @if(count($chapitres) == 0)
        <h2 class="mb-4 mt-4 container">Aucun chapitre</h2>
    @else
        <table id='tab' class="table table-hover mt-4 mb-4">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Chapitre</th>
                <th scope="col">Actions Chapitre</th>
                <th scope="col">Test</th>
                <th scope="col">Test Active</th>
                <th scope="col">Actions Test</th>
            </tr>
            </thead>
            <tfoot>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Chapitre</th>
                    <th scope="col">Actions Chapitre</th>
                    <th scope="col">Test</th>
                    <th scope="col">Test Active</th>
                    <th scope="col">Actions Test</th>
                </tr>
            </tfoot>
            <tbody>
            @foreach($chapitres as $key => $chapitre)
            <?php
                $exists = false;
                if($chapitre->tests)
                {
                    $exists = true;
                    $test = $chapitre->tests;
                }
            ?>
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>
                    <a href="{{ route('episodes.index', [$formation->slug, $chapitre->id]) }}" class="text-info">
                        {{ $chapitre->nom }}
                    </a>
                </td>
                <td>
                    <form class="deletechap_{{$chapitre->id}}" action="{{ route('chapitres.destroy', [$formation->slug, $chapitre->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                    <a href="{{ route('episodes.index', [$formation->slug, $chapitre->id]) }}" class="btn btn-sm btn-info">
                        Modifier episodes
                    </a>
                    <a href="{{ route('chapitres.edit', [$formation->slug, $chapitre->id]) }}" class="btn btn-sm btn-success">Modifier</a>
                    <a class="btn btn-danger supp-chap btn-sm" id="{{$chapitre->id}}" data-toggle="modal" data-target="#exampleModal1">
                        Supprimer
                    </a>
                </td>
                <td>
                    @if($exists)
                        <a href="{{ route('questions.index', [$formation->slug, $chapitre->id, $test->id]) }}" class="text-info">
                            {{ $test->title }}
                        </a>
                    @else
                        <a href="{{ route('tests.create', [$formation->slug, $chapitre->id]) }}" class="btn btn-primary mb-4 btn-sm">
                            Creer Test
                        </a>
                    @endif
                </td>
                @if($exists)
                    <td>
                        <input type="checkbox" data-toggle="toggle" id="{{ $test->id }}" name="published" class="mr-4" @if($test->published) checked @endif>
                    </td>
                    <td>
                        <form class="deletetest_{{$test->id}}" action="{{ route('tests.destroy', [$formation->slug, $chapitre->id, $test->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="{{ route('questions.index', [$formation->slug, $chapitre->id, $test->id]) }}" class="btn btn-sm btn-info">
                            Modifier questions
                        </a>
                        <a href="{{ route('tests.edit', [$formation->slug, $chapitre->id, $test->id]) }}" class="btn btn-sm btn-success">Modifier</a>
                        <a class="btn btn-danger supp-test btn-sm" id="{{$test->id}}" data-toggle="modal" data-target="#exampleModal2">
                            Supprimer
                        </a>
                    </td>
                @else
                    <td></td>
                    <td></td>
                @endif
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $chapitres->links() }}
    @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Supprimer chapitre</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer ceci?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button type="button"
                class="btn btn-primary delete-confirm1"
            >
                Supprimer
            </button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Supprimer Test</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer ceci?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button type="button"
                class="btn btn-primary delete-confirm2"
            >
                Supprimer
            </button>
            </div>
        </div>
        </div>
    </div>

</x-app-layout>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
    $(document).ready(function(){
        $(".delete-confirm1").on("click", function(){
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.attr('id') // Extract info from data-* attributes
            $(`.deletechap_${id}`).submit();
        })

        $(".delete-confirm2").on("click", function(){
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.attr('id') // Extract info from data-* attributes
            $(`.deletetest_${id}`).submit();
        })

        $("input:checkbox").change(function() {
        var test_id = $(this).attr('id');

        $.ajax({
                type:'POST',
                url:"{{ route('test.activation', $formation->slug) }}",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: { "test_id" : test_id },
                success: function(data){
                    if(typeof data.data !== 'undefined'){
                        $("span#status").html('<div class="alert alert-success">' + data.data.success + '</div>');
                    }
                }
            });
        });
    });
</script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
    // Call the dataTables jQuery plugin
    $(document).ready(function () {
        $('#tab').DataTable({
            language: {
        processing:     "Traitement en cours...",
        search:         "Rechercher&nbsp;:",
        lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
        info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable:     "Aucune donnée disponible dans le tableau",
        paginate: {
            first:      "Premier",
            previous:   "Pr&eacute;c&eacute;dent",
            next:       "Suivant",
            last:       "Dernier"
        },
        aria: {
            sortAscending:  ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    }
        });
    });
</script>
