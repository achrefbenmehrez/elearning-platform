<x-app-layout>
<link rel="stylesheet" href="{{ asset('css/pay.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">

<div class="container mb-4 mt-4" style="margin-top: 20px !important; margin-bottom: 20px !important;">
    <span id="status"></span>
    <table id="cart" class="table table-hover table-condensed container">
        <thead>
        <tr>
            <th style="width:50%">Produit</th>
            <th style="width:10%">Prix</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>

        <?php $total = 0 ?>

        @if(session('cart'))
            @foreach((array) session('cart') as $id => $details)

                <?php $total += $details['prix'] ?>

                <tr class="products">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-9 hidden-xs"><img src="{{ 'storage/' .$details['photo'] }}" width="300" height="300" class="img-responsive"/></div>
                            <div class="col-sm-2">
                                <h4 class="">{{ $details['nom'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Prix">{{ $details['prix'] }} DT</td>
                    <td data-th="Subtotal" class="text-center"><span class="product-subtotal">{{ $details['prix'] }} DT</span></td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                        <i class="fa fa-circle-o-notch fa-spin spinner-border text-primary" style="font-size:24px; display: none"></i>
                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
        <tfoot>
        <tr>
            <td><a href="{{ route('home') }}" class="btn btn-info"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                <a class="btn btn-danger clear-cart ml-2"><i class="fas fa-trash"></i> Clear cart</a>
            </td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total : <span class="cart-total"> {{ $total }} DT</span></strong></td>
        </tr>
        </tfoot>
    </table>

<div class="container px-4 py-5 mx-auto">
    <form method="POST" action="/payement">
        @csrf
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                @if (session('status'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-3 radio-group">
                        <div class="row d-flex px-3 radio"> <img class="pay" src="{{asset('img/WIAP9Ku.jpg')}} ">
                            <p class="my-auto">Carte de crédit </p>
                        </div>
                        <div class="row d-flex px-3 radio gray"> <img class="pay" src="{{asset('img/OdxcctP.jpg')}}">
                            <p class="my-auto">Carte de débit</p>
                        </div>
                        <div class="row d-flex px-3 radio gray mb-3"> <img class="pay" src="{{asset('img/edinar.jpg')}}">
                            <p class="my-auto mr-2">e-dinar</p>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="row px-2">
                            <div class="form-group col-md-6"> <label class="form-control-label">Nom de la carte</label> <input type="text" id="cname" name="nom_titulaire" placeholder=""> </div>
                            <div class="form-group col-md-6"> <label class="form-control-label">Numéro de la carte</label> <input type="text" id="cnum" name="numero_carte" placeholder=""> </div>
                        </div>
                        <div class="row px-2">
                            <div class="form-group col-md-6"> <label class="form-control-label">Date d'expiration</label> <input type="month" id="exp" name="date_expiration"> </div>
                            <div class="form-group col-md-6"> <label class="form-control-label">CVV</label> <input type="text" id="cvv" name="CVV" placeholder="***"> </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-2">

                        <input type="hidden" name="total" value="{{ $total }}">
                        <div class="row d-flex justify-content-between px-4" id="tax">
                            <p class="mb-1 text-left">Total</p>
                            <h6 class="mb-1 text-right">{{ $total }} DT</h6>
                        </div> <button style="background-color:#86bce0" class="btn-block btn-blue">Valider<i class="fas fa-check ml-2"></i>  </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
</div>
</x-app-layout>

<script type="text/javascript">
$(document).ajaxStart(function() {
            $("#loader").show();
        });

        $(document).ajaxComplete(function() {
            $("#loader").hide();
        });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        var parent_row = ele.parents("tr");

        var cart_total = $(".cart-total");

        if(confirm("Are you sure")) {
            $.ajax({
                url: '{{ url('remove-from-cart') }}',
                method: "DELETE",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                dataType: "json",
                success: function (response) {
                    parent_row.remove();

                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');

                    $("#header-bar").html(response.data);

                    cart_total.text(response.total);
                },
            });
        }
    });

    $(".clear-cart").click(function(e) {
            e.preventDefault();

            $.ajax({
                url: "clear-cart",
                dataType: "JSON",
                success: function(response) {
                    $("span#status").html('<div class="alert alert-success">' + response.msg + '</div>');
                    $(".products").html("");
                },
                error: function(xhr, status, error) {
                    $("span#status").html('<div class="alert alert-danger">' + xhr.status + '</div>');
                    $(".products").html("");
                }
            });
        });

</script>
