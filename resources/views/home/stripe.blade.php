<!DOCTYPE html>
<html>
<head>
    @include('home.css')
</head>
<body>
@include('home.header')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payment Details</h3>
                </div>
                <div class="card-body">
                    @include('sweetalert::alert')
                    <form role="form"
                          action="{{ route('stripe.post', $totalprice) }}"
                          method="post"
                          class="require-validation"
                          data-cc-on-file="false"
                          data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                          id="payment-form">
                        @csrf
                        <div class="form-group">
                            <label for="card-name">Name on Card</label>
                            <input type="text" class="form-control" id="card-name" required>
                        </div>
                        <div class="form-group">
                            <label for="card-number">Card Number</label>
                            <input type="text" class="form-control card-number" size="20" autocomplete="off" id="card-number" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="card-expiry-month">Expiration Month</label>
                                <input type="text" class="form-control card-expiry-month" size="2" id="card-expiry-month" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="card-expiry-year">Expiration Year</label>
                                <input type="text" class="form-control card-expiry-year" size="4" id="card-expiry-year" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="card-cvc">CVC</label>
                                <input type="text" class="form-control card-cvc" size="4" autocomplete="off" id="card-cvc" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 error form-group hide">
                                <div class="alert-danger alert">Please correct the errors and try again.</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block" style="color: black;" type="submit">Pay Now (${{ $totalprice }})</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('home.script')
</body>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">

    $(function() {

        /*------------------------------------------
        --------------------------------------------
        Stripe Payment Code
        --------------------------------------------
        --------------------------------------------*/

        var $form = $(".require-validation");

        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey('pk_test_51MlbYXEY5qD0fPtLygCkvSiPOYQaAiYTr00cM3DXwLvRO15JRWMzhCeoTDCAsOTSYpCzYksA1FRDjnSaHgaJs7Xc00sLgcqx5T');
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }

        });

        /*------------------------------------------
        --------------------------------------------
        Stripe Response Handler
        --------------------------------------------
        --------------------------------------------*/
        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];

                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });
</script>
</html>
