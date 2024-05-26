<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Locatie bewerken') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('locatie.update', $locatie) }}">
        @csrf
        @method('PUT')

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4 px-3 py-3">
                        <div class="md:col-span-2">
                            <label for="naam">Naam</label>
                            <input type="text" name="naam" id="naam"
                                   class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                   value="{{ old('naam', $locatie->naam) }}"
                                   placeholder="vb. Sporthal"/>
                            <x-input-error :messages="$errors->get('naam')" class="mt-2"/>
                        </div>
                        <div class="md:col-span-2">
                            <label for="straat">Straat</label>
                            <input type="text" name="straat" id="straat"
                                   class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                   value="{{ old('straat', $locatie->straat) }}"
                                   placeholder="vb. Nieuwstraat"/>
                            <x-input-error :messages="$errors->get('straat')" class="mt-2"/>
                        </div>
                        <div class="md:col-span-2">
                            <label for="gemeente">Gemeente</label>
                            <input type="text" name="gemeente" id="gemeente"
                                   class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                   value="{{ old('gemeente', $locatie->gemeente) }}"
                                   placeholder="vb. Gent"/>
                            <x-input-error :messages="$errors->get('gemeente')" class="mt-2"/>
                        </div>
                    </div>

                    <x-primary-button class="mt-4">{{ __('Opslaan') }}</x-primary-button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
