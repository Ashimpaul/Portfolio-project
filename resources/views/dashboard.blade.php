<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <h2 class="text-2xl font-bold mt-4">Upload Resume Image</h2>
                    @if(session('success'))
                    <p class="text-green-500">{{session('success')}}</p>
                    @endif
                    <form action="{{route('image.store')}}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Choose Image :</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full">
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
