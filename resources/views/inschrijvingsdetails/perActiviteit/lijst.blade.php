<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lijst ').$lijstnaam }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <button class=" rounded-md bg-blue-500 text-white focus:ring-gray-600 px-2 py-2 text-sm"
             onclick="window.history.back()">Terug naar overzicht lijsten</button>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mt-2">
            @switch($lijstnaam)
                @case ("alle kinderen")
                    {{-- Lijst ingeschreven kinderen --}}
                    <div>
                        <h3 class="font-semibold text-lg text-gray-800 leading-tight">Alle ingeschreven kinderen</h3>
                        <div class="max-w-xl">
                            @include('inschrijvingsdetails.perActiviteit.partials.alleKinderen')
                        </div>
                    </div>
                @break
            @endswitch

        </div>
    </div>
</x-app-layout>
