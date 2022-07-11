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
    <h6 class="m-0 font-weight-bold text-primary">Tous les types abonnement</h6>
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th style="width: 5%">ID</th>
        <th>Duree</th>
        <th>Prix</th>
        <th>Description</th>
        <th>Date creation</th>
        <td>Actions</td>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th style="width: 5%">ID</th>
        <th>Duree</th>
        <th>Prix</th>
        <th>Description</th>
        <th>Date creation</th>
        <td>Actions</td>
    </tr>
    </tfoot>
    @foreach($type_abonnements as $type_abonnement)
        <tbody>
            <tr>
                <th>{{ $type_abonnement->id }}</th>
                <td>{{ $type_abonnement->duree }}</td>
                <td>{{ $type_abonnement->prix }}</td>
                <td>
                    @foreach ($type_abonnement->description as $desc)
                        {{ $desc }}
                        <br>
                    @endforeach
                </td>
                <td>{{ $type_abonnement->created_at }}</td>
                <td class="d-flex flex-row">
                    <div class="p-2">
                        <a href="{{ route('admin.type_abonnements.show', $type_abonnement->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                    </div>
                </td>
            </tr>
        </tbody>
    @endforeach
    </table>
    </div>
    </div>
    </div>

    </div>
    <!-- /.container-fluid -->


</x-admin-layout>
