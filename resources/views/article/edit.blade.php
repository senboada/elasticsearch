<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Article
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('article.update',[$article->id]) }}" method="POST" class="pb-4">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <x-input type="text" name="title" class="form-control" placeholder="Title" value="{{ $article->title }}" />
                        </div>
                        <div class="form-group">
                            <x-input type="text" name="body" class="form-control" placeholder="Body" value="{{ $article->body }}" />
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="tags[]" value="java" class="form-control" value="{{ request('tags[]') }}">
                            <label for="vehicle1"> java</label><br>
                            <input type="checkbox" name="tags[]" value="php" class="form-control" value="{{ request('tags[]') }}">
                            <label for="vehicle2"> php</label><br>
                            <input type="checkbox" name="tags[]" value="bash" class="form-control" value="{{ request('tags[]') }}">
                            <label for="vehicle3"> bash</label><br> 
                            <input type="checkbox" name="tags[]" value="ruby" class="form-control" value="{{ request('tags[]') }}">
                            <label for="vehicle3"> ruby</label><br> 
                        </div>
                        <x-button class="ml-4">
                            {{ __('Guardar') }}
                        </x-button>
                    </form>
                    <hr>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>