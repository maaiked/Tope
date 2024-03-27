<x-app-layout>
    <form method="POST" action="/kind/{{$kind->id}}">
        @csrf
        @method('PUT')

        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

                <h2 class="font-semibold text-xl text-gray-600">Kind {{$kind->voornaam}} bewerken</h2>
                <p class="text-gray-500 mb-6">Wijzig hieronder de gegevens</p>

                <div class="bg-gray-50 rounded p-4 px-4 md:p-8 mb-6">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="text-gray-60 bg-emerald-700">
                            <p class="font-medium text-lg">Algemene informatie</p>
                            <p>Gelieve alle velden in te vullen</p>
                        </div>

                        <div class="md:col-span-5">
                            <label for="voornaam">Voornaam</label>
                            <input type="text" name="voornaam" id="voornaam"
                                   class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                   value="{{ old('voornaam', $kind->voornaam) }}"
                                   placeholder="vb. Katrien"/>
                            <x-input-error :messages="$errors->get('voornaam')" class="mt-2"/>
                        </div>

                        <div class="md:col-span-5">
                            <label for="familienaam">Familienaam</label>
                            <input type="text" name="familienaam" id="familienaam"
                                   class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                   value="{{ old('familienaam', $kind->familienaam) }}"
                                   placeholder="vb. De Groote"/>
                            <x-input-error :messages="$errors->get('familienaam')" class="mt-2"/>
                        </div>

                        <div class="md:col-span-3">
                            <label for="rijksregisternummer">Rijksregisternummer</label>
                            <input type="text" name="rijksregisternummer" id="rijksregisternummer"
                                   class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                   value="{{ old('rijksregisternummer', $kind->rijksregisternummer) }}"
                                   placeholder="10.10.10-100.10"/>
                            <x-input-error :messages="$errors->get('rijksregisternummer')" class="mt-2"/>
                        </div>

                        <div class="text-gray-600">
                            <p class="font-medium text-lg">Medische informatie</p>
                            <p>Vul de velden in die van toepassing zijn</p>
                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">

                                <div class="md:col-span-2">
                                    <label for="allergie">Allergie</label>
                                    <input type="text" name="allergie" id="allergie"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                           value="{{ old('allergie', $kind->allergie) }}"
                                           placeholder="vb. noten, pollen, melk, aarbei,..."/>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="beperking">Beperking</label>
                                    <input type="text" name="beperking" id="beperking"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                           value="{{ old('beperking', $kind->beperking) }}"
                                           placeholder="vb. ADHD, autisme, motorische moeilijkheden,..."/>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="medicatie">Medicatie: naam, hoeveelheid, tijdstip</label>
                                    <input type="text" name="medicatie" id="medicatie"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                           value="{{ old('medicatie', $kind->medicatie) }}"
                                           placeholder="vb. Ventolin,1 x puffen, over de middag"/>
                                </div>
                            </div>
                        </div>

                        <div class="text-gray-600">
                            <p class="font-medium text-lg">Contact en afhalen</p>
                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">

                                <div class="md:col-span-2">
                                    <label for="contactpersoon">Extra contactpersoon in geval van nood: naam +
                                        nummer</label>
                                    <input type="text" name="contactpersoon" id="contactpersoon"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                           value="{{ old('contactpersoon', $kind->contactpersoon) }}"
                                           placeholder="vb. Oma Mieke: 0474 74 74 74"/>
                                    <x-input-error :messages="$errors->get('contactpersoon')" class="mt-2"/>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="afhalenKind">Wie mag je kind afhalen?</label>
                                    <input type="text" name="afhalenKind" id="afhalenKind"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                           value="{{ old('afhalenKind', $kind->afhalenKind) }}"
                                           placeholder="vb. oma Mieke Janssens, nonkel Bob Debrouwer"/>
                                </div>


                                <div class="md:col-span-2">
                                    <div class="inline-flex items-center">
                                        <input type="checkbox" name="alleenNaarHuis" id="alleenNaarHuis"
                                               class="form-checkbox" value="1" @if($kind->alleenNaarHuis) checked @endif/>
                                        <label for="alleenNaarHuis"
                                               class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">Mijn kind mag
                                            alleen naar huis vertrekken.</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-gray-600">
                            <p class="font-medium text-lg">Beeldmateriaal</p>
                            <p>Tijdens de werking worden af en toe sfeerbeelden genomen. <br>
                                Zo zorgen we voor een leuke herinnering voor de kinderen, en kan je als ouder
                                meegenieten van onze sfeer.<br></p>
                            Voor promotionele doelen wordt individueel toestemming gevraagd.<br>
                            Verschijnt er toch een foto waar je kind op staat, die je liever offline ziet? Neem
                            gerust contact op.
                        </div>

                        <div class="lg:col-span-2">
                            <div class="form-radio grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                <div class="col-md-4">
                                    <div class="radio">
                                        <label for="fotoToestemming-0">
                                            <input type="radio" name="fotoToestemming"
                                                   id="fotoToestemming-0"
                                                   value="1" @if($kind->fotoToestemming) checked="checked" @endif>
                                            Ja, ik geef toestemming dat mijn kind op foto's mag staan.
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="fotoToestemming-1">
                                            <input type="radio" name="fotoToestemming"
                                                   id="fotoToestemming-1"
                                                   value="0" @if(!$kind->fotoToestemming) checked="checked" @endif>
                                            Nee, ik geef geen toestemming om foto's te maken van mijn kind.
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-gray-600">
                            <p class="font-medium text-lg">UiTPAS</p>
                            <p>Heeft je kind een UiTPAS? Vul dan hieronder zeker het nummer aan.<br></p>
                            <b>Heeft je kind recht op het kansentarief? Met het ingevulde uitpasnummer zie je
                                meteen de juiste prijs bij de activiteiten</b>
                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">

                                <div class="md:col-span-2">
                                    <label for="uitpasnummer">UiTPAS-nummer kind</label>
                                    <input type="text" name="uitpasnummer" id="uitpasnummer"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                           value="{{ old('uitpasnummer', $kind->uitpasnummer) }}"
                                           placeholder="110110000111"/>
                                </div>

                            </div>
                        </div>
                    </div>

                    <x-primary-button class="mt-4">{{ __('Opslaan') }}</x-primary-button>
                </div>

            </div>
        </div>
    </form>
</x-app-layout>
