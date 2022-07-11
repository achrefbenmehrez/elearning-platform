<x-app-layout>

    <style>
        ol li {
            display: inline !important;
        }

    </style>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <div class="container mt-4">
        <a href="{{ route('options.create', [$formation->slug, $test->id, $question->id]) }}"
            class="btn btn-primary mb-4 float-right">Creer options </a>
        <div style="margin-top: 10px !important; margin-left: 2px !important;">
            {{ Breadcrumbs::render('Options', $formation, $test, $question) }}
            <h3>Options de la question {{ $question->question }}</h3>
        </div>
        <x-jet-validation-errors class="mb-4 mt-4" />
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (count($options) == 0)
            <h2 class="mb-4 mt-4 container">Aucune option</h2>
        @else
            <table id='tab' class="table table-hover mt-4 mb-4">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Option</th>
                        <th scope="col">Correct</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                @foreach ($options as $key => $option)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>
                            <a href="" class="text-info">
                                {{ $option->option }}
                            </a>
                        </td>
                        <td>
                            <a href="" class="text-info">
                                {{ $option->correct ? 'vrai' : 'faux' }}
                            </a>
                        </td>
                        <td>
                            <form class="deleteoption_{{ $option->id }}"
                                action="{{ route('options.destroy', [$formation->slug, $test->id, $question->id, $option->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a href="{{ route('options.edit', [$formation->slug, $test->id, $question->id, $option->id]) }}"
                                class="btn btn-sm btn-success">Modifier</a>
                            <a class="btn btn-danger supp-option btn-sm" id="{{ $option->id }}" data-toggle="modal"
                                data-target="#exampleModal">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Supprimer option</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer ceci?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary delete-confirm">
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    $(document).ready(function() {
        // Align modal when it is displayed
        $(".modal").on("shown.bs.modal", function(event) {
            var modalDialog = $(this).find(".modal-dialog");

            // Applying the top margin on modal to align it vertically center
            modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 2));

            $(".delete-confirm").on("click", function() {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.attr('id') // Extract info from data-* attributes
                $(`.deleteoption_${id}`).submit();
            })
        });

        // Align modal when user resize the window
        $(window).on("resize", function() {
            $(".modal:visible").each(function() {
                var modalDialog = $(this).find(".modal-dialog");

                // Applying the top margin on modal to align it vertically center
                modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog
                    .height()) / 2));
            });
        });
    });

</script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js">
</script>

<script>
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        $('#tab').DataTable({
            language: {
                processing: "Traitement en cours...",
                search: "Rechercher&nbsp;:",
                lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
                info: "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                infoPostFix: "",
                loadingRecords: "Chargement en cours...",
                zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
                emptyTable: "Aucune donnée disponible dans le tableau",
                paginate: {
                    first: "Premier",
                    previous: "Pr&eacute;c&eacute;dent",
                    next: "Suivant",
                    last: "Dernier"
                },
                aria: {
                    sortAscending: ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            }
        });
    });

</script>
