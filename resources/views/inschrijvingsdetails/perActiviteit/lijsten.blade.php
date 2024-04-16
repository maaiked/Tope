<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lijsten voor activiteit: id ').$activiteit->id." - ".$activiteit->naam }}
        </h2>
        {{ $activiteit->locatie->naam }} :
        {{Carbon\Carbon::parse($activiteit->starttijd)->format('d-m-Y') }}
        <h3>

        </h3>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{--                TODO:: fix small screen colums--}}

            <button class=" rounded-md bg-blue-500 text-white focus:ring-gray-600 px-2 py-2 text-sm"
                    onclick="window.history.back()">Terug naar activiteiten</button>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-2 gap-4 gap-y-2 text-sm mt-2">
                {{-- Lijst ingeschreven kinderen --}}
                <div>
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight">Ingeschreven kinderen</h3>
                    <p class="text-md text-gray-800 leading-tight">voornaam - familienaam - leerjaar - ouder - contactpersoon - afhalen - alleennaarhuis</p>
                    <button
                        class="rounded-md bg-gray-500 text-white focus:ring-gray-600 px-2 py-2 text-sm"
                        onclick="window.location='{{ route("inschrijvingsdetails.showLijst", [$activiteit->id, "alleKinderen"]) }}'">
                        {{ "bekijken" }}
                    </button>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-2 gap-4 gap-y-2 text-sm mt-4">
                {{-- Lijst aanwezige kinderen --}}
                <div>
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight">Aanwezige kinderen</h3>
                    <p class="text-md text-gray-800 leading-tight">voornaam - familienaam - leerjaar - ouder - contactpersoon - afhalen - alleennaarhuis</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-2 gap-4 gap-y-2 text-sm mt-4">
                {{-- Lijst per opte --}}
                <div>
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight">Inschrijvingen voor optie 1</h3>
                    <p class="text-md text-gray-800 leading-tight">voornaam - familienaam - leerjaar - ouder - contactpersoon - afhalen - alleennaarhuis</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-2 gap-4 gap-y-2 text-sm mt-4">
                {{-- Lijsten medische gegevens --}}
                <div>
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight">Medische info: alles</h3>
                    <p class="text-md text-gray-800 leading-tight">voornaam - familienaam - leerjaar - ouder - contactpersoon - allergie - beperking - medicatie</p>
                </div>
            </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-2 gap-4 gap-y-2 text-sm mt-4">
                    {{-- Lijsten medische gegevens --}}
                    <div>
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight">Allergieën</h3>
                    <p class="text-md text-gray-800 leading-tight">voornaam - familienaam - leerjaar - ouder - allergie</p>
                </div>
                </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-2 gap-4 gap-y-2 text-sm mt-4">
                        {{-- Lijsten medische gegevens --}}
                        <div>
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight">Medicatie</h3>
                    <p class="text-md text-gray-800 leading-tight">voornaam - familienaam - leerjaar - ouder - contactpersoon - medicatie</p>
                </div>
                    </div>
            </div>

        </div>
    </div>
</x-app-layout>
