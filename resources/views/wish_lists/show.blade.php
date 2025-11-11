@extends('layouts.base')

@section('title', 'Détail d\'une liste')

@section('content')
    @include('wish_lists.partials.header')

    <x-breadcrumb :links="[
        'Mes listes' => route('wish_lists.index'),
        $wishList->title => ''
    ]" />

    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ($wishList->users as $user)
            <a href="{{ route('gifts.index', $user->pivot->id) }}"
               class="bg-white rounded-xl p-6 border">
                <div class="flex items-center gap-x-2">
                    <x-lucide-circle-user-round class="w-10 h-10 text-red-500"/>
                    <span class="text-xl font-bold">{{ $user->name }}</span>
                    @if($user->pivot->isWishListOwner())
                        <x-lucide-crown class="w-4 h-4 text-yellow-500"/>
                    @endif
                </div>
            </a>
        @endforeach
    </div>
@endsection
