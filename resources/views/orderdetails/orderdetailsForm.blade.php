    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection
    <div class="row">
    <div class="col-md-8">
        <form action="{{ isset($orderdetails) ? route('admin.orderdetails.update', ['orderdetails' => $orderdetails->id]) : route('admin.orderdetails.store') }}" method="POST" >
        @csrf
        @if(isset($orderdetails))
            @method('PUT')
        @endif    <div class="mb-3">
        <label for="product_name" class="form-label">Product_name</label>
        <input type="text"  placeholder="Product_name ..."  name="product_name" value="{{ old('product_name', isset($orderdetails) ? $orderdetails->product_name : '') }}" class="form-control" id="product_name" aria-describedby="product_nameHelp" required/>

        @error('product_name')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="product_description" class="form-label">Product_description</label>
        <input type="text"  placeholder="Product_description ..."  name="product_description" value="{{ old('product_description', isset($orderdetails) ? $orderdetails->product_description : '') }}" class="form-control" id="product_description" aria-describedby="product_descriptionHelp" required/>

        @error('product_description')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="soldePrice" class="form-label">SoldePrice</label>
        <input type="text"  placeholder="SoldePrice ..."  name="soldePrice" value="{{ old('soldePrice', isset($orderdetails) ? $orderdetails->soldePrice : '') }}" class="form-control" id="soldePrice" aria-describedby="soldePriceHelp" required/>

        @error('soldePrice')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="regularPrice" class="form-label">RegularPrice</label>
        <input type="text"  placeholder="RegularPrice ..."  name="regularPrice" value="{{ old('regularPrice', isset($orderdetails) ? $orderdetails->regularPrice : '') }}" class="form-control" id="regularPrice" aria-describedby="regularPriceHelp" required/>

        @error('regularPrice')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="text"  placeholder="Quantity ..."  name="quantity" value="{{ old('quantity', isset($orderdetails) ? $orderdetails->quantity : '') }}" class="form-control" id="quantity" aria-describedby="quantityHelp" required/>

        @error('quantity')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="taxe" class="form-label">Taxe</label>
        <input type="text"  placeholder="Taxe ..."  name="taxe" value="{{ old('taxe', isset($orderdetails) ? $orderdetails->taxe : '') }}" class="form-control" id="taxe" aria-describedby="taxeHelp" required/>

        @error('taxe')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="sub_total_ht" class="form-label">Sub_total_ht</label>
        <input type="text"  placeholder="Sub_total_ht ..."  name="sub_total_ht" value="{{ old('sub_total_ht', isset($orderdetails) ? $orderdetails->sub_total_ht : '') }}" class="form-control" id="sub_total_ht" aria-describedby="sub_total_htHelp" required/>

        @error('sub_total_ht')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="sub_total_ttc" class="form-label">Sub_total_ttc</label>
        <input type="text"  placeholder="Sub_total_ttc ..."  name="sub_total_ttc" value="{{ old('sub_total_ttc', isset($orderdetails) ? $orderdetails->sub_total_ttc : '') }}" class="form-control" id="sub_total_ttc" aria-describedby="sub_total_ttcHelp" required/>

        @error('sub_total_ttc')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <a href="{{ route('admin.orderdetails.index') }}" class="btn btn-danger mt-1">
        Cancel
    </a>
    <button class="btn btn-primary mt-1"> {{ isset($orderdetails) ? 'Update' : 'Create' }}</button>
 </form>
    </div>
    <div class="col-md-4">
    <a  class="btn btn-danger mt-1" href="{{ route('admin.orderdetails.index') }}">
    Cancel
</a>
<button class="btn btn-primary mt-1"> {{ isset($orderdetails) ? 'Update' : 'Create' }}</button>
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