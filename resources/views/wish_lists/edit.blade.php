@extends('layouts.base')

@section('title', 'Modifier la liste')

@section('content')
    <x-breadcrumb :links="[
        'Mes listes' => route('wish_lists.index'),
        $wishList->title => route('wish_lists.show', $wishList),
        'Modifier la liste' => ''
    ]" />

    <div class="bg-white p-4 rounded-xl shadow xl:w-1/2 mx-auto">
        <h1 class="font-bold text-2xl mb-4 text-center">Modifier la liste</h1>

        @include('wish_lists/form', [
            'action' => route('wish_lists.update', $wishList),
            'method' => 'PATCH',
            'wishList' => $wishList,
            'buttonText' => 'Modifier',
            'cancelRoute' => route('wish_lists.show', $wishList),
        ])
    </div>
@endsection
