<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">E-learning</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#utilisateurs" aria-expanded="true"
            aria-controls="utilisateurs">
            <i class="fas fa-users"></i>
            <span>Gestion utilisateurs</span>
        </a>
        <div id="utilisateurs" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.users.index') }}">Tous les utilisateurs</a>
                <a class="collapse-item" href="{{ route('admin.users.create') }}">Creer un utilisateur</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categories" aria-expanded="true"
            aria-controls="categories">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Gestion categories</span>
        </a>
        <div id="categories" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.categories.index') }}">Toutes les categories</a>
                <a class="collapse-item" href="{{ route('admin.categories.create') }}">Creer une categorie</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#payements" aria-expanded="true"
            aria-controls="payements">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Gestion payements</span>
        </a>
        <div id="payements" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.payements.index') }}">Tous les payements</a>
                <a class="collapse-item" href="{{ route('admin.payements.create') }}">Creer un payement</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#abonnements" aria-expanded="true"
            aria-controls="abonnements">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Gestion abonnements</span>
        </a>
        <div id="abonnements" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.abonnements.index') }}">Tous les abonnements</a>
                <a class="collapse-item" href="{{ route('admin.abonnements.create') }}">Creer un abonnement</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#cartes" aria-expanded="true"
            aria-controls="abonnements">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Gestion cartes</span>
        </a>
        <div id="cartes" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.cartes.index') }}">Toutes les cartes</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#type_abonnements"
            aria-expanded="true" aria-controls="abonnements">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Gestion types abonnement</span>
        </a>
        <div id="type_abonnements" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.type_abonnements.index') }}">Tous les types
                    abonnement</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#formations" aria-expanded="true"
            aria-controls="formations">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Gestion formations</span>
        </a>
        <div id="formations" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.formations.index') }}">Toutes les formations</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#chaines" aria-expanded="true"
            aria-controls="chaines">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Gestion chaines</span>
        </a>
        <div id="chaines" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.channels.index') }}">Tous les chaines</a>
                <a class="collapse-item" href="{{ route('admin.channels.create') }}">Creer une chaine</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#discussions" aria-expanded="true"
            aria-controls="discussions">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Gestion discussions</span>
        </a>
        <div id="discussions" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.discussions.index') }}">Tous les discussions</a>
                <a class="collapse-item" href="{{ route('admin.discussions.create') }}">Creer une discussion</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#replies" aria-expanded="true"
            aria-controls="replies">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Gestion reponses</span>
        </a>
        <div id="replies" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.replies.index') }}">Tous les reponses</a>
                <a class="collapse-item" href="{{ route('admin.replies.create') }}">Creer une reponse</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#evaluations" aria-expanded="true"
            aria-controls="evaluations">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Gestion evaluations</span>
        </a>
        <div id="evaluations" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.ratings.index') }}">Toutes les evaluations</a>
            </div>
        </div>
    </li>

</ul>
<!-- End of Sidebar -->
