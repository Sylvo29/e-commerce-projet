    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection

    <form
        class="row"
        action="{{ isset($address) ? route('dashboard.address.update', ['address' => $address->id]) : route('dashboard.address.store') }}"
        method="POST">
        @csrf
        @if (isset($address))
            @method('PUT')
        @endif
        <div class="mb-3  col-md-6">
            <label for="name" class="form-label">{{ __('messages.name') }}</label>
            <input type="text" placeholder="Name ..." name="name"
                value="{{ old('name', isset($address) ? $address->name : '') }}" class="form-control" id="name"
                aria-describedby="nameHelp" required />

            @error('name')
                <div class="error text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3  col-md-6">
            <label for="clientName" class="form-label">{{ __('messages.clientName') }}</label>
            <input type="text" placeholder="ClientName ..." name="clientName"
                value="{{ old('clientName', isset($address) ? $address->clientName : '') }}" class="form-control"
                id="clientName" aria-describedby="clientNameHelp" required />

            @error('clientName')
                <div class="error text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <label for="street" class="form-label">{{ __('messages.street') }}</label>
            <input type="text" placeholder="Street ..." name="street"
                value="{{ old('street', isset($address) ? $address->street : '') }}" class="form-control" id="street"
                aria-describedby="streetHelp" required />

            @error('street')
                <div class="error text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <label for="codePostal" class="form-label">{{ __('messages.codePostal') }}</label>
            <input type="text" placeholder="CodePostal ..." name="codePostal"
                value="{{ old('codePostal', isset($address) ? $address->codePostal : '') }}" class="form-control"
                id="codePostal" aria-describedby="codePostalHelp" required />

            @error('codePostal')
                <div class="error text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3  col-md-4">
            <label for="city" class="form-label">{{ __('messages.city') }}</label>
            <input type="text" placeholder="City ..." name="city"
                value="{{ old('city', isset($address) ? $address->city : '') }}" class="form-control" id="city"
                aria-describedby="cityHelp" required />

            @error('city')
                <div class="error text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="state" class="form-label">{{ __('messages.state') }}</label>
            <input type="text" placeholder="State ..." name="state"
                value="{{ old('state', isset($address) ? $address->state : '') }}" class="form-control" id="state"
                aria-describedby="stateHelp" required />

            @error('state')
                <div class="error text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="moreDetails" class="form-label">{{ __('messages.moreDetails') }}</label>
            <textarea name="moreDetails" class="form-control">{{ old('moreDetails', isset($address) ? $address->moreDetails : '') }}</textarea>
            @error('moreDetails')
                <div class="error text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="addressType" class="form-label">{{ __('messages.addressType') }}</label>
            <select name="addressType" id="addressType" class="form-control">
                <option value="null">{{ __('messages.selectAdrressType') }}  </option>
                <option value="BILLING" @if ('BILLING' == old('addressType', isset($address) ? $address->addressType : '')) selected @endif>{{ __('messages.billing') }} </option>
                <option value="SHIPPING" @if ('SHIPPING' == old('addressType', isset($address) ? $address->addressType : '')) selected @endif>{{ __('messages.shipping') }} </option>
            </select>

            @error('addressType')
                <div class="error text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <div class="d-flex">
            <a href="{{ route('dashboard.address') }}" class="btn btn-danger mt-1">
                {{ __('messages.cancel') }}
            </a>
            <button class="btn btn-primary mt-1"> {{ isset($address) ? 'Update' : 'Create' }}</button>

        </div>
    </form>


    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>
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
                                const img = document.createElement(
                                    'img'); // Créer un élément img pour chaque image

                                reader.onload = function(event) {
                                    img.src = event.target.result;
                                    img.alt = "Prévisualisation de l'image"
                                    img.style.maxWidth = '100px';
                                    img.style.display = 'block';
                                }

                                reader.readAsDataURL(file);
                                previewContainer.appendChild(img); // Ajouter l'image à la prévisualisation
                                console.log({
                                    img
                                })
                                console.log({
                                    previewContainer
                                })
                            }
                        }
                        console.log({
                            previewContainer
                        })
                    }
                });
            });
        </script>
    @endsection
