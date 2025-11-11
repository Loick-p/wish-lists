@extends('layouts.base')

@section('title', 'Utilisateurs de la liste')

@section('content')
    @include('wish_lists.partials.header')

    <x-breadcrumb :links="[
        'Mes listes' => route('wish_lists.index'),
        $wishList->title => route('wish_lists.show', $wishList),
        'Gestion des utilisateurs' => ''
    ]" />

    <div class="lg:w-1/2 mx-auto p-2">
        <h1 class="font-bold text-xl mb-4">Gestion des utilisateurs</h1>

        <div class="mb-6">
            <h2 class="font-semibold mb-2">Ajouter un utilisateur</h2>
            <form id="add-user-form" action="{{ route('wish_lists.add_user', $wishList) }}" method="POST">
                @csrf
                <div class="md:flex gap-2">
                    <input type="text"
                           name="email"
                           id="email"
                           value="{{ old('email') }}"
                           class="bg-gray-50 border {{ $errors->has('email') ? 'border-red-500':'border-gray-300' }} text-gray-900 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm rounded-lg block w-full p-2.5 mb-2 md:mb-0"
                           placeholder="Adresse mail de l'utilisateur"
                           required
                    />

                    <button type="submit" id="add-user-button" class="w-full md:w-min text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-5 py-2.5">
                        <span class="indicator-label">
                            Ajouter
                        </span>
                        <span class="hidden flex justify-center items-center indicator-progress">
                            Veuillez patienter... <x-lucide-loader-circle class="w-6 h-6 ms-2 animate-spin" />
                        </span>
                    </button>
                </div>

                @foreach (['email', 'userAlreadyMember'] as $error)
                    @error($error)
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                @endforeach
            </form>
        </div>

        <h2 class="font-semibold mb-2">Liste des utilisateurs</h2>

        @foreach ($wishList->users as $user)
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center justify-center size-[46px] text-sm font-semibold leading-none rounded-full bg-gray-100 text-gray-800">
                        {{ Str::limit($user->name, 2, '') }}
                    </span>
                    <div class="flex flex-col">
                        <h3 class="font-medium">
                            {{ $user->name }}
                            <span class="text-xs font-light">{{ $user->pivot->isWishListOwner() ? '(Administrateur)':'' }}</span>
                        </h3>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    </div>
                </div>

                @if(!$user->is(Auth::user()))
                    <button type="button"
                            id="open-delete-user-modal"
                            data-hs-overlay="#delete-user-modal"
                            data-user-id="{{ $user->pivot->id }}"
                            class="text-red-500 hover:text-red-700"
                    >
                        <x-lucide-trash-2 class="w-5 h-5"/>
                    </button>
                @endif
            </div>
        @endforeach
    </div>

    @include('wish_lists.partials.delete_user_modal')

    <script>
        const addUserForm = document.querySelector('#add-user-form')
        const addUserButton = document.querySelector('#add-user-button')

        addUserForm.addEventListener('submit', function(e) {
            e.preventDefault()

            // Bouton anti spam
            activateButtonIndicator(addUserButton)

            addUserForm.submit()
        });

        // Suppression d'un utilisateur
        const deleteUserButton = document.getElementById('delete-user-button');
        document.querySelectorAll('#open-delete-user-modal').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id')
                const deleteUrl = "{{ route('wish_lists.delete_user', ':user_id') }}".replace(':user_id', userId)
                document.getElementById('delete-user-form').setAttribute('action', deleteUrl);
            });
        });
    </script>
@endsection
