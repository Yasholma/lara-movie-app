<div class="relative mt-3 md:0" x-data="{isOpen: true}" @click.away="isOpen = false">
    <input x-ref="search" @keydown.window="
        if (event.keyCode === 191) {
            event.preventDefault()
            $refs.search.focus();
        }
    " type="text mt-3 md:0" wire:model.debounce.500ms='search' @focus="isOpen = true"
        @keydown.shift.tab="isOpen = false" @keydown="isOpen = true"
        class="bg-gray-800 rounded-full border text-sm pl-6 border-gray-600 w-64 px-4 py-1 focus:outline-none focus:shadow-outline focus:border-gray-900"
        placeholder="Search">
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24">
            <path class="heroicon-ui"
                d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z" />
        </svg>
    </div>
    <div wire:loading class="spinner top-0 right-0 mr-4 mt-4"></div>
    @if (strlen($search) >= 2)
    <div class="absolute text-sm bg-gray-800 rounded w-64 mt-4 z-50" x-show.transition.opacity="isOpen"
        @keydown.escape.window="isOpen = false">
        <ul>
            @forelse ($searchResults as $result)
            <li class="border-b border-gray-700">
                <a href="{{ route('movies.show', $result['id']) }}"
                    class="hover:bg-gray-700 px-3 py-3 flex items-center" @if ($loop->last)
                    @keydown.tab.exact="isOpen = false"
                    @endif
                    >
                    @if ($result['poster_path'])
                    <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster" class="w-8">
                    @else
                    <img src="https://via.placeholder.com/58x75" alt="poster" class="w-8">
                    @endif
                    <span class="ml-4">{{ $result['title'] }}</span>
                </a>
            </li>
            @empty
            <div class="px-3 py-3">No results for {{ $search }} </div>
            @endforelse
        </ul>
    </div>
    @endif
</div>
