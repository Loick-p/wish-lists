<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Informations du compte
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Modifier les informations de votre compte.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" id="profile-information-form" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block font-medium text-sm text-gray-700">Pseudo</label>
            <input type="text"
                   name="name"
                   id="name"
                   class="my-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm"
                   value="{{ old('name', $user->name) }}"
                   required
                   autofocus
                   autocomplete="name">

            @error('name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="email" class="block font-medium text-sm text-gray-700">Adresse mail</label>
            <input type="email"
                   name="email"
                   id="email"
                   class="my-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm"
                   value="{{ old('email', $user->email) }}"
                   required
                   autocomplete="username">

            @error('email')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                    id="profile-information-button"
                    class="text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-5 py-2.5">
                <span class="indicator-label">
                  Enregistrer
                </span>
                    <span class="hidden flex justify-center items-center indicator-progress">
                    Veuillez patienter... <x-lucide-loader-circle class="w-6 h-6 ms-2 animate-spin" />
                </span>
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-500"
                >Informations du profil enregistrées</p>
            @endif
        </div>
    </form>
</section>

<script>
    const profileInformationForm = document.querySelector('#profile-information-form')
    const profileInformationButton = document.querySelector('#profile-information-button')

    profileInformationForm.addEventListener('submit', function(e) {
        e.preventDefault()

        // Bouton anti spam
        activateButtonIndicator(profileInformationButton)

        profileInformationForm.submit()
    });
</script>
