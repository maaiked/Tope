<x-app-layout>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Activiteiten') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div>
                        @if (auth()->user()->isAdmin)
                            <form method="POST" action="{{ route('activiteiten.store') }}">
                                @csrf
                                <textarea
                                    name="message"
                                    placeholder="{{ __('Geef de naam van de nieuwe activiteit') }}"
                                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                >{{ old('message') }}</textarea>
                                <x-input-error :messages="$errors->get('message')" class="mt-2"/>
                                <x-primary-button class="mt-4">{{ __('Voeg toe') }}</x-primary-button>
                            </form>
                        @endif
                    </div>

                    <div class="bg-white shadow-sm rounded-lg divide-y">
                        @foreach ($activiteiten as $activiteit)
                            <div class="p-2 flex space-x-0">
                                <div class="flex-1">
                                    <p class="mt-4 text-lg text-gray-900">{{ $activiteit->message }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $activiteiten->links() }}
                </div>
            </div>
        </div>
    </x-app-layout>
