<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "Activiteit bewerken" }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('activiteiten.update' , $activiteit->id)}}">
        @csrf
        @method('PUT')

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6">

                    @if (session('status') === 'activiteit-updated')
                    <p class="text-lg py-4 px-4 text-green-950"
                    ><i>{{ __('Wijzigingen zijn opgeslaan.') }}</i></p>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="text-gray-800">
                        <p class="font-medium text-lg">Informatie over de activiteit</p>
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4 px-3 py-3">
                            <div class="md:col-span-2">
                                <label for="naam">Naam</label>
                                <input type="text" name="naam" id="naam"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('naam', $activiteit->naam) }}"
                                       placeholder="Naam"/>
                                <x-input-error :messages="$errors->get('naam')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="omschrijving">Omschrijving</label>
                                <input type="text" name="omschrijving" id="omschrijving"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('omschrijving', $activiteit->omschrijving) }}"
                                       placeholder="Omschrijving"/>
                                <x-input-error :messages="$errors->get('omschrijving')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="prijs">Prijs</label>
                                <input type="text" name="prijs" id="prijs"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('prijs', $activiteit->prijs) }}"
                                       placeholder="Prijs"/>
                                <x-input-error :messages="$errors->get('prijs')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="capaciteit">Capaciteit</label>
                                <input type="text" name="capaciteit" id="capaciteit"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('capaciteit', $activiteit->capaciteit) }}"
                                       placeholder="Capaciteit"/>
                                <x-input-error :messages="$errors->get('capaciteit')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="starttijd">Starttijd</label>
                                <input type="datetime-local" name="starttijd" id="starttijd"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('starttijd', \Carbon\Carbon::parse($activiteit->starttijd)->format('Y-m-d\TH:i')) }}"
                                       placeholder="Starttijd"/>
                                <x-input-error :messages="$errors->get('starttijd')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="eindtijd">Eindtijd</label>
                                <input type="datetime-local" name="eindtijd" id="eindtijd"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('eindtijd', \Carbon\Carbon::parse($activiteit->eindtijd)->format('Y-m-d\TH:i')) }}"
                                       placeholder="Eindtijd"/>
                                <x-input-error :messages="$errors->get('eindtijd')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="inschrijvenVanaf">Inschrijven Vanaf</label>
                                <input type="datetime-local" name="inschrijvenVanaf" id="inschrijvenVanaf"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('inschrijvenVanaf', \Carbon\Carbon::parse($activiteit->inschrijvenVanaf)->format('Y-m-d\TH:i')) }}"
                                       placeholder="Inschrijven Vanaf"/>
                                <x-input-error :messages="$errors->get('inschrijvenVanaf')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="inschrijvenTot">Inschrijven Tot</label>
                                <input type="datetime-local" name="inschrijvenTot" id="inschrijvenTot"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('inschrijvenTot', \Carbon\Carbon::parse($activiteit->inschrijvenTot)->format('Y-m-d\TH:i')) }}"
                                       placeholder="Inschrijven Tot"/>
                                <x-input-error :messages="$errors->get('inschrijvenTot')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="annulerenTot">Annuleren Tot</label>
                                <input type="datetime-local" name="annulerenTot" id="annulerenTot"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('annulerenTot', \Carbon\Carbon::parse($activiteit->annulerenTot)->format('Y-m-d\TH:i')) }}"
                                       placeholder="Annuleren Tot"/>
                                <x-input-error :messages="$errors->get('annulerenTot')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="leerjaarVanaf">Leerjaar Vanaf</label>
                                <input type="number" name="leerjaarVanaf" id="leerjaarVanaf"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('leerjaarVanaf', $activiteit->leerjaarVanaf) }}"
                                       placeholder="Leerjaar Vanaf"/>
                                <x-input-error :messages="$errors->get('leerjaarVanaf')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="leerjaarTot">Leerjaar Tot</label>
                                <input type="number" name="leerjaarTot" id="leerjaarTot"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('leerjaarTot', $activiteit->leerjaarTot) }}"
                                       placeholder="Leerjaar Tot"/>
                                <x-input-error :messages="$errors->get('leerjaarTot')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="locatie">Locatie</label>
                                <input type="text" name="locatie" id="locatie"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('locatie', $activiteit->locatie->naam) }}"
                                       placeholder="Locatie"/>
                                <x-input-error :messages="$errors->get('locatie')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="opties">Opties</label>
                                <input type="text" name="opties" id="opties"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('opties', $activiteit->opties->pluck('omschrijving')->implode(', ')) }}"
                                       placeholder="Opties"/>
                                <x-input-error :messages="$errors->get('opties')" class="mt-2"/>
                            </div>
                        </div>
                    </div>

                    <x-primary-button class="mt-4">{{ __('Opslaan') }}</x-primary-button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
