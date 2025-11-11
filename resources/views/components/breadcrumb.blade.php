<ol class="flex items-center whitespace-nowrap py-4">
    @foreach ($links as $label => $url)
        @if($loop->last)
            <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate">
                {{ $label }}
            </li>
        @else
            <li class="inline-flex items-center">
                <a class="flex items-center text-sm text-gray-500 hover:text-red-500 focus:outline-none focus:text-red-500" href="{{ $url }}">
                    {{ $label }}
                </a>
                <svg class="shrink-0 size-5 text-red-500 mx-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 13L10 3" stroke="currentColor" stroke-linecap="round"></path>
                </svg>
            </li>
        @endif
    @endforeach
</ol>
