<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "Profiel bewerken" }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('profiel.update')}}">
        @csrf
        @method('PUT')

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6">

                    @if (session('status') === 'profiel-updated')
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
                        <p class="font-medium text-lg">Algemene informatie ouder</p>
                        <p>Vul hieronder jouw gegevens in. <br>
                        <b>Deze gegevens komen op je fiscaal attest: gebruik daarom de gegevens van de ouder die het kind fiscaal ten laste heeft binnen jouw gezin. </b></p>
{{--                        TODO:: meer info link toevoegen: info fiscaal attest met beslissingsboom toevoegen--}}

                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4 px-3 py-3">
                            <div class="md:col-span-2">
                                <label for="voornaam">Voornaam</label>
                                <input type="text" name="voornaam" id="voornaam"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('voornaam', $userprofiel->voornaam) }}"
                                       placeholder="vb. Katrien"/>
                                <x-input-error :messages="$errors->get('voornaam')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="familienaam">Familienaam</label>
                                <input type="text" name="familienaam" id="familienaam"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('familienaam', $userprofiel->familienaam) }}"
                                       placeholder="vb. De Groote"/>
                                <x-input-error :messages="$errors->get('familienaam')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="rijksregisternummer">Rijksregisternummer</label>
                                <input type="text" name="rijksregisternummer" id="rijksregisternummer"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('rijksregisternummer', $userprofiel->rijksregisternummer) }}"
                                       placeholder="vb. 10.10.10-100.10"/>
                                <x-input-error :messages="$errors->get('rijksregisternummer')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="telefoonnummer">Telefoonnummer</label>
                                <input type="text" name="telefoonnummer" id="telefoonnummer"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('telefoonnummer', $userprofiel->telefoonnummer) }}"
                                       placeholder="vb. 0474 76 76 76"/>
                                <x-input-error :messages="$errors->get('telefoonnummer')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="straat">Straat</label>
                                <input type="text" name="straat" id="straat"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('straat', $userprofiel->straat) }}"
                                       placeholder="vb. Nieuwstraat"/>
                                <x-input-error :messages="$errors->get('straat')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-1">
                                <label for="huisnummer">Huisnummer</label>
                                <input type="text" name="huisnummer" id="bus"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('huisnummer', $userprofiel->huisnummer) }}"
                                       placeholder="vb. nummer 105"/>
                                <x-input-error :messages="$errors->get('huisnummer')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-1">
                                <label for="bus">Bus</label>
                                <input type="text" name="bus" id="bus"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('bus', $userprofiel->bus) }}"
                                       placeholder="vb. bus A4"/>
                                <x-input-error :messages="$errors->get('bus')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-1">
                                <label for="postcode">Postcode</label>
                                <input type="text" name="postcode" id="postcode"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('postcode', $userprofiel->postcode) }}"
                                       placeholder="vb. 8530"/>
                                <x-input-error :messages="$errors->get('postcode')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-3">
                                <label for="gemeente">Gemeente</label>
                                <input type="text" name="gemeente" id="gemeente"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       value="{{ old('gemeente', $userprofiel->gemeente) }}"
                                       placeholder=""/>
                                <x-input-error :messages="$errors->get('gemeente')" class="mt-2"/>
                            </div>
                        </div>
                    </div>

                    <x-primary-button class="mt-4">{{ __('Opslaan') }}</x-primary-button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
