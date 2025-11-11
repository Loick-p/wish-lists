<div class="bg-white p-2 rounded-xl shadow-xl mb-4">
    <div class="p-2">
        <div class="mb-2">
            <div class="flex items-center gap-2">
                <h2 class="text-lg font-bold">{{ $wishList->title }}</h2>
                @can('owner', $wishList)
                    <a href="{{ route('wish_lists.edit', $wishList) }}" class="text-red-500 hover:text-red-600">
                        <x-lucide-pencil class="w-4 h-4"/>
                    </a>
                @endcan
            </div>
            <p class="text-gray-500">{{ $wishList->description }}</p>
        </div>

        <div class="flex gap-4 mb-2">
            <div class="flex flex-col font-light">
                <span class="text-gray-500">Date</span>
                <div class="flex items-center bg-gray-200 p-1 rounded text-sm">
                    <x-lucide-calendar-days class="w-4 h-4"/>
                    <p class="ms-1">{{ date('d/m/Y', strtotime($wishList->date)) }}</p>
                </div>
            </div>

            <div class="flex flex-col font-light">
                <span class="text-gray-500">Utilisateurs</span>
                <div class="flex gap-2">
                    <div class="flex -space-x-2">
                        @foreach ($wishList->users->take(3) as $user)
                            <span class="inline-flex items-center justify-center size-8 text-xs font-semibold rounded-full leading-none border border-gray-200 bg-white text-gray-800 shadow-sm">
                              {{ Str::limit($user->name, 2, '') }}
                            </span>
                        @endforeach

                        @if(count($wishList->users) > 3)
                            <span class="inline-flex items-center justify-center size-8 rounded-full bg-gray-200 text-xs font-semibold leading-none">
                              +{{ count($wishList->users) - 3 }}
                            </span>
                        @endif
                    </div>

                    @can('owner', $wishList)
                        <div class="hs-tooltip inline-block">
                            <a href="{{ route('wish_lists.users', $wishList) }}" class="hs-tooltip-toggle inline-flex items-center justify-center size-8 rounded-full bg-gray-200 hover:bg-red-500 hover:text-white text-xs font-semibold leading-none">
                                <x-lucide-plus class="w-4 h-4"/>
                                <div class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-lg shadow-sm" role="tooltip">
                                    Ajouter ou gérer les utilisateurs
                                </div>
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>

    </div>
</div>
