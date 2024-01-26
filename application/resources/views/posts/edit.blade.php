<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf @method('PATCH')

            <!-- Title -->
            <div class="mt-4">
                <x-label for="title" :value="__('Title')" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{$post->title}}" required />
            </div>

                <!-- Body -->
                <div class="mt-4">
                    <x-label for="body" :value="__('Body')" />
                    <textarea name="body" id="" cols="30" rows="10" class="block mt-1 w-full">{{$post->body}}</textarea>

                    {{-- <x-input id="body" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required /> --}}
                </div>


                <x-button class="ml-4 mt-4">
                    {{ __('Update') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>


