@extends('layouts.base')

@section('title', 'Liste de cadeaux pour ' . $wishListUser->user->name)

@section('content')
    @include('wish_lists.partials.header')

    <x-breadcrumb :links="[
        'Mes listes' => route('wish_lists.index'),
        $wishListUser->wishList->title => route('wish_lists.show', $wishListUser->wishList),
        'Cadeaux pour ' . $wishListUser->user->name => ''
    ]" />

    <div class="flex justify-between items-center mb-4">
        <h1 class="font-bold text-xl">Cadeaux pour {{ $wishListUser->user->name }}</h1>
        <a href="{{ route('gifts.create', $wishListUser) }}"
           class="flex items-center justify-center bg-red-500 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-lg">
            <x-lucide-plus class="w-4 h-4 me-2"/>
            Ajouter
        </a>
    </div>

    @if($gifts->isEmpty())
        <p class="text-center my-2 italic text-gray-700">
            Il n'y pas encore de cadeau, ajoutez-en un !
        </p>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($gifts as $gift)
                <div class="flex flex-col bg-white border border-gray-300 shadow-sm rounded-xl p-2">
                    <div class="relative">
                        <img src="{{ $gift->image ? asset('storage/gifts/' . $gift->image) : asset('images/default_gift_image.png') }}"
                             alt="{{ $gift->title }}"
                             class="w-full h-64 object-cover rounded-xl"
                        >

                        @can('manage', $gift)
                            <div class="absolute top-2 right-2 z-10">
                                <div class="hs-dropdown relative inline-flex">
                                    <button id="hs-dropdown-with-title" type="button" class="hs-dropdown-toggle p-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                                        <x-lucide-ellipsis-vertical class="w-4 h-4"/>
                                    </button>

                                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 divide-y divide-gray-200" role="menu">
                                        <div class="p-1 space-y-0.5">
                                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100" href="{{ route('gifts.edit', $gift) }}">
                                                <x-lucide-pencil class="w-4 h-4 shrink-0"/>
                                                Modifier
                                            </a>
                                            <button
                                                type="button"
                                                id="open-delete-gift-modal"
                                                data-hs-overlay="#delete-gift-modal"
                                                class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-red-800 hover:bg-red-100 focus:outline-none focus:bg-red-100"
                                                data-gift-id="{{ $gift->id }}"
                                            >
                                                <x-lucide-trash-2 class="w-4 h-4 shrink-0"/>
                                                Supprimer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>

                    <div class="flex flex-col flex-grow justify-between p-2">
                        <div>
                            <h1 class="font-bold text-lg">
                                {{ $gift->title }}
                            </h1>
                            @if($gift->description)
                                <div class="text-gray-600 mb-2">
                                    {{ $gift->description }}
                                </div>
                            @endif

                            @if($gift->addedByUser->isNot($wishListUser->user))
                                <p class="my-2 text-xs text-gray-500">
                                    Ajouté par {{ $gift->addedByUser->name }}
                                </p>
                            @endif

                            @if($gift->reservedByUser and $wishListUser->user->isNot(Auth::user()))
                                <span class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded">
                                    Réservé par {{ $gift->reservedByUser->name }}
                                </span>
                            @endif
                        </div>

                        <div class="flex flex-col xl:flex-row items-center justify-end gap-2 mt-4">
                            @can('reservation', $gift)
                                <form class="w-full" id="reservation-form" action="{{ route('gifts.reservation', $gift) }}" method="POST">
                                    @csrf
                                    <button
                                        type="submit"
                                        id="reservation-button"
                                        class="w-full text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                    >
                                        <span class="indicator-label">
                                            {{ $gift->reservedByUser === null ? 'Réserver' : 'Annuler réservation' }}
                                        </span>
                                        <span class="hidden flex justify-center items-center indicator-progress">
                                            Veuillez patienter... <x-lucide-loader-circle class="w-6 h-6 ms-2 animate-spin" />
                                        </span>
                                    </button>
                                </form>
                            @endcan

                            @if($gift->link)
                                <a href="{{ $gift->link }}"
                                   target="_blank"
                                   class="w-full text-center text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-5 py-2.5">
                                    Voir l'article
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @include('gifts.partials.delete_modal')

    <script>
        // Suppression d'un cadeau
        const deleteGiftButton = document.getElementById('delete-gift-button');
        document.querySelectorAll('#open-delete-gift-modal').forEach(button => {
            button.addEventListener('click', function() {
                const giftId = this.getAttribute('data-gift-id')
                const deleteUrl = "{{ route('gifts.destroy', ':id') }}".replace(':id', giftId)
                document.getElementById('delete-gift-form').setAttribute('action', deleteUrl);
            });
        });

        // Réservation d'un cadeau
        document.querySelectorAll('#reservation-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault()

                // Bouton anti spam
                activateButtonIndicator(form.querySelector('[type="submit"]'))

                form.submit()
            });
        });
    </script>
@endsection
