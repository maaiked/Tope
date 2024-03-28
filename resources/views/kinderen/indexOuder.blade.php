<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jouw kinderen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($kinderen as $kind)
                    <div class="bg-gray-200 hover:bg-blue-300 font-bold py-2 px-2 mt-2 mb-2 rounded">
                        <p class="mt-2 text-gray-900">{{ $kind->voornaam." ".$kind->familienaam }}</p>
                        <button onclick="window.location='{{ route("kind.edit", $kind->id) }}'"
                                class="inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="h-4 w-4"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                                />
                            </svg>
                            Bewerk
                        </button>
                    </div>
                @endforeach
                {{--                        TODO: kindgegevens weergeven in card--}}

            </div>
            <button onclick="window.location='{{ route("kind.create") }}'"
                    button class="bg-blue-500 hover:bg-blue-700 mt-2 text-white font-bold py-2 px-4 rounded">
                Kind toevoegen
            </button>
        </div>
    </div>

</x-app-layout>
