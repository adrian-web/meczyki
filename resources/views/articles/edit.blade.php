<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="/articles" class="mr-5">Articles</a>
            <a href="/users" class="mr-5">Top 3</a>
            <a href="/articles/create" class="mr-5">Create</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <form action="{{ '/articles/' . $article->id }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-jet-label for="title" value="{{ __('Title') }}" />
                                        <x-jet-input type="text" id="title" name="title" class="mt-1 block w-full"
                                            required value="{{ $article->title }} " />
                                        <x-jet-input-error for=" title" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <x-jet-label for="body" value="{{ __('Body') }}" />
                                        <textarea name="body" id="body" rows="10"
                                            class="form-input rounded-md shadow-sm mt-1 block w-full"
                                            required>{{ $article->body }}</textarea>
                                        <x-jet-input-error for="body" class="mt-2" />

                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <x-jet-button>
                                    {{ __('Update') }}
                                </x-jet-button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
