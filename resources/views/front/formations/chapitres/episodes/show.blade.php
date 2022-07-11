<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @if (isset($episode))
        <meta name="numero_episode" content="{{ $episode->numero }}" />
    @endif
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.4/plyr.css" />
    @if (isset($episode))
        <div class="container mt-4" style="width:80% !important;">
            <div class="d-flex row justify-content-center">
                <h1>Episode {{ $episode->numero }}/{{ count($formation->episodes) }}: {{ $episode->nom }}</h1>
                <br>
            </div>
            <div class="d-flex row justify-content-center">
                <h4 id="duration">Duration : {{ $duration }}</h4>
            </div>
        </div>
        <div class="container mt-4" style="width:80% !important;">
            <video id="player" controls>
                <source src="{{ route('stream.create', [$formation->slug, $episode->numero]) }}"
                    type="video/{{ explode('.', explode('/', $episode->video_url)[1])[1] }}">
                Your browser does not support the video tag.
            </video>
            <hr>
            <p class="container w-50 mt-4 mb-4">
            <h6>A propos de cette episode :</h6> {{ $episode->description }}</p>
            <hr>
            <div class="container mt-2 mb-2" style="margin-bottom: 10px !important; width: 100% !important;">
                <div class="d-flex justify-content-center mb-4">
                    <h1>Toutes les Episodes</h1>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @foreach ($formation->chapitres as $chapitre)
                            <div class="p-4 m-3 color-white shadow-sm chapitre-container h3"
                                style="padding: 10px 10px; background-color: rgba(237,237,237,1); border-radius: 1rem;"
                                data-toggle="collapse" data-target="#chapitre{{ $chapitre->id }}">
                                {{ $chapitre->nom }}</div>
                            <div id="chapitre{{ $chapitre->id }}" class="collapse">
                                @foreach ($chapitre->episodes as $episode)
                                    <div class="p-4 m-3 color-white shadow-sm episode-container"
                                        style="padding: 1.5rem !important; margin: 1rem !important; background-color: rgba(246,246,246,1); border-radius: 1rem;">
                                        <div class="container">
                                            <div class="row no-gutters">
                                                <div class="col-sm-2">
                                                    <a href="/formations/{{ $formation->slug }}/episodes/{{ $episode->numero }}"
                                                        alt=""><span class="badge badge-pill badge-secondary"
                                                            style="border-radius: 50%;">
                                                            <h3 style="color: white !important;">
                                                                {{ $episode->numero }}</h3>
                                                        </span></a>
                                                </div>
                                                <div class="col-lg">
                                                    <div class="d-flex flex-column">
                                                        <div class="p-2 h3"
                                                            style="padding: 0.5rem !important; font-size: 1.575rem !important;">
                                                            {{ $episode->nom }}</div>
                                                        <div class="p-2" style="padding: 0.5rem !important;">
                                                            {{ $episode->description }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if ($chapitre->tests && $chapitre->tests->published)
                                    <div class="p-4 m-3 color-white shadow-sm episode-container"
                                        style="padding: 1.5rem !important; margin: 1rem !important; background-color: rgba(246,246,246,1); border-radius: 1rem;">
                                        <div class="container">
                                            <div class="row no-gutters">
                                                <div class="col-sm-2">
                                                    <a href="{{ route('tests.show', [$formation->slug, $chapitre->id, $chapitre->tests->id]) }}"
                                                        alt=""><span class="badge badge-pill badge-secondary"
                                                            style="border-radius: 50%;">
                                                            <h3 style="color: white !important;"><i
                                                                    class="fas fa-check"></i></h3>
                                                        </span></a>
                                                </div>
                                                <div class="col-lg">
                                                    <div class="d-flex flex-column">
                                                        <div class="p-2 h3"
                                                            style="padding: 0.5rem !important; font-size: 1.575rem !important;">
                                                            {{ $episode->nom }}</div>
                                                        <div class="p-2" style="padding: 0.5rem !important;">
                                                            {{ $episode->description }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container w-75 mt-4 mb-4 wm-form-wrap wm-typography-element">
            <h1>{{ $msg }}</h1>
            <a href="{{ url()->previous() }}" class="btn btn-info">Retour</a>
        </div>
    @endif
</x-app-layout>
<script src="https://cdn.plyr.io/3.6.4/plyr.js"></script>
<script>
    $(document).ready(function() {
        const player = new Plyr('#player');

        $(function() {

            resumePlayback($('meta[name="numero_episode"]').attr('content'));

            var timeout;

            $("#player").on("playing pause", function(e) {

                // save reference
                var v = this

                // clear previous timeout, if any
                clearTimeout(timeout)

                // call immediately if paused or when started
                performaction(v.currentTime, $('meta[name="numero_episode"]').attr('content'))

                // set up interval to fire every 5 seconds
                if (e.type === "playing") {
                    timeout = setInterval(function() {
                        performaction(v.currentTime, $('meta[name="numero_episode"]')
                            .attr('content'))
                    }, 5000)
                }
            })

            function performaction(currentTime,
                videoId) { //pass video id to this function where you call it.
                var data = {
                    time: currentTime
                }; //data to send to server
                var dataType = "json" //expected datatype from server
                var headers = {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                $.post({
                    url: '/saveTime/' + videoId, //url of the server which stores time data
                    data: data,
                    headers: headers,
                    success: function(data, status) {},
                    dataType: dataType
                });
            }

            function resumePlayback(videoId) { //Ajax request for getting the time
                $.ajax({
                    url: '/getTime/' + videoId,
                    success: function(data, status) {
                        if (status == 'success') {
                            document.getElementById('player').currentTime = data
                                .playbackTime;
                        }
                    },
                    dataType: "json"
                });
            }

        })
    })

</script>
