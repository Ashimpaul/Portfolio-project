<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <h2>Upload Resume Image</h2>
                    @if(session('success'))
                    <p>{{session('success')}}</p>
                    @endif
                    <form action="{{route('image.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="image">Choose Image :</label>
                        <input type="file" name="image">
                        <button type="submit">Upload</button>
                        </form>
                    
                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
