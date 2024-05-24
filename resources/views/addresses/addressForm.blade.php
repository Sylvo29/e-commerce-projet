    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection
    <div class="row">
        <div class="col-md-8">
            <form
                action="{{ isset($address) ? route('admin.address.update', ['address' => $address->id]) : route('admin.address.store') }}"
                method="POST">
                @csrf
                @if (isset($address))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" placeholder="Name ..." name="name"
                        value="{{ old('name', isset($address) ? $address->name : '') }}" class="form-control"
                        id="name" aria-describedby="nameHelp" required />

                    @error('name')
                        <div class="error text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="clientName" class="form-label">ClientName</label>
                    <input type="text" placeholder="ClientName ..." name="clientName"
                        value="{{ old('clientName', isset($address) ? $address->clientName : '') }}"
                        class="form-control" id="clientName" aria-describedby="clientNameHelp" required />

                    @error('clientName')
                        <div class="error text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="street" class="form-label">Street</label>
                    <input type="text" placeholder="Street ..." name="street"
                        value="{{ old('street', isset($address) ? $address->street : '') }}" class="form-control"
                        id="street" aria-describedby="streetHelp" required />

                    @error('street')
                        <div class="error text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="codePostal" class="form-label">CodePostal</label>
                    <input type="text" placeholder="CodePostal ..." name="codePostal"
                        value="{{ old('codePostal', isset($address) ? $address->codePostal : '') }}"
                        class="form-control" id="codePostal" aria-describedby="codePostalHelp" required />

                    @error('codePostal')
                        <div class="error text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" placeholder="City ..." name="city"
                        value="{{ old('city', isset($address) ? $address->city : '') }}" class="form-control"
                        id="city" aria-describedby="cityHelp" required />

                    @error('city')
                        <div class="error text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="state" class="form-label">State</label>
                    <input type="text" placeholder="State ..." name="state"
                        value="{{ old('state', isset($address) ? $address->state : '') }}" class="form-control"
                        id="state" aria-describedby="stateHelp" required />

                    @error('state')
                        <div class="error text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="moreDetails" class="form-label">More Details</label>
                    <textarea name="moreDetails" class="form-control">{{ old('moreDetails', isset($address) ? $address->moreDetails : '') }}</textarea>
                    @error('moreDetails')
                        <div class="error text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="addressType" class="form-label">AddressType</label>
                    <select name="addressType" id="addressType" class="form-control">
                        <option value="null">Please, select Address Type </option>
                        <option value="BILLING" @if ("BILLING" == old('addressType', isset($address) ? $address->addressType : ''))
                            selected
                        @endif>BILLING </option>
                        <option value="SHIPPING" @if ("SHIPPING" ==  old('addressType', isset($address) ? $address->addressType : ''))
                            selected
                        @endif>SHIPPING </option>
                    </select>

                    @error('addressType')
                        <div class="error text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="user_id" class="form-label">Author</label>
                    <select class="form-control" name="user_id" id="user_id">
                        <option value="null">Please, select author</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @if ($user->id == old('user', isset($address) ? $address?->user_id : '')) selected @endif>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>


                    @error('user_id')
                        <div class="error text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <a href="{{ route('admin.address.index') }}" class="btn btn-danger mt-1">
                    Cancel
                </a>
                <button class="btn btn-primary mt-1"> {{ isset($address) ? 'Update' : 'Create' }}</button>
            </form>
        </div>
        <div class="col-md-4">
            <a class="btn btn-danger mt-1" href="{{ route('admin.address.index') }}">
                Cancel
            </a>
            <button class="btn btn-primary mt-1"> {{ isset($address) ? 'Update' : 'Create' }}</button>
        </div>
    </div>

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
