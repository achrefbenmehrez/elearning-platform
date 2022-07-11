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
    <h6 class="m-0 font-weight-bold text-primary">Tous les reponses</h6>
    </div>
    <div class="card-body">
    <div class="table-responsive">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th style="width: 5%">ID</th>
        <th>writer ID</th>
        <th>ID discussion</th>
        <th>Contenu</th>
        <th>Date creation</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th style="width: 5%">ID</th>
        <th>writer ID</th>
        <th>ID discussion</th>
        <th>Contenu</th>
        <th>Date creation</th>
        <th>Actions</th>
    </tr>
    </tfoot>
    @foreach($replies as $reply)
        <tbody>
            <tr>
                <td>{{ $reply->id }}</td>
                <td>{{ $reply->user_id }}</td>
                <td>{{ $reply->discussion_id }}</td>
                <td>{!! $reply->content !!}</td>
                <td>{{ $reply->created_at }}</td>
                <td class="d-flex flex-row">
                    <div class="p-2">
                        <a href="{{ route('admin.replies.edit', $reply->id) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                    </div>
                    <form action="{{ route('admin.replies.destroy', $reply->id) }}" method="POST" id="deleteuser_{{$reply->id}}" class="p-2">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#user_modal_{{$reply->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>
                    <div class="p-2">
                        <a href="{{ route('admin.replies.show', $reply->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                    </div>
                </td>
            </tr>
        </tbody>
        <!-- Modal -->
        <div class="modal fade" id="user_modal_{{$reply->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                Are you sure you want to delete this?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById(`deleteuser_{{$reply->id}}`).submit()">Save changes</button>
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
