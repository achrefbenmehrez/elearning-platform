<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
        integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ=="
        crossorigin="anonymous" />
    <!--// Mini Header \\-->
    <div class="wm-mini-header">
        <span class="wm-blue-transparent"></span>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wm-mini-title">
                        <h1>Nos Formations</h1>
                    </div>
                    <div class="wm-breadcrumb">
                        <ul>
                            <li><a href="{{ route('home') }}">Accueil</a></li>
                            <li><a href="{{ route('formations.index') }}">Formations</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Mini Header \\-->

    <!--// Main Content \\-->
    <div class="wm-main-content">

        <!--// Main Section \\-->
        <div class="wm-main-section">
            <div class="container">
                <div class="row">

                    <aside class="col-md-3">
                        <div class="widget wm-search-course">
                            <h3 class="wm-short-title wm-color">Trouver une formation</h3>
                            <p>Trouver une formation ici:</p>
                            <form action="{{ route('search') }}">
                                <ul>
                                    <li> <input type="text" placeholder="Nom formation" id="autocomplete" name="q"> <i
                                            class="fas fa-search"></i> </li>
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
                                <div id="slider-range"
                                    class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
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
                                <a href="#" class="active">Free</a>
                                <a href="#">Paid</a>
                            </div>
                            <div class="wm-view-btn">
                                <a href="#" class="wmicon-squares active"></a>
                                <a href="#" class="wmicon-signs"></a>
                            </div>
                        </div>
                        <div class="wm-courses wm-courses-popular">
                            <ul class="row">
                                <h4>Formations de la categorie {{ $categorie->nom }}</h4>
                                @foreach ($formations as $formation)
                                    <li class="col-md-4">
                                        <div class="wm-courses-popular-wrap">
                                            <figure> <a href="{{ route('formations.show', $formation->slug) }}"><img
                                                        src="{{ asset('storage/' . $formation->photo_url) }}"
                                                        style="width: 260px !important; height: 184px !important;"
                                                        alt=""> <span class="wm-popular-hover"> <small>see
                                                            course</small> </span> </a>
                                                <figcaption>
                                                    <img src="{{ asset('storage/' . $formation->user->photo_url) }}"
                                                        height="60px" width="60px" alt="">
                                                    <h6><a
                                                            href="{{ route('formations.show', $formation->slug) }}">{{ $formation->user->nom_utilisateur }}</a>
                                                    </h6>
                                                </figcaption>
                                            </figure>
                                            <div class="wm-popular-courses-text">
                                                <h6><a href="{{ route('formations.show', $formation->slug) }}">
                                                        {{ $formation->nom }}
                                                    </a>
                                                </h6>
                                                <div class="wm-courses-price"> <span>{{ $formation->prix }} DT</span>
                                                </div>
                                                <ul>
                                                    <li><a href="{{ route('formations.show', $formation->slug) }}"
                                                            class="wm-color"><i
                                                                class="fas fa-users"></i>{{ count($formation->payements) }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="wm-pagination">
                            {{ $formations->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    <!--// Main Content \\-->
</x-app-layout>
<script>
    $('#price-filter').on('change', function() {
        $('#amount').val(this.value + ' DT');
    })

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
    integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
    crossorigin="anonymous"></script>
<script type="text/javascript">
    $('#autocomplete').autocomplete({
        source: '{!! URL::route('autocomplete') !!}',
        minlength: 1,
        autoFocus: true,
        select: function(e, ui) {
            $('#searchname').val(ui.item.value);
        }
    });

</script>
