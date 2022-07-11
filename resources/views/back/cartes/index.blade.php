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
    <h6 class="m-0 font-weight-bold text-primary">Toutes les cartes</h6>
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th style="width: 5%">ID</th>
        <th>Nom du titulaire</th>
        <th>Numero</th>
        <th>Date expiration</th>
        <th>CVV</th>
        <td>Solde de la carte</td>
        <th>Date creation</th>
        <td>Actions</td>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th style="width: 5%">ID</th>
        <th>Nom du titulaire</th>
        <th>Numero</th>
        <th>Date expiration</th>
        <th>CVV</th>
        <td>Solde de la carte</td>
        <th>Date creation</th>
        <td>Actions</td>
    </tr>
    </tfoot>
    @foreach($cartes as $carte)
        <tbody>
            <tr>
                <th>{{ $carte->id }}</th>
                <td>{{ $carte->Nom_du_titulaire_de_la_carte }}</td>
                <td>{{ $carte->Numero_de_la_carte }}</td>
                <td>{{ $carte->date_expiration }}</td>
                <td>{{ $carte->CVV }}</td>
                <td>{{ $carte->Solde_de_la_carte }}</td>
                <td>{{ $carte->created_at }}</td>
                <td class="d-flex flex-row">
                    <div class="p-2">
                        <a href="{{ route('admin.cartes.show', $carte->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
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
