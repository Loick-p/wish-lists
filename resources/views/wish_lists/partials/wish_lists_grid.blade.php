<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 py-4">
    @foreach ($wishLists as $wishList)
        <a href="{{ route('wish_lists.show', $wishList->id) }}" class="relative w-full max-w-sm mx-auto">
            <img src="{{ asset('images/background/christmas-background.jpg') }}" alt="Background" class="w-full h-80 object-cover rounded-xl shadow-xl">

            <div class="absolute top-0 right-0 bg-white rounded-full m-2 shadow-xl flex p-2">
                <x-lucide-users class="w-5 h-5"/>
                <span class="ms-1 font-bold">{{ count($wishList->users) }}</span>
            </div>

            <div class="absolute bottom-0 left-0 right-0 bg-white p-4 rounded-xl m-2 shadow-xl">
                <h2 class="text-lg font-bold">{{ $wishList->title }}</h2>
                <div class="flex items-center font-light text-gray-500">
                    <x-lucide-calendar-days class="w-5 h-5"/>
                    <p class="ms-1">{{ date('d/m/Y', strtotime($wishList->date)) }}</p>
                </div>
                <p class="text-gray-600 my-1">{{ $wishList->description }}</p>
            </div>
        </a>
    @endforeach
</div>