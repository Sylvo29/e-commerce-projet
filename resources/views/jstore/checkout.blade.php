@extends('simple')

@section('title')
    Cart {{ $site_title() }}
@endsection




@section('content')

    <div class="main_content">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="heading_s1 billing_box">
                            <h4>
                                @if (auth()->check() &&
                                        auth()->user()->addresses->isNotEmpty())
                                    {{ __('messages.billingDetails') }}
                                @else
                                    {{ __('messages.addressDetails') }}
                                   
                                @endif
                            </h4>
                            @if (auth()->check() &&
                                    auth()->user()->addresses->isNotEmpty())
                                <form action="">
                                    <select class="form-control" name="billing_address_id" id="billing_address_id">
                                        <option value="null">{{ __('messages.selectBillingAddress') }}</option>
                                        @foreach (auth()->user()->addresses as $address)
                                            <option
                                                {{ request()->get('billing_address_id') == $address->id ? 'selected' : '' }}
                                                value="{{ $address->id }}">
                                                {{ $address->street }} {{ $address->codePostal }} {{ $address->city }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            @else
                                <form action="" class="row">
                                    @csrf
                                    <div class="mb-1 col-md-12">
                                        <input class="form-control" placeholder="Name ..." type="text" name="name" />
                                    </div>
                                    <div class="mb-1 col-md-12">
                                        <input class="form-control" placeholder="Street ..." type="text"
                                            name="street" />
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <input class="form-control" placeholder="Code Postal ..." type="text"
                                            name="codePostal" />
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <input class="form-control" placeholder="City ..." type="text" name="city" />
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <input class="form-control" placeholder="State ..." type="text" name="state" />
                                    </div>
                                </form>
                            @endif
                        </div>

                        <div class="mb-1 col-md-12 form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="add_shipping_address"
                                @if (request()->has('shipping_address_id') ||
                                        (request()->has('different_address') && request()->get('different_address') == 'true')) checked d-none @endif id="add_shipping_address" />
                            <label for="">{{ __("messages.checkShipping") }}</label>
                        </div>

                        <div class="heading_s1 shipping_box @if (
                            !request()->has('shipping_address_id') &&
                                (!request()->has('different_address') || request()->get('different_address') == 'false')) d-none @endif">
                            <h4 class="">{{ __("messages.shippingDetails") }}</h4>
                            @if (auth()->check() &&
                                    auth()->user()->addresses->isNotEmpty())
                                <form action="">
                                    <select class="form-control" name="shipping_address_id" id="shipping_address_id">
                                        <option value="null">{{ __('messages.selectShippingAddress') }}</option>
                                        @foreach (auth()->user()->addresses as $address)
                                            <option
                                                {{ request()->get('shipping_address_id') == $address->id ? 'selected' : '' }}
                                                value="{{ $address->id }}">
                                                {{ $address->street }} {{ $address->codePostal }} {{ $address->city }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            @else
                                <form action="" class="row">
                                    @csrf
                                    <div class="mb-1 col-md-12">
                                        <input class="form-control" placeholder="Name ..." type="text" name="name" />
                                    </div>
                                    <div class="mb-1 col-md-12">
                                        <input class="form-control" placeholder="Street ..." type="text"
                                            name="street" />
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <input class="form-control" placeholder="Code Postal ..." type="text"
                                            name="codePostal" />
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <input class="form-control" placeholder="City ..." type="text" name="city" />
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <input class="form-control" placeholder="State ..." type="text" name="state" />
                                    </div>
                                </form>
                            @endif
                        </div>

                        <div class="mb-1 col-md-12 form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="change_carrier"
                                @if (request()->has('carrier_id')) checked @endif id="change_carrier" />
                            <label for="">{{ __("messages.checkCarrier") }}</label>
                        </div>
                        <div class="heading_s1 mb-3 carrier_box @if (!request()->get('carrier_id')) d-none @endif">
                            <h4>{{ __('messages.carrier') }}</h4>
                            <div class="">
                                <form action="">
                                    <select class="form-control" name="carrier_id" id="carrier_id">
                                        @foreach ($carriers as $carrier)
                                            <option {{ request()->get('carrier_id') == $carrier->id ? 'selected' : '' }}
                                                value="{{ $carrier->id }}">{{ $carrier->name }}
                                                ({{ $format_price($carrier->price) }})
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="order_review">
                            <div class="heading_s1">
                                <h4>{{ __("messages.yourOrders") }}</h4>
                            </div>
                            <div class="table-responsive order_table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __("messages.product") }}</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart['items'] as $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ $get_image($item['product']) }}" width="25"
                                                        height="25"
                                                        alt="image of product : {{ $item['product']['name'] }}">
                                                    {{ $item['product']['name'] }}
                                                    <span class="product-qty">
                                                        {{ $format_price($item['product']['soldePrice']) }} x
                                                        {{ $item['quantity'] }}</span>
                                                </td>
                                                <td>{{ $format_price($item['sub_total']) }}</td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>{{ __("messages.subtotal") }}</th>
                                            <td class="product-subtotal">{{ $format_price($cart['sub_total']) }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __("messages.shipping") }} ({{ $cart['carrier_name'] }})</th>
                                            <td>{{ $format_price($cart['shipping_price']) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td class="product-subtotal">
                                                {{ $format_price($cart['sub_total_with_shipping']) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            @if ($readyToPay)
                                <a href="#" id="paymentBtnAction" class="btn btn-fill-out btn-block">{{ __("messages.payNow") }}
                                    ({{ $format_price($cart['sub_total_with_shipping']) }})
                                </a>
                            @endif
                            <div class="">
                                <ul class="footer_payment text-center text-lg-end d-flex gap-2 justify-content-center m-2">
                                    <li><a href="#" class="card"><img src="/assets/images/visa.png"
                                                alt="visa"></a></li>
                                    <li><a href="#" class="card"><img src="/assets/images/discover.png"
                                                alt="discover"></a>
                                    </li>
                                    <li><a href="#" class="card"><img src="/assets/images/master_card.png"
                                                alt="master_card"></a></li>
                                    <li><a href="#" class="card"><img src="/assets/images/paypal.png"
                                                alt="paypal"></a></li>
                                    <li><a href="#" class="card"><img src="/assets/images/amarican_express.png"
                                                alt="amarican_express"></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="pages">
                                @foreach ($pages as $page)
                                    <a href="#" data-id="{{ $page->id }}" data-title="{{ $page->title }}"
                                        data-content="{{ $page->content }}" class=" page">{{ $page->title }}</a>
                                    {{ !$loop->last ? ' | ' : '' }}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="pageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="paymentModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="payment-form">
                        <div id="payment-element">
                            <!--Stripe.js injects the Payment Element-->
                        </div>
                        <button id="submit" class="btn btn-fill-out btn-block my-1">
                            <div class="spinner hidden" id="spinner"></div>
                            <span id="button-text">{{ __("messages.payNow") }} ({{ $format_price($cart['sub_total_with_shipping']) }})</span>
                        </button>
                        <div id="payment-message" class="hidden"></div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const pages = document.querySelectorAll('.page')
        const changeCarrier = document.querySelector('input#change_carrier')
        const addShippingAddress = document.querySelector('input#add_shipping_address')
        const carrierSelect = document.querySelector('select#carrier_id')
        const billingSelect = document.querySelector('select#billing_address_id')
        const shippingSelect = document.querySelector('select#shipping_address_id')
        const datas = [carrierSelect, billingSelect, shippingSelect]
        changeCarrier.onchange = (event) => {
            const {
                checked
            } = event.target
            const carrier_box = document.querySelector('.carrier_box')
            if (checked) {
                carrier_box.classList.remove('d-none')
            } else {
                carrier_box.classList.add('d-none')
            }

        }
        addShippingAddress.onchange = (event) => {
            const {
                checked
            } = event.target
            console.log(checked);
            const shipping_box = document.querySelector('.shipping_box')
            const billing_box = document.querySelector('.billing_box')
            const name = 'different_address'
            if (checked) {
                shipping_box.classList.remove('d-none')
                billing_box.querySelector('h4').innerText = 'Billing Details'
            } else {
                shipping_box.classList.add('d-none')
                billing_box.querySelector('h4').innerText = 'Address Details'
            }
            const urlParams = new URLSearchParams(window.location.search)
            urlParams.set(name, checked)
            const newLink = window.location.origin + window.location.pathname + '?' + urlParams
                .toString()

            console.log(newLink);
            window.location.href = newLink
        }
        datas.forEach(data => {
            if (data) {
                data.onchange = (event) => {
                    const {
                        name,
                        value
                    } = event.target
                    const urlParams = new URLSearchParams(window.location.search)
                    urlParams.set(name, value)
                    const newLink = window.location.origin + window.location.pathname + '?' + urlParams
                        .toString()

                    console.log(newLink);
                    window.location.href = newLink

                }
            }
        });
        pages.forEach((page) => {
            page.onclick = (event) => {
                const {
                    id,
                    title,
                    content
                } = event.target.dataset
                const pageModal = document.querySelector('#pageModal')
                pageModal.querySelector('.modal-title').innerText = title
                pageModal.querySelector('.modal-body').innerHTML = content
                const modal = new bootstrap.Modal(pageModal)
                modal.show()
            }
        })
    </script>
    <script>
        const paymentBtnAction = document.getElementById('paymentBtnAction')
        if (paymentBtnAction) {
            paymentBtnAction.onclick = (event) => {
                event.preventDefault();
                const paymentModal = document.querySelector('#paymentModal')
                const modal = new bootstrap.Modal(paymentModal)
                modal.show()

            }
        }
        const stripe = Stripe("{{$stripe_public_key}}");


        let elements;

        initialize();
        checkStatus();

        document
            .querySelector("#payment-form")
            .addEventListener("submit", handleSubmit);

        // Fetches a payment intent and captures the client secret
        async function initialize() {
            const urlPath = window.location.origin+'/checkout/create-paiment-intent/{{$orderId}}'
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const {clientSecret} = await fetch(urlPath, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({}),
            }).then((r) => r.json());

            elements = stripe.elements({
                clientSecret
            });

            const paymentElementOptions = {
                layout: "tabs",
            };

            const paymentElement = elements.create("payment", paymentElementOptions);
            paymentElement.mount("#payment-element");
        }

        async function handleSubmit(e) {
            e.preventDefault();
            setLoading(true);

            const redirectUrl = window.location.origin + '/checkout/payment/success'
            const { error } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    // Make sure to change this to your payment completion page
                    return_url: redirectUrl,
                },
            });

            // This point will only be reached if there is an immediate error when
            // confirming the payment. Otherwise, your customer will be redirected to
            // your `return_url`. For some payment methods like iDEAL, your customer will
            // be redirected to an intermediate site first to authorize the payment, then
            // redirected to the `return_url`.
            if (error.type === "card_error" || error.type === "validation_error") {
                showMessage(error.message);
            } else {
                showMessage("An unexpected error occurred.");
            }

            setLoading(false);
        }

        // Fetches the payment intent status after payment submission
        async function checkStatus() {
            const clientSecret = new URLSearchParams(window.location.search).get(
                "payment_intent_client_secret"
            );

            if (!clientSecret) {
                return;
            }

            const {
                paymentIntent
            } = await stripe.retrievePaymentIntent(clientSecret);

            switch (paymentIntent.status) {
                case "succeeded":
                    showMessage("Payment succeeded!");
                    break;
                case "processing":
                    showMessage("Your payment is processing.");
                    break;
                case "requires_payment_method":
                    showMessage("Your payment was not successful, please try again.");
                    break;
                default:
                    showMessage("Something went wrong.");
                    break;
            }
        }

        // ------- UI helpers -------

        function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");

            messageContainer.classList.remove("hidden");
            messageContainer.textContent = messageText;

            setTimeout(function() {
                messageContainer.classList.add("hidden");
                messageContainer.textContent = "";
            }, 4000);
        }

        // Show a spinner on payment submission
        function setLoading(isLoading) {
            if (isLoading) {
                // Disable the button and show a spinner
                document.querySelector("#submit").disabled = true;
                document.querySelector("#spinner").classList.remove("hidden");
                document.querySelector("#button-text").classList.add("hidden");
            } else {
                document.querySelector("#submit").disabled = false;
                document.querySelector("#spinner").classList.add("hidden");
                document.querySelector("#button-text").classList.remove("hidden");
            }
        }
    </script>
@endsection
