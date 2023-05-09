@extends('front.layout.app')
@section('content')
<style>
    .errorValidation{
        border: 2px solid red;
    }
</style>
    <section id="paymentForm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-lg-8 col-md-12">
                    <div class="loginFormSubmit">
                        <div class="row">
                            <div class="textHeader mb-5 text-center">
                                <h2>Payment Information</h2>
                            </div>
                            <div class="col-sm-6">
                                <div class="billingInfo">
                                    <div class="numberBiling d-flex mb-3">
                                        <div class="numberRound text-center me-3">
                                            <span>1</span>
                                        </div>
                                        <div class="textItem">
                                            <h6>Billing Info</h6>
                                        </div>
                                    </div>
                                    <input type="hidden" name="leauge" id="leauge" value="{{$season->leauge}}">
                                    <input type="hidden" name="season" id="season" value="{{$season->id}}">
                                    <div class="mb-3">
                                        <label for="fname" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="fname" name="fname"
                                            placeholder="John" value="{{ ucfirst(auth()->user()->name) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="Street Address">
                                    </div>
                                    <div class="row">
                                        <div class=" col-sm-6 mb-3">
                                            <label for="validationCustom03" class="form-label">City</label>
                                            <input type="text" class="form-control" placeholder="City" id="city"
                                                required>
                                            <div class="invalid-feedback">
                                                Please provide a valid city.
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label for="validationCustom05" class="form-label">Zip</label>
                                            <input type="text" class="form-control" placeholder="Zip" id="zip"
                                                required>
                                            <div class="invalid-feedback">
                                                Please provide a valid zip.
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <input type="text" class="form-control" id="country" name="country"
                                            placeholder="USA">
                                    </div>
                                    <a href="{{ route('teams') }}" type="button" class="btn btn-primary">Return Back
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="numberBiling d-flex mb-3">
                                    <div class="numberRound text-center me-3">
                                        <span>2</span>
                                    </div>
                                    <div class="textItem">
                                        <h6>Credit Card Info</h6>
                                    </div>
                                    <div>
                                        @if (Session::has('error'))
                                            <span class="alert alert-danger">{{ Session::get('error') }}</span>
                                        @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="inputsForm">
                                    <form id="payment-form">
                                        <div id="payment-element">
                                            <!-- Mount the Payment Element here -->
                                        </div>
                                        <span id="msg"></span><br><br>
                                        <button id="submit" class="btn btn-primary" onclick="handleSubmit()">Pay</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe(
            'pk_test_51N0zp6SEbSqasrdrEZlJNC7ZqTgZQ9KLS2FyEitwCpbX3JxAim539JWWEQK7uFTi7y0lINyeiESxSAm5XTXa4gNS00kf1qLCRv'
        );

        const options = {
            mode: 'payment',
            currency: 'inr',
            amount: 1099,
        };
        const elements = stripe.elements(options);
        const paymentElement = elements.create('payment');
        paymentElement.mount("#payment-element");

        async function handleSubmit() {
            event.preventDefault();
            const name = document.getElementById('fname');
            const address = document.getElementById('address');
            const city = document.getElementById('city');
            const zip = document.getElementById('zip');
            const country = document.getElementById('country');
            const leauge = document.getElementById('leauge');
            const season = document.getElementById('season');
            if (!name.value) {
                name.classList.add("errorValidation");
                return;
            }else{
                name.classList.remove("errorValidation");
            }
            if (!address.value) {
                address.classList.add("errorValidation");
                return;
            }else{
                address.classList.remove("errorValidation");
            }
            if (!city.value) {
                city.classList.add("errorValidation");
                return;
            }else{
                city.classList.remove("errorValidation");
            }
            if (!zip.value) {
                zip.classList.add("errorValidation");
                return;
            }else{
                zip.classList.remove("errorValidation");
            }
            if (!country.value) {
                country.classList.add("errorValidation");
                return;
            }else{
                country.classList.remove("errorValidation");
            }

            if (!stripe) {
                return;
            }
            //setLoading(true);
            const {
                error: submitError
            } = await elements.submit();
            if (submitError) {
                handleError(submitError);
                return;
            }
            let data = {
                amount: 100,
                name:name.value,
                address:address.value,
                city:city.value,
                zip:zip.value,
                country:country.value,
                leauge:leauge.value,
                season:season.value
            };

            const res = await fetch("/payment/store", {
                method: "POST",
                body: JSON.stringify(data),
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': getMeta('csrf-token')
                },

            });

            let clientSecret = await res.json();
            console.log(clientSecret);
            const {
                error
            } = await stripe.confirmPayment({
                elements,
                clientSecret,
                confirmParams: {
                    return_url: 'http://127.0.0.1:8000/success',
                },

            });

            if (error) {
                handleError(error);

            }

            async function handleError(error) {
                let tt = await error;

                console.log(tt.decline_code);
            }
        };

        function getMeta(metaName) {
            const metas = document.getElementsByTagName('meta');

            for (let i = 0; i < metas.length; i++) {
                if (metas[i].getAttribute('name') === metaName) {
                    return metas[i].getAttribute('content');
                }
            }
            return '';
        }
    </script>
@endsection
