<x-app-layout>
    <style>
        /*custom font*/
        @import url(https://fonts.googleapis.com/css?family=Montserrat);

        /*basic reset*/
        * {
            margin: 0;
            padding: 0;
        }

        html {
            height: 100%;
        }

        .multistep-form {
            background-color: #f7f7f7;
            margin-bottom: 40px;
        }

        body {
            font-family: montserrat, arial, verdana;
        }

        /*form styles*/
        #msform {
            text-align: center;
            position: relative;
            margin-top: 30px;
            margin-bottom: 40px;
        }

        #msform fieldset {
            background: white;
            border: 0 none;
            border-radius: 0px;
            box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
            padding: 20px 30px;
            box-sizing: border-box;
            width: 80%;
            margin: 0 10%;

            /*stacking fieldsets above each other*/
            position: relative;
        }

        /*Hide all except first fieldset*/
        #msform fieldset:not(:first-of-type) {
            display: none;
        }

        /*inputs*/
        #msform input,
        #msform textarea {
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 0px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            font-size: 13px;
        }

        #msform input:focus,
        #msform textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #ee0979;
            outline-width: 0;
            transition: All 0.5s ease-in;
            -webkit-transition: All 0.5s ease-in;
            -moz-transition: All 0.5s ease-in;
            -o-transition: All 0.5s ease-in;
        }

        /*buttons*/
        #msform .action-button {
            width: 100px;
            background: #41a6c6;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 25px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }

        #msform .action-button:hover,
        #msform .action-button:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #41a6c6;
        }

        #msform .action-button-previous {
            width: 100px;
            background: #C5C5F1;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 25px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }

        #msform .action-button-previous:hover,
        #msform .action-button-previous:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #C5C5F1;
        }

        /*headings*/
        .fs-title {
            font-size: 18px;
            text-transform: uppercase;
            color: #2C3E50;
            margin-bottom: 10px;
            letter-spacing: 2px;
            font-weight: bold;
        }

        .fs-subtitle {
            font-weight: normal;
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
        }

        /*progressbar*/
        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            /*CSS counters to number the steps*/
            counter-reset: step;
        }

        #progressbar li {
            list-style-type: none;
            text-transform: uppercase;
            font-size: 9px;
            width: 33.33%;
            float: left;
            position: relative;
            letter-spacing: 1px;
        }

        #progressbar li:before {
            content: counter(step);
            counter-increment: step;
            width: 24px;
            height: 24px;
            line-height: 26px;
            display: block;
            font-size: 12px;
            color: #333;
            border-radius: 25px;
            margin: 0 auto 10px auto;
        }

        /*progressbar connectors*/
        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            position: absolute;
            left: -50%;
            top: 9px;
            z-index: -1;
            /*put it behind the numbers*/
        }

        /*marking active/completed steps green*/
        /*The number of the step and the connector before it = green*/
        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #41a6c6;
            color: white;
        }


        /* Not relevant to this form */
        .dme_link {
            margin-top: 30px;
            text-align: center;
        }

        .dme_link a {
            background: #41a6c6;
            font-weight: bold;
            color: #41a6c6;
            border: 0 none;
            border-radius: 25px;
            cursor: pointer;
            padding: 5px 25px;
            font-size: 12px;
        }

        .dme_link a:hover,
        .dme_link a:focus {
            background: #C5C5F1;
            text-decoration: none;
        }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- MultiStep Form -->
    <div class="row mb-4 mt-4 multistep-form">
        <div class="col-md-6 col-md-offset-3">
            <form id="msform" action="{{ route('formations.store') }}" method="POST">
                @csrf
                <!-- progressbar -->
                <ul id="progressbar">
                    <li class="active">Formation</li>
                    <li>Chapitres</li>
                    <li>Episodes</li>
                </ul>
                <!-- fieldsets -->
                <fieldset>
                    <h2 class="fs-title">Creer Episode</h2>
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="episode1 mb-4">
                        <label class="fieldlabels" id="nomepisode">Nom Episode: *</label> <input type="text"
                            name="episodes[1][nom]" placeholder="Nom episode" />
                        <label class="fieldlabels">Description: *</label> <textarea name="episodes[1][description]"
                            class="form-control" placeholder="Description episode"></textarea>
                        <label class="fieldlabels">Numero episode: *</label> <input type="number"
                            name="episodes[1][numero]" placeholder="Numero episode" />
                        <label class="fieldlabels">Importer video:</label> <input type="file" name="episodes[1][video]"
                            accept="video/*">

                        <div class="mt-3">
                            <span><a id="download" style="display: none;"><button type="button" class="btn btn-primary">
                                        Download</button></a></span>
                            <button type="button" class="btn btn-danger" id="stop" disabled>Stop</button>
                            <button type="button" onclick="recordAudio()" class="btn btn-info">Record Audio</button>
                            <button type="button" onclick="recordVideo()" class="btn btn-info">Record Video</button>
                            <button type="button" onclick="recordScreen()" class="btn btn-info">Record Screen</button>
                            <div class="video_output">
                            </div>
                        </div>

                        <label class="fieldlabels">Chapitre</label>
                        <select class="form-control" name="episodes[1][chapitre_id]">
                            @foreach ($formation->chapitres as $key => $chapitre)
                                <option value="{{ $chapitre->id }}"
                                    {{ $key == $chapitre->id ? 'selected' : '' }}>
                                    {{ $chapitre->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary ajouter-episode">Ajouter une autre episode</button>
                    <input type="submit" name="next" class="next action-button" value="Next" />
                </fieldset>
            </form>
        </div>
    </div>

</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>

<script>
    let shouldStop = false;
    let stopped = false;
    const downloadLink = document.getElementById('download');
    const stopButton = document.getElementById('stop');

    function startRecord() {
        $('.btn-info').prop('disabled', true);
        $('#stop').prop('disabled', false);
        $('#download').css('display', 'none')
    }

    function stopRecord() {
        $('.btn-info').prop('disabled', false);
        $('#stop').prop('disabled', true);
        $('#download').css('display', 'block')
    }
    const audioRecordConstraints = {
        echoCancellation: true
    }

    stopButton.addEventListener('click', function() {
        shouldStop = true;
    });

    const handleRecord = function({
        stream,
        mimeType
    }) {
        startRecord()
        let recordedChunks = [];
        stopped = false;
        const mediaRecorder = new MediaRecorder(stream);

        mediaRecorder.ondataavailable = function(e) {
            if (e.data.size > 0) {
                recordedChunks.push(e.data);
            }

            if (shouldStop === true && stopped === false) {
                mediaRecorder.stop();
                stopped = true;
            }
        };

        mediaRecorder.onstop = function() {
            const blob = new Blob(recordedChunks, {
                type: mimeType
            });
            recordedChunks = []
            const filename = window.prompt('Enter file name');
            downloadLink.href = URL.createObjectURL(blob);
            downloadLink.download = `${filename || 'recording'}.webm`;
            stopRecord();
            videoElement = document.getElementsByTagName('video')[0];
            videoElement.remove();
        };

        mediaRecorder.start(200);
    };

    async function recordAudio() {
        const mimeType = 'audio/webm';
        shouldStop = false;
        const stream = await navigator.mediaDevices.getUserMedia({
            audio: audioRecordConstraints
        });
        handleRecord({
            stream,
            mimeType
        })
    }

    async function recordVideo() {
        const mimeType = 'video/webm';
        shouldStop = false;
        const constraints = {
            audio: {
                "echoCancellation": true
            },
            video: {
                "width": {
                    "min": 640,
                    "max": 1024
                },
                "height": {
                    "min": 480,
                    "max": 768
                }
            }
        };
        const stream = await navigator.mediaDevices.getUserMedia(constraints);
        var video = '<video autoplay height="480" width="640" muted></video>';
        $('.video_output').prepend(video);
        videoElement = document.getElementsByTagName('video')[0];
        videoElement.srcObject = stream;
        handleRecord({
            stream,
            mimeType
        })
    }

    async function recordScreen() {
        const mimeType = 'video/webm';
        shouldStop = false;
        const constraints = {
            video: {
                cursor: 'motion'
            }
        };
        if (!(navigator.mediaDevices && navigator.mediaDevices.getDisplayMedia)) {
            return window.alert('Screen Record not supported!')
        }
        let stream = null;
        const displayStream = await navigator.mediaDevices.getDisplayMedia({
            video: {
                cursor: "motion"
            },
            audio: {
                'echoCancellation': true
            }
        });
        if (window.confirm("Record audio with screen?")) {
            const voiceStream = await navigator.mediaDevices.getUserMedia({
                audio: {
                    'echoCancellation': true
                },
                video: false
            });
            let tracks = [...displayStream.getTracks(), ...voiceStream.getAudioTracks()]
            stream = new MediaStream(tracks);
            handleRecord({
                stream,
                mimeType
            })
        } else {
            stream = displayStream;
            handleRecord({
                stream,
                mimeType
            });
        };
        videoElement = document.getElementsByTagName('video')[0];
        videoElement.srcObject = stream;
    }

</script>

<script type="text/javascript">
    var j = 1;
    $(`.ajouter-episode`).click(function(event) {
        event.preventDefault();
        j++;
        var formgroup = `<div class="episode${j}">
                            <label class="fieldlabels" id="nomepisode">Nom Episode: *</label> <button class="btn btn-danger btn-sm ml-4 supprimer-episode${j}">Supprimer Episode</button> <input type="text" name="episodes[${j}][nom]" placeholder="Nom episode" />
                            <label class="fieldlabels">Description: *</label> <textarea name="episodes[${j}][description]" class="form-control" placeholder="Description episode" ></textarea>
                            <label class="fieldlabels">Numero episode: *</label> <input type="number" name="episodes[${j}][numero]" placeholder="Numero episode" />
                            <label class="fieldlabels">Importer video:</label> <input type="file" name="episodes[${j}][video]" accept="video/*">
                            <select class="form-control" name="episodes[${j}][chapitre_id]">
                                @foreach ($formation->chapitres as $key => $chapitre)
                                    <option value="{{ $chapitre->id }}" {{ $key == $chapitre->id ? 'selected' : '' }}>
                                        {{ $chapitre->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>`;
        $(`div .episode${j-1}`).after(formgroup);
        $(`.supprimer-episode${j}`).click(function(event) {
            event.preventDefault();
            if (confirm('are you sure')) {
                $(this).parent('div').remove();
                j--;
                $('.nb_ep').val(j);
            }
        });
        $('.nb-ep').val(j);
    });

    $(document).ajaxStart(function() {
        $("#loader").show();
    });

    $(document).ajaxComplete(function() {
        $("#loader").hide();
    });
    $("#msform").on("submit", function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData(this);

        var type = "POST";
        var url = window.location.pathname;

        var ajaxurl = "{{ route('episodes.store', $formation->slug) }}";

        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    window.location.href =
                        "http://elearning.test/formations/${response.slug}/chapitres";
                } else {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    printErrorMsg(response.error);
                }
            },
        });
    });

    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $.each(msg, function(key, value) {
            $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
        });
    }

</script>
