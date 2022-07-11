<x-admin-layout>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tous les abonnements</h6>
    </div>
    <div class="card-body">
    <a href="{{ route('admin.abonnements.create') }}" class="btn-success btn mb-4 mt-4">Creer un abonnement</a>
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th style="width: 5%">ID</th>
        <th>Nom utilisateur</th>
        <th>Duree</th>
        <th>Carte ID</th>
        <th>Montant paye</th>
        <th>Active</th>
        <th>Date creation</th>
        <th>Date de fin</th>
        <td>Actions</td>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th style="width: 5%">ID</th>
        <th>Nom utilisateur</th>
        <th>Duree</th>
        <th>Carte ID</th>
        <th>Montant paye</th>
        <th>Active</th>
        <th>Date creation</th>
        <th>Date de fin</th>
        <td>Actions</td>
    </tr>
    </tfoot>
    @foreach($abonnements as $abonnement)
        <tbody>
            <tr>
                <th>{{ $abonnement->id }}</th>
                <td>{{ $abonnement->user->nom_utilisateur }}</td>
                <td>{{ $abonnement->typeAbonnement->duree }}</td>
                <td>{{ $abonnement->carte_id }}</td>
                <td>{{ $abonnement->montant_paye }}</td>
                <td>{{ $abonnement->active ? 'vrai' : 'faux' }}</td>
                <td>{{ $abonnement->created_at }}</td>
                <td>{{ $abonnement->date_de_fin }}</td>
                <td class="d-flex flex-row">
                    <div class="p-2">
                        <a href="{{ route('admin.abonnements.edit', $abonnement->id) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                    </div>
                    <form action="{{ route('admin.abonnements.destroy', $abonnement->id) }}" method="POST" id="deleteuser_{{$abonnement->id}}" class="p-2">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#user_modal_{{$abonnement->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>
                    <div class="p-2">
                        <a href="{{ route('admin.abonnements.show', $abonnement->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                    </div>
                </td>
            </tr>
        </tbody>
        <!-- Modal -->
        <div class="modal fade" id="user_modal_{{$abonnement->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                Are you sure you want to delete this?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById(`deleteuser_{{$abonnement->id}}`).submit()">Save changes</button>
                </div>
            </div>
            </div>
        </div>
    @endforeach
    </table>
    </div>
    </div>
    </div>

    </div>
    <!-- /.container-fluid -->


</x-admin-layout>
