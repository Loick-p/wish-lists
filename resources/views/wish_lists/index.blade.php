@extends('layouts.base')

@section('title', 'Mes listes')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">
            Bonjour {{ Auth::user()->name }}
            <span class="text-2xl">&#128075;</span>
        </h1>

        <a href="{{ route('wish_lists.create') }}" class="text-red-500 hover:text-red-600">
            <x-lucide-circle-plus class="w-8 h-8" />
        </a>
    </div>

    <div class="bg-gray-100 hover:bg-gray-200 rounded-lg transition p-1">
        <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
            <button
                type="button"
                class="hs-tab-active:bg-white hs-tab-active:text-gray-700 py-3 px-4 text-center flex-auto inline-flex justify-center items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-hidden focus:text-gray-700 font-medium rounded-lg hover:hover:text-red-600 disabled:opacity-50 disabled:pointer-events-none active"
                id="wish-lists-item-1"
                aria-selected="true"
                data-hs-tab="#wish-lists-1"
                aria-controls="wish-lists-1"
                role="tab"
            >
                En cours
            </button>
            <button
                type="button"
                class="hs-tab-active:bg-white hs-tab-active:text-gray-700 py-3 px-4 text-center flex-auto inline-flex justify-center items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-hidden focus:text-gray-700 font-medium rounded-lg hover:hover:text-red-600 disabled:opacity-50 disabled:pointer-events-none"
                id="wish-lists-item-2"
                aria-selected="false"
                data-hs-tab="#wish-lists-2"
                aria-controls="wish-lists-2"
                role="tab"
            >
                Terminée
            </button>
        </nav>
    </div>

    <div class="mt-3">
        <div id="wish-lists-1" role="tabpanel" aria-labelledby="wish-lists-item-1">
            @php
                $activeWishLists = $wishLists->filter(fn($wishList) => $wishList->active);
            @endphp

            @if($activeWishLists->isEmpty())
                <p class="text-center my-2 italic text-gray-700">Vous n'avez aucune liste en cours.</p>
            @else
                @include('wish_lists.partials.wish_lists_grid', ['wishLists' => $activeWishLists])
            @endif
        </div>
        <div id="wish-lists-2" class="hidden" role="tabpanel" aria-labelledby="wish-lists-item-2">
            @php
                $inactiveWishLists = $wishLists->filter(fn($wishList) => !$wishList->active);
            @endphp

            @if($inactiveWishLists->isEmpty())
                <p class="text-center my-2 italic text-gray-700">Vous n'avez aucune liste terminée.</p>
            @else
                @include('wish_lists.partials.wish_lists_grid', ['wishLists' => $inactiveWishLists])
            @endif
        </div>
    </div>
@endsection
