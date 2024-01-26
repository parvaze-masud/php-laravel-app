<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           All Posts
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul class="list-unstyled">
                        @forelse($posts as $post)
                        <li class="mt-4">
                           <h4><a href="{{route('posts.show', $post)}}"> {{$post->title}}</a></h4>
                        </li>
                      @empty
                        There are no post yet!
                      @endforelse

                    </ul>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

