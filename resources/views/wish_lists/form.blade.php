<form id="wish-list-form" action="{{ $action }}" method="POST">
    @csrf
    @method($method)

    <div class="mb-5">
        <label for="title" class="block mb-2 font-medium text-gray-900">
            Titre
            <span class="text-red-500">*</span>
        </label>
        <input type="text"
               name="title"
               id="title"
               value="{{ old('title', $wishList->title ?? '') }}"
               class="bg-gray-50 border {{ $errors->has('title') ? 'border-red-500':'border-gray-300' }} text-gray-900 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm rounded-lg block w-full p-2.5"
               placeholder="Titre de votre liste"
               required
        />

        @error('title')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-5">
        <label for="description" class="block mb-2 font-medium text-gray-900">
            Description
            <span class="text-red-500">*</span>
        </label>
        <textarea name="description"
                  id="description" rows="5"
                  class="bg-gray-50 border {{ $errors->has('description') ? 'border-red-500':'border-gray-300' }} text-gray-900 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm rounded-lg block w-full p-2.5"
                  placeholder="Description de votre liste"
                  required
        >{{ old('description', $wishList->description ?? '') }}</textarea>

        @error('description')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-5">
        <label for="date" class="block mb-2 font-medium text-gray-900">
            Date
            <span class="text-red-500">*</span>
        </label>
        <div class="flex gap-x-6">
            <div class="flex">
                <input
                    type="radio"
                    name="date"
                    class="mt-1 border-gray-300 rounded-full text-red-500 focus:ring-red-500"
                    id="christmas_eve"
                    value="{{ date('Y') . '-12-24' }}"
                    {{ old('date', $wishList->date ?? date('Y') . '-12-24') === date('Y') . '-12-24' ? 'checked' : '' }}
                >
                <label for="date" class="text-gray-600 ms-2">Réveillon de Noël</label>
            </div>

            <div class="flex">
                <input
                    type="radio"
                    name="date"
                    class="mt-1 border-gray-300 rounded-full text-red-500 focus:ring-red-500"
                    id="christmas_day"
                    value="{{ date('Y') . '-12-25' }}"
                    {{ old('date', $wishList->date ?? date('Y') . '-12-24') === date('Y') . '-12-25' ? 'checked' : '' }}
                >
                <label for="date" class="text-gray-600 ms-2">Noël</label>
            </div>
        </div>
        @error('date')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex gap-2 mb-2">
        <a href="{{ $cancelRoute }}" class="w-full text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Annuler
        </a>
        <button type="submit" id="form-wish-list-button" class="w-full text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-5 py-2.5">
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
    const wishListForm = document.querySelector('#wish-list-form')
    const formWishListButton = document.querySelector('#form-wish-list-button')

    wishListForm.addEventListener('submit', function(e) {
        e.preventDefault()

        // Bouton anti spam
        activateButtonIndicator(formWishListButton)

        wishListForm.submit()
    });
</script>
