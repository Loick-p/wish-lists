@extends('layouts.base')

@section('title', 'Modifier un cadeau')

@section('content')
    <x-breadcrumb :links="[
        'Mes listes' => route('wish_lists.index'),
        $wishListUser->wishList->title => route('wish_lists.show', $wishListUser->wishList),
        'Cadeaux pour ' . $wishListUser->user->name => route('gifts.index', $wishListUser),
        'Modifier un cadeau' => ''
    ]" />

    <div class="bg-white p-4 rounded-xl shadow xl:w-1/2 mx-auto">
        <h1 class="font-bold text-2xl mb-4 text-center">Modifier un cadeau</h1>

        @include('gifts/form', [
            'action' => route('gifts.update', $gift),
            'method' => 'PATCH',
            'gift' => $gift,
            'buttonText' => 'Modifier'
        ])
    </div>
@endsection
