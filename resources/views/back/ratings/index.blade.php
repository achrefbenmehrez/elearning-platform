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
    <h6 class="m-0 font-weight-bold text-primary">Toutes les evaluations</h6>
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th style="width: 5%">ID</th>
        <th>User ID</th>
        <th>Formation ID</th>
        <th>Valeur</th>
        <th>Date creation</th>
        <td>Actions</td>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th style="width: 5%">ID</th>
        <th>User ID</th>
        <th>Formation ID</th>
        <th>Valeur</th>
        <th>Date creation</th>
        <td>Actions</td>
    </tr>
    </tfoot>
    @foreach($ratings as $rating)
        <tbody>
            <tr>
                <th>{{ $rating->id }}</th>
                <td>{{ $rating->user_id }}</td>
                <td>{{ $rating->formation_id }}</td>
                <td>{{ $rating->value }}</td>
                <td>{{ $rating->created_at }}</td>
                <td class="d-flex flex-row">
                    <div class="p-2">
                        <a href="{{ route('admin.ratings.show', $rating->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
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
