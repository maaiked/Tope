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
                            <div class="md:col-span-1">
                                <label for="leerjaarVanaf">LeerjaarVanaf</label>
                                <select name="leerjaarVanaf" id="leerjaarVanaf" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                                    @foreach(App\Enums\LeerjaarEnum::cases() as $leerjaar)
                                    <option value="{{ $leerjaar->value }}" {{ old('leerjaarVanaf', $activiteit->leerjaarVanaf->value) == $leerjaar->value ? 'selected' : '' }}>
                                    {{ $leerjaar->label() }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('leerjaarVanaf')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-1">
                                <label for="leerjaarTot">LeerjaarTot</label>
                                <select name="leerjaarTot" id="leerjaarTot" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                                    @foreach(App\Enums\LeerjaarEnum::cases() as $leerjaar)
                                    <option value="{{ $leerjaar->value }}" {{ old('leerjaarTot', $activiteit->leerjaarTot->value) == $leerjaar->value ? 'selected' : '' }}>
                                    {{ $leerjaar->label() }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('leerjaarTot')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="locatie">Locatie</label>
                                <select name="locatie_id" id="locatie" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                                    @foreach($locaties as $locatie)
                                    <option value="{{ $locatie->id }}" {{ $activiteit->locatie_id == $locatie->id ? 'selected' : '' }}>
                                        {{ $locatie->naam }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('locatie_id')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-4">
                                <label>Huidige Opties</label>
                                @foreach($activiteit->opties as $optie)
                                <div class="flex items-center mt-2">
                                    <input type="checkbox" name="delete_opties[]" value="{{ $optie->id }}" checked>
                                    <input type="text" name="existing_opties[{{ $optie->id }}][omschrijving]" value="{{ $optie->omschrijving }}" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 mr-2">
                                    <input type="text" name="existing_opties[{{ $optie->id }}][prijs]" value="{{ $optie->prijs }}" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="Prijs">
                                </div>
                                <x-input-error :messages="$errors->get('existing_opties.{$optie->id}.omschrijving')" class="mt-2"/>
                                <x-input-error :messages="$errors->get('existing_opties.{$optie->id}.prijs')" class="mt-2"/>
                                @endforeach
                            </div>
                            <div class="md:col-span-4">
                                <label for="new_opties">Nieuwe Opties</label>
                                <div id="new-opties-container">
                                    <div class="flex items-center mt-2">
                                        <input type="text" name="new_opties[0][omschrijving]" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 mr-2" placeholder="Omschrijving">
                                        <input type="text" name="new_opties[0][prijs]" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="Prijs">
                                    </div>
                                    <x-input-error :messages="$errors->get('new_opties.0.omschrijving')" class="mt-2"/>
                                    <x-input-error :messages="$errors->get('new_opties.0.prijs')" class="mt-2"/>
                                </div>
                                <button type="button" onclick="addNewOptie()" class="mt-2 text-blue-500">Voeg nieuwe optie toe</button>
                            </div>
                        </div>
                    </div>

                    <x-primary-button class="mt-4">{{ __('Opslaan') }}</x-primary-button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>

<script>
    let newOptieIndex = 1;
    function addNewOptie() {
        const container = document.getElementById('new-opties-container');
        const newOptie = `
                                        <div class="flex items-center mt-2">
                                            <input type="text" name="new_opties[${newOptieIndex}][omschrijving]" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 mr-2" placeholder="Omschrijving">
                                            <input type="text" name="new_opties[${newOptieIndex}][prijs]" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="Prijs">
                                        </div>
                                        <x-input-error :messages="$errors->get('new_opties.${newOptieIndex}.omschrijving')" class="mt-2"/>
                                        <x-input-error :messages="$errors->get('new_opties.${newOptieIndex}.prijs')" class="mt-2"/>`;
        container.insertAdjacentHTML('beforeend', newOptie);
        newOptieIndex++;
    }
</script>
