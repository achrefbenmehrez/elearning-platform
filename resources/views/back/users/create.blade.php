<x-admin-layout>

    <form action="{{ route('admin.users.store') }}" method="POST" id="formmmmm">
        @csrf
        <div class="container">
            <div class=" text-center mt-5 ">
                <h1>Creer un utilisateur</h1>
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
                                <div class="controls">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group"> <label for="nom_utilisateur">Nom utilisateur
                                                    *</label> <input id="nom_utilisateur" type="text"
                                                    name="nom_utilisateur" class="form-control"
                                                    placeholder="Nom utilisateur *" required="required"
                                                    data-error="Firstname is required."> </div>
                                            <div class="form-group"> <label for="email">Email *</label> <input
                                                    id="email" type="email" name="email" class="form-control"
                                                    placeholder="Email *" required="required"
                                                    data-error="Lastname is required."> </div>
                                            <div class="form-group"> <label for="password">Mot de passe *</label>
                                                <input id="password" type="password" name="password"
                                                    class="form-control" placeholder="Mot de passe *"
                                                    required="required" data-error="Lastname is required."> </div>
                                            <div class="form-group">
                                                <label for="role">Notification preference</label>
                                                <select class="form-control" id="preference" name="preference[]"
                                                    multiple>
                                                    <option value="mail">Email</option>
                                                    <option value="database">Database</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <select class="form-control" id="roles" name="role">
                                                    @foreach ($roles as $role)
                                                        <option>{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12"> <button type="submit"
                                                onclick="document.getElementById('formmmmm').submit()"
                                                class="btn btn-success btn-send pt-2 btn-block ">Creer</button> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.8 -->
                </div> <!-- /.row-->
            </div>
        </div>
    </form>

</x-admin-layout>
