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
    #msform input, #msform textarea {
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

    #msform input:focus, #msform textarea:focus {
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

    #msform .action-button:hover, #msform .action-button:focus {
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

    #msform .action-button-previous:hover, #msform .action-button-previous:focus {
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
        z-index: -1; /*put it behind the numbers*/
    }

    /*marking active/completed steps green*/
    /*The number of the step and the connector before it = green*/
    #progressbar li.active:before, #progressbar li.active:after {
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

    .dme_link a:hover, .dme_link a:focus {
        background: #C5C5F1;
        text-decoration: none;
    }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <!-- MultiStep Form -->
    <div class="row mb-4 mt-4 multistep-form">
        <div class="col-md-6 col-md-offset-3">
            <form id="msform">
                <!-- progressbar -->
                <ul id="progressbar">
                    <li class="active">Formation</li>
                    <li>Chapitres</li>
                    <li>Episodes</li>
                </ul>
                <!-- fieldsets -->
                <fieldset>
                    <h2 class="fs-title">Creer chapitre</h2>
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <div class="chapitre1 mb-4">
                        <label class="fieldlabels" id="chapitre1">Nom chapitre 1: * </label>
                        <input type="text" name="chapitres[1][nom]" placeholder="Nom chapitre" id="first-chapitre" />
                    </div>
                    <button class="btn btn-primary ajouter-chapitre">Ajouter un autre chapitre</button>

                    <input type="submit" name="next" class="next action-button" value="Next"/>
                </fieldset>
            </form>
        </div>
    </div>

</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>

<script type="text/javascript">
    var i = 1;
    $(`.ajouter-chapitre`).click(function(event) {
        event.preventDefault();
        i++;
        var formgroup = `<div class="chapitre${i} mb-4">
                            <label class='fieldlabels' id="chapitre${i}">Nom chapitre ${i}: * </label>
                            <button class="btn btn-danger btn-sm ml-4 supprimer-chapitre${i}">Supprimer chapitre</button>
                            <input type='text' name='chapitres[${i}][nom]' placeholder='Nom chapitre' />
                        </div>`;
        $(`div .chapitre${i-1}`).after(formgroup);
        $(`.supprimer-chapitre${i}`).click(function(event) {
            event.preventDefault();
            if(confirm('are you sure'))
            {
                $(this).parent('div').remove();
                i--;
                $('.nb-chap').val(i);
            }
        });
        $('.nb-chap').val(i);
    });

    $("#msform").on("submit",function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData(this);

        var type = "POST";

        $.ajax({
            type: type,
            url: "{{ route('chapitres.store', $formation->slug) }}",
            data: formData,
            dataType: 'json',
            cache:false,
            contentType: false,
            processData: false,
            success: function (response) {
                if($.isEmptyObject(response.error)){
    		        window.location.href = `{{ route('MesFormations') }}`;
    	        }
                else{
                    window.scrollTo({ top: 0, behavior: 'smooth' });
    		        printErrorMsg(response.error);
    	        }
            },
        });
    });

  function printErrorMsg (msg) {
	$(".print-error-msg").find("ul").html('');
	$(".print-error-msg").css('display','block');
	$.each( msg, function( key, value ) {
		$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
	});
  }
</script>
