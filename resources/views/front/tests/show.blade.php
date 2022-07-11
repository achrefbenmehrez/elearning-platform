<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

    body {
        box-sizing: border-box;
    }

    .containerr {
        padding: 20px;
        max-width: 700px
    }

    .question {
        width: 75%
    }

    .options {
        position: relative;
        padding-left: 40px
    }

    #options label {
        display: block;
        margin-bottom: 15px;
        font-size: 14px;
        cursor: pointer
    }

    .btn-primary {
        background-color: #555;
        color: #ddd;
        border: 1px solid #ddd
    }

    .btn-primary:hover {
        background-color: #21bf73;
        border: 1px solid #21bf73
    }

    .btn-success {
        padding: 5px 25px;
        background-color: #21bf73
    }

    @media(max-width:576px) {
        .question {
            width: 100%;
            word-spacing: 2px
        }
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
    background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
    display: none;
    }
    /* Make circles that indicate the steps of the form: */
    .step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
    }

    /* Mark the active step: */
    .step.active {
    opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
    background-color: #04AA6D;
    }
    /* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}

.question-text {
    -webkit-user-select: none; /* Safari */
-moz-user-select: none; /* Firefox */
-ms-user-select: none; /* IE10+/Edge */
user-select: none; /* Standard */
}

    </style>
    <?php
        if(isset($questions))
            $nmbre = count($questions);
    ?>
    <div class="container">
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
    @if(isset($questions))
        <form id="regForm" class="wm-form-wrap wm-typography-element" action="{{ route('test_result.store', [$formation->slug, $chapitre->id, $test->id]) }}" method="POST">
            @csrf
            @foreach ($questions as $key => $question)
                <div class="containerr mt-sm-5 my-1 container tab card shadow-lg">
                    <div class="question ml-sm-5 pl-sm-5 pt-2 card-body">
                        <div class="py-2 h5">
                            <b unselectable="on" class="question-text">Q{{$key+1}}/{{$nmbre}}. {{ $question->question }}</b>
                            <h5 class="float-right">{{ $question->score }} Points</h5>
                            @if($question->question_image)
                                <img src="{{ asset('storage/' .$question->question_image) }}" class="mt-2 mb-2" height="200px" width="350px">
                                <br>
                            @endif
                        </div>
                        <div class="pt-sm-0 pt-3" id="options">
                            @foreach ($question->options as $option)
                                <label class="options question-text">
                                    <input type="checkbox" name="reponses[{{$option->id}}][reponse]" oninput="this.className = ''">
                                    <span class="checkmark"></span>
                                    {{ $option->option }}
                                    <input type="text" name="reponses[{{$option->id}}][question]" value="{{ $question->id }}" hidden>
                                </label>
                            @endforeach

                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex align-items-center pt-3" style="display: flex !important; align-items: center !important; margin-top: 10px !important; margin-bottom: 10px !important;">
                <div id="prev" class="mr-auto ml-sm-5" style="margin-right: auto !important;">
                    <button type="button" class="btn btn-danger mr-auto" id="prevBtn" onclick="nextPrev(-1)">
                        Precedent
                    </button>
                </div>
                <div class="ml-auto mr-sm-5" style="margin-left: auto !important;">
                    <button type="button" class="btn btn-success ml-auto" id="nextBtn" onclick="nextPrev(1)">
                        Suivant
                    </button>
                </div>
            </div>
            <!-- Circles which indicates the steps of the form: -->
            <div style="text-align:center" class="mt-4 mb-4">
                @for ($i = 0 ; $i < $nmbre ; $i++)
                    <span class="step"></span>
                @endfor
            </div>
        </form>
    @else
        <div class="container w-75 mt-4 mb-4">
            <h1>{{ $msg }}</h1>
            <a href="{{ url()->previous() }}" class="btn btn-info">Retour</a>
        </div>
    @endif
    </div>
</x-app-layout>

<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Soumettre";
    } else {
        document.getElementById("nextBtn").innerHTML = "Suivant";
    }
    // ... and run a function that displays the correct step indicator:
    fixStepIndicator(n)
    }

    function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
        //...the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
    }

    function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
        // add an "invalid" class to the field:
        y[i].className += " invalid";
        // and set the current valid status to false:
        valid = false;
        }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
    }

    function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";
    }
</script>
