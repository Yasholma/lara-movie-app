@extends('layouts.main')

@section('content')
<div class="container px-4 mx-auto py-16">
    <div class="popular-actors">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Actors</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @forelse ($popularActors as $actor)
            <div class="actor mt-8">
                <a href="{{ route('actors.show', $actor['id']) }}">
                    <img src="{{  $actor['profile_path'] }}" alt="actor"
                        class="hover:opacity-75 transition ease-in-out duration-300">
                </a>
                <div class="mt-2">
                    <a href="" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                    <div class="text-gray-400 text-sm truncate" title="{{ $actor['known_for'] }}">
                        {{ $actor['known_for'] }}
                    </div>
                </div>
            </div>
            @empty
            <p>No Actors</p>
            @endforelse
        </div>
    </div>
    {{-- <div class="flex justify-between border-t border-gray-700 mt-4 pt-4">
        @if ($previous)
        <a href="/actors/page/{{ $previous }}">Previous</a>
    @else
    <div></div>
    @endif
    @if ($next)
    <a href="/actors/page/{{ $next }}">Next</a>
    @else
    <div></div>
    @endif
</div> --}}
<div class="page-load-status">
    <div class="flex justify-center">
        <div class="spinner my-8 text-3xl loader-ellips infinite-scroll-request">&nbsp;</div>
        <p class="infinite-scroll-last">End of content</p>
        <p class="infinite-scroll-error">No more pages to load</p>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
<script>
    var elem = document.querySelector('.grid');
    var infScroll = new InfiniteScroll( elem, {
    // options
    path: '/actors/page/@{{#}}',
    append: '.actor',
    status: '.page-load-status'
    });
</script>
@endsection
