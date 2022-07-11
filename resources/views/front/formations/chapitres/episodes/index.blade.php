<x-app-layout>
    <style>
        ol li{
            display: inline !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.4/plyr.css" />
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!--// Main Content \\-->
    <div class="wm-main-content">
        <!--// Main Section \\-->
        <div class="wm-main-section">
            <div class="container">
                    <div>
                        <div class="row" style="margin-top: 10px !important; margin-left: 2px !important;">
                            {{ Breadcrumbs::render('Chapitres', $formation) }}
                            <h3>Episodes du chapitre {{ $chapitre->nom }}</h3>
                        </div>
                    </div>
                <div class="row">

                    <aside class="col-md-3">
                        <div class="widget wm-search-course">
                            <h3 class="wm-short-title wm-color">Trouver une formation</h3>
                            <p>Trouver une formation ici:</p>
                            <form action="{{ route('search') }}" autocomplete="off">
                                <ul>
                                    <li> <input type="text" placeholder="Nom formation" name="q"> <i class="fas fa-search"></i> </li>
                                    <li> <input type="submit" value="Rechercher formation"> </li>
                                </ul>
                            </form>
                        </div>
                        <div class="widget widget_check-box widget_scroll-box">
                            <h5>Rechercher par categorie</h5>
                            <ul>
                                <li>
                                    <a href="{{ route('formations.index') }}">
                                        <label for="type1">
                                            <span></span>
                                            Toutes les categories
                                        </label>
                                    </a>
                                </li>
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ route('CategorieFormations', $category->slug) }}">
                                            <label for="type2">
                                                <span></span>
                                                {{ $category->nom }}
                                            </label>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget widget_check-box">
                            <h5>Rechercher par prix</h5>
                            <div class="wm-range-slider">
                                <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                    <input id="price-filter" type="range" value="50" name="prix">
                                </div>
                                <form>
                                      <input id="amount" type="text" value="50 DT" readonly="">
                                      <input type="submit" value="Clear Filters">
                                </form>
                            </div>
                        </div>
                    </aside>

                    <div class="col-md-9">
                        <div class="wm-filter-box">
                            <div class="wm-apply-select">
                                <select>
                                    <option>By Category</option>
                                    <option>By Category</option>
                                    <option>By Category</option>
                                    <option>By Category</option>
                                </select>
                            </div>
                            <div class="wm-apply-select">
                                <select>
                                    <option>Search By</option>
                                    <option>Search By</option>
                                    <option>Search By</option>
                                    <option>Search By</option>
                                </select>
                            </div>
                            <div class="wm-normal-btn">
                                <a href="{{ route('episodes.create', $formation->slug) }}" class="active btn btn-primary mb-4 float-right">Creer Episode </a>
                            </div>
                            <div class="wm-view-btn">
                                <a href="#" class="wmicon-squares active"></a>
                                <a href="#" class="wmicon-signs"></a>
                            </div>
                        </div>
                        <div class="wm-courses wm-courses-popular">
                            <ul class="row">
                                @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                @foreach($episodes as $episode)
                                    <li class="col-md-6">
                                        <div class="wm-courses-popular-wrap">
                                            <figure>
                                                <video class="js-player" height="20%" width="30%" playsinline controls>
                                                    <source src="{{ asset('storage/'.$episode->video_url) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </figure>
                                            <div class="wm-popular-courses-text mb-2">
                                                <h6><a href="{{ route('episodes.show', [$formation->slug, $chapitre->id, $episode->numero]) }}">
                                                        {{ $episode->nom }}
                                                    </a>
                                                </h6>
                                                <ul class="mb-2 mt-2">
                                                    <li>
                                                        <a class="btn btn-sm btn-success" href="{{ route('episodes.edit', [$formation->slug, $chapitre->id, $episode->numero]) }}" class="wm-color">Modifier episode</a>
                                                    </li>
                                                    <form class="deleteepisode_{{$episode->id}}" action="{{ route('episodes.destroy', [$formation->id, $chapitre->id, $episode->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <li>
                                                        <button class="btn btn-danger supp-episode btn-sm" id="{{$episode->id}}" data-toggle="modal" data-target="#exampleModal">
                                                            Supprimer Episode
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="wm-pagination">
                            {{ $episodes->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    <!--// Main Content \\-->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Supprimer Episode</h5>
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
                class="btn btn-primary delete-confirm"
            >
                Supprimer
            </button>
            </div>
        </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.plyr.io/3.6.4/plyr.js"></script>

<script>
    const players = Array.from(document.querySelectorAll('.js-player')).map(p => new Plyr(p));
    $(document).ready(function(){
        $(".delete-confirm").on("click", function(){
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.attr('id') // Extract info from data-* attributes
            $(`.deleteepisode_${id}`).submit();
        })
    });
</script>
<script>
    $('#price-filter').on('change', function() {
        $('#amount').val(this.value + ' DT');
    })
</script>
