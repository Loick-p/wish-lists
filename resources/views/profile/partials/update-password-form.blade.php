<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Mot de passe
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Modifier le mot de passe de votre compte.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" id="profile-password-form" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block font-medium text-sm text-gray-700">
                Mot de passe actuel
            </label>
            <input type="password"
                   name="current_password"
                   id="update_password_current_password"
                   class="my-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm"
                   required
                   autocomplete="current-password">

            @error('current_password', 'updatePassword')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block font-medium text-sm text-gray-700">
                Nouveau mot de passe
            </label>
            <input type="password"
                   name="password"
                   id="update_password_password"
                   class="my-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm"
                   required
                   autocomplete="new-password">

            @error('password', 'updatePassword')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block font-medium text-sm text-gray-700">
                Confirmer le nouveau mot de passe
            </label>
            <input type="password"
                   name="password_confirmation"
                   id="update_password_password_confirmation"
                   class="my-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm"
                   required
                   autocomplete="new-password">

            @error('password_confirmation', 'updatePassword')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                    id="profile-password-button"
                    class="text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-5 py-2.5">
                <span class="indicator-label">
                  Enregistrer
                </span>
                <span class="hidden flex justify-center items-center indicator-progress">
                    Veuillez patienter... <x-lucide-loader-circle class="w-6 h-6 ms-2 animate-spin" />
                </span>
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >Mot de passe modifié</p>
            @endif
        </div>
    </form>
</section>

<script>
    const profilePasswordForm = document.querySelector('#profile-password-form')
    const profilePasswordButton = document.querySelector('#profile-password-button')

    profilePasswordForm.addEventListener('submit', function(e) {
        e.preventDefault()

        // Bouton anti spam
        activateButtonIndicator(profilePasswordButton)

        profilePasswordForm.submit()
    });
</script>
