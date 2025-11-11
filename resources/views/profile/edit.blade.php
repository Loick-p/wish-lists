@extends('layouts.base')

@section('title', 'Mon compte')

@section('content')
    <h1 class="font-bold text-xl">Mon compte</h1>

    <div class="py-6">
        <div class="mx-auto space-y-6">
            <div class="p-8 bg-white shadow rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-8 bg-white shadow rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
@endsection
