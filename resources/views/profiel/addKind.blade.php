<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if ($user->profiel)
            {{ __('Nieuw kind toevoegen aan ').$user->profiel->familienaam." ".$user->profiel->voornaam }}
            @else
            {{ __('Nieuw kind toevoegen aan ').$user->email }}
            @endif
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('profiel.updateAddKind', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6">

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li class="text-red-600">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <div class="text-gray-800 mt-4">
                        <p class="font-medium text-lg">Algemene informatie</p>
                        <p>De velden met een sterretje (*) zijn verplicht.</p>

                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2 px-3 py-3">
                            <div class="md:col-span-1">
                                <label for="voornaam">Voornaam *</label>
                                <input type="text" name="voornaam" id="voornaam" required
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 "
                                       value="{{ old('voornaam') }}"
                                       placeholder="vb. Katrien"/>
                                <x-input-error :messages="$errors->get('voornaam')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-1">
                                <label for="familienaam">Familienaam *</label>
                                <input type="text" name="familienaam" id="familienaam"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('familienaam') }}"
                                       placeholder="vb. De Groote"/>
                                <x-input-error :messages="$errors->get('familienaam')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-1">
                                <label for="rijksregisternummer">Rijksregisternummer (formaat 12.12.12-123.12) *</label>
                                <input type="text" name="rijksregisternummer" id="rijksregisternummer"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('rijksregisternummer') }}"
                                       placeholder="10.10.10-100.10"/>
                                <x-input-error :messages="$errors->get('rijksregisternummer')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-1">
                                <label for="leerjaar">Leerjaar *</label>
                                <select name="leerjaar" id="leerjaar" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                                    @foreach(App\Enums\LeerjaarEnum::cases() as $leerjaren)
                                    <option value="{{ $leerjaren->value }}" @selected(old('leerjaar') == $leerjaren->value)>
                                    {{ $leerjaren->label() }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('leerjaar')" class="mt-2"/>
                            </div>

                        </div>

                        <p class="font-medium text-lg mt-4">Medische informatie</p>
                        <p>Vul de velden in die van toepassing zijn</p>

                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1 px-3 py-3">
                            <div class="md:col-span-1">
                                <label for="allergie">Allergie</label>
                                <input type="text" name="allergie" id="allergie"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('allergie') }}"
                                       placeholder="vb. noten, pollen, melk, aarbei,..."/>
                            </div>
                            <div class="md:col-span-1">
                                <label for="beperking">Beperking</label>
                                <input type="text" name="beperking" id="beperking"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('beperking') }}"
                                       placeholder="vb. ADHD, autisme, motorische moeilijkheden,..."/>
                            </div>
                            <div class="md:col-span-1">
                                <label for="medicatie">Medicatie: naam, hoeveelheid, tijdstip</label>
                                <input type="text" name="medicatie" id="medicatie"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('medicatie') }}"
                                       placeholder="vb. Ventolin,1 x puffen, over de middag"/>
                            </div>
                        </div>

                        <p class="font-medium text-lg mt-4">Contact en afhalen</p>
                        <p>De velden met een sterretje (*) zijn verplicht.</p>
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2 px-3 py-3">
                            <div class="md:col-span-1">
                                <label for="contactpersoon">Extra contactpersoon in geval van nood: naam +
                                    nummer *</label>
                                <input type="text" name="contactpersoon" id="contactpersoon"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('contactpersoon') }}"
                                       placeholder="vb. Oma Mieke: 0474 74 74 74"/>
                                <x-input-error :messages="$errors->get('contactpersoon')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-1">
                                <label for="afhalenKind">Wie mag het kind afhalen?</label>
                                <input type="text" name="afhalenKind" id="afhalenKind"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('afhalenKind') }}"
                                       placeholder="vb. oma Mieke Janssens, nonkel Bob Debrouwer"/>
                            </div>
                            <div class="md:col-span-1">
                                <div class="inline-flex items-center">
                                    <input type="checkbox" name="alleenNaarHuis" id="alleenNaarHuis"
                                           class="form-checkbox mr-1" value="1">
                                    <label for="alleenNaarHuis">
                                        Het kind mag alleen naar huis vertrekken.</label>
                                </div>
                            </div>
                        </div>

                        <p class="font-medium text-lg mt-4">Beeldmateriaal</p>
                        <p class="text-sm mb-2">Tijdens de werking worden af en toe sfeerbeelden genomen. <br>
                            Zo zorgen we voor een leuke herinnering voor de kinderen, en kan je als ouder
                            meegenieten van onze sfeer.<br>
                            Voor promotionele doelen wordt individueel toestemming gevraagd.<br>
                            Verschijnt er toch een foto waar je kind op staat, die je liever offline ziet? Neem
                            gerust contact op.</p>

                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1 px-3 py-3">

                            <div class="md:col-span-1">
                                <input type="radio" name="fotoToestemming"
                                       id="fotoToestemming-0"
                                       value="1" checked="checked" />
                                <label for="fotoToestemming-0">
                                    Ja, ik geef toestemming dat het kind op foto's mag staan.
                                </label>
                            </div>
                            <div class="md:col-span-1">
                                <input type="radio" name="fotoToestemming"
                                       id="fotoToestemming-1"
                                       value="0" />
                                <label for="fotoToestemming-1">
                                    Nee, ik geef geen toestemming om foto's te maken van het kind.
                                </label>
                            </div>
                        </div>


                        <p class="font-medium text-lg mt-4">UiTPAS</p>
                        <p>Heeft het kind een UiTPAS? Aan de hand van het rijksregisternummer van de ouder zoeken we de bijhorende uitpas op.<br></p>
                        <b>Heeft het kind recht op het kansentarief? De ouder krijgt bij de activiteit meteen het verminderd tarief te zien.</b>

                    </div>

                    <x-primary-button class="mt-4">{{ __('Opslaan') }}</x-primary-button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
