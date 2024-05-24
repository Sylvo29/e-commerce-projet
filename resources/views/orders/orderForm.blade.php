    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection
    <div class="row">
    <div class="col-md-8">
        <form action="{{ isset($order) ? route('admin.order.update', ['order' => $order->id]) : route('admin.order.store') }}" method="POST" >
        @csrf
        @if(isset($order))
            @method('PUT')
        @endif    <div class="mb-3">
        <label for="clientName" class="form-label">ClientName</label>
        <input type="text"  placeholder="ClientName ..."  name="clientName" value="{{ old('clientName', isset($order) ? $order->clientName : '') }}" class="form-control" id="clientName" aria-describedby="clientNameHelp" required/>

        @error('clientName')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="billing_address" class="form-label">Billing_address</label>
        <input type="text"  placeholder="Billing_address ..."  name="billing_address" value="{{ old('billing_address', isset($order) ? $order->billing_address : '') }}" class="form-control" id="billing_address" aria-describedby="billing_addressHelp" required/>

        @error('billing_address')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="shipping_address" class="form-label">Shipping_address</label>
        <input type="text"  placeholder="Shipping_address ..."  name="shipping_address" value="{{ old('shipping_address', isset($order) ? $order->shipping_address : '') }}" class="form-control" id="shipping_address" aria-describedby="shipping_addressHelp" required/>

        @error('shipping_address')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="text"  placeholder="Quantity ..."  name="quantity" value="{{ old('quantity', isset($order) ? $order->quantity : '') }}" class="form-control" id="quantity" aria-describedby="quantityHelp" required/>

        @error('quantity')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="taxe" class="form-label">Taxe</label>
        <input type="text"  placeholder="Taxe ..."  name="taxe" value="{{ old('taxe', isset($order) ? $order->taxe : '') }}" class="form-control" id="taxe" aria-describedby="taxeHelp" required/>

        @error('taxe')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="order_cost" class="form-label">Order_cost</label>
        <input type="text"  placeholder="Order_cost ..."  name="order_cost" value="{{ old('order_cost', isset($order) ? $order->order_cost : '') }}" class="form-control" id="order_cost" aria-describedby="order_costHelp" required/>

        @error('order_cost')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="order_cost_ttc" class="form-label">Order_cost_ttc</label>
        <input type="text"  placeholder="Order_cost_ttc ..."  name="order_cost_ttc" value="{{ old('order_cost_ttc', isset($order) ? $order->order_cost_ttc : '') }}" class="form-control" id="order_cost_ttc" aria-describedby="order_cost_ttcHelp" required/>

        @error('order_cost_ttc')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3 d-flex gap-2">
        <label for="isPaid" class="form-label">IsPaid</label>
        <div class="form-check form-switch">
            <input name="isPaid" id="isPaid" value="true" data-bs-toggle="toggle"  {{ old('isPaid', isset($order) && $order->isPaid == 'true' ? 'checked' : '') }} class="form-check-input" type="checkbox" role="switch" />
        </div>
        {{-- <select class="form-control" name="isPaid" id="isPaid">
            <option value="true" {{ old('isPaid', isset($order) && $order->isPaid == 'true' ? 'selected' : '') }}>Yes</option>
            <option value="false" {{ old('isPaid', isset($order) && $order->isPaid == 'false' ? 'selected' : '') }}>No</option>
        </select> --}}

        @error('isPaid')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="carrier_name" class="form-label">Carrier_name</label>
        <input type="text"  placeholder="Carrier_name ..."  name="carrier_name" value="{{ old('carrier_name', isset($order) ? $order->carrier_name : '') }}" class="form-control" id="carrier_name" aria-describedby="carrier_nameHelp" required/>

        @error('carrier_name')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="carrier_price" class="form-label">Carrier_price</label>
        <input type="text"  placeholder="Carrier_price ..."  name="carrier_price" value="{{ old('carrier_price', isset($order) ? $order->carrier_price : '') }}" class="form-control" id="carrier_price" aria-describedby="carrier_priceHelp" required/>

        @error('carrier_price')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="paymeny_method" class="form-label">Paymeny_method</label>
        <input type="text"  placeholder="Paymeny_method ..."  name="paymeny_method" value="{{ old('paymeny_method', isset($order) ? $order->paymeny_method : '') }}" class="form-control" id="paymeny_method" aria-describedby="paymeny_methodHelp" required/>

        @error('paymeny_method')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="stripe_payment_intent" class="form-label">Stripe_payment_intent</label>
        <input type="text"  placeholder="Stripe_payment_intent ..."  name="stripe_payment_intent" value="{{ old('stripe_payment_intent', isset($order) ? $order->stripe_payment_intent : '') }}" class="form-control" id="stripe_payment_intent" aria-describedby="stripe_payment_intentHelp" required/>

        @error('stripe_payment_intent')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <a href="{{ route('admin.order.index') }}" class="btn btn-danger mt-1">
        Cancel
    </a>
    <button class="btn btn-primary mt-1"> {{ isset($order) ? 'Update' : 'Create' }}</button>
 </form>
    </div>
    <div class="col-md-4">
    <a  class="btn btn-danger mt-1" href="{{ route('admin.order.index') }}">
    Cancel
</a>
<button class="btn btn-primary mt-1"> {{ isset($order) ? 'Update' : 'Create' }}</button>
    </div>
    </div>

    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

    <script>
        const textareas = document.querySelectorAll('textarea');
        textareas.forEach((textarea) => {
            ClassicEditor
                .create(textarea)
                .catch(error => {
                    console.error(error);
                });
        });

        $(document).ready(function() {
            $('select').select2();
        });
        function triggerFileInput(fieldId) {
            const fileInput = document.getElementById(fieldId);
            if (fileInput) {
                fileInput.click();
            }
        }

        const imageUploads = document.querySelectorAll('.imageUpload');
        imageUploads.forEach(function(imageUpload) {
            imageUpload.addEventListener('change', function(event) {
                event.preventDefault()
                const files = this.files; // Récupérer tous les fichiers sélectionnés
                console.log(files)
                if (files && files.length > 0) {
                    const previewContainer = document.getElementById('preview_' + this.id);
                    previewContainer.innerHTML = ''; // Effacer le contenu précédent

                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        if (file) {
                            const reader = new FileReader();
                            const img = document.createElement('img'); // Créer un élément img pour chaque image

                            reader.onload = function(event) {
                                img.src = event.target.result;
                                img.alt = "Prévisualisation de l'image"
                                img.style.maxWidth = '100px';
                                img.style.display = 'block';
                            }

                            reader.readAsDataURL(file);
                            previewContainer.appendChild(img); // Ajouter l'image à la prévisualisation
                            console.log({img})
                            console.log({previewContainer})
                        }
                    }
                    console.log({previewContainer})
                }
            });
        });
    </script>
    @endsection