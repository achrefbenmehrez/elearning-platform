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
    <h6 class="m-0 font-weight-bold text-primary">Toutes les formations</h6>
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th style="width: 5%">ID</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Prix</th>
        <th>Photo</th>
        <th>Slug</th>
        <th>View count</th>
        <th>User ID</th>
        <th>Date creation</th>
        <td>Actions</td>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th style="width: 5%">ID</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Prix</th>
        <th>Photo</th>
        <th>Slug</th>
        <th>View count</th>
        <th>User ID</th>
        <th>Date creation</th>
        <td>Actions</td>
    </tr>
    </tfoot>
    @foreach($formations as $formation)
        <tbody>
            <tr>
                <th>{{ $formation->id }}</th>
                <td>{{ $formation->nom }}</td>
                <td>{{ $formation->description }}</td>
                <td>{{ $formation->prix }}</td>
                <td>
                    <img src="{{ asset('storage/'.$formation->photo_url) }}" height="100em" width="150em">
                </td>
                <td>{{ $formation->slug }}</td>
                <td>{{ $formation->view_count }}</td>
                <td>{{ $formation->user_id }}</td>
                <td>{{ $formation->created_at }}</td>
                <td class="d-flex flex-row">
                    <div class="p-2">
                        <a href="{{ route('admin.formations.show', $formation->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
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
