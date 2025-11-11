<form id="gift-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method)

    <input type="hidden" name="wish_list_users_id" value="{{ $wishListUser->id }}">
    <input type="hidden" name="added_by" value="{{ Auth::id() }}">

    <div class="mb-5">
        <label for="title" class="block mb-2 font-medium text-gray-900">
            Nom
            <span class="text-red-500">*</span>
        </label>

        <input type="text"
               name="title"
               id="title"
               value="{{ old('title', $gift->title ?? '') }}"
               class="bg-gray-50 border {{ $errors->has('title') ? 'border-red-500':'border-gray-300' }} text-gray-900 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm rounded-lg block w-full p-2.5"
               placeholder="Nom du cadeau"
               required
        />

        @error('title')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-5">
        <label for="link" class="block mb-2 font-medium text-gray-900">
            Lien
        </label>

        <input type="text"
               name="link"
               id="link"
               value="{{ old('link', $gift->link ?? '') }}"
               class="bg-gray-50 border {{ $errors->has('link') ? 'border-red-500':'border-gray-300' }} text-gray-900 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm rounded-lg block w-full p-2.5"
               placeholder="Lien du cadeau"
        />

        @error('link')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-5">
        <label for="image" class="block mb-2 font-medium text-gray-900">
            Image
        </label>

        <input type="file"
               name="image"
               id="image"
               class="bg-gray-50 border {{ $errors->has('image') ? 'border-red-500':'border-gray-300' }} text-gray-900 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm rounded-lg block w-full p-2.5"
               placeholder="Lien du cadeau"
        />

        <span class="text-gray-500 text-sm block">Taille maximale : 5 Mo. Formats acceptés : png, jpg, jpeg.</span>

        @error('image')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-5">
        <label for="description" class="block mb-2 font-medium text-gray-900">
            Description
        </label>
        <textarea name="description"
                  id="description" rows="5"
                  class="bg-gray-50 border {{ $errors->has('description') ? 'border-red-500':'border-gray-300' }} text-gray-900 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm rounded-lg block w-full p-2.5"
                  placeholder="Description du cadeau"
        >{{ old('description', $gift->description ?? '') }}</textarea>

        @error('description')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex gap-2 mb-2">
        <a href="{{ route('gifts.index', $wishListUser) }}" class="w-full text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Annuler
        </a>
        <button type="submit" id="form-gift-button" class="w-full text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-5 py-2.5">
            <span class="indicator-label">
                {{ $buttonText }}
            </span>
            <span class="hidden flex justify-center items-center indicator-progress">
                Veuillez patienter... <x-lucide-loader-circle class="w-6 h-6 ms-2 animate-spin" />
            </span>
        </button>
    </div>
</form>

<script>
    const giftForm = document.querySelector('#gift-form')
    const formGiftButton = document.querySelector('#form-gift-button')

    giftForm.addEventListener('submit', function(e) {
        e.preventDefault()

        // Bouton anti spam
        activateButtonIndicator(formGiftButton)

        giftForm.submit()
    });
</script>
