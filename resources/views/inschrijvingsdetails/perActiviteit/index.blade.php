<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inschrijvingen voor activiteit: id ').$activiteit->id." - ".$activiteit->naam }}
        </h2>
        <p>{{ $activiteit->locatie->naam." : van ".Carbon\Carbon::parse($activiteit->starttijd)->format('d-m-Y')." tot ".Carbon\Carbon::parse($activiteit->eindtijd)->format('d-m-Y')}}</p>
        <p>{{$activiteit->leerjaarVanaf->label()." - ".$activiteit->leerjaarTot->label()}}</p>
        <p>{{$activiteit->omschrijving}}</p>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status') === 'geenKind')
                <p class="text-lg py-4 px-4 text-red-600"
                ><i>{{ __('Er werd geen kind gevonden met de gevraagde details. Controleer of het kind binnen de leeftijdslimiet valt en nog niet ingeschreven werd.') }}</i></p>
            @elseif(session('status') === 'inschrijving-ok')
                <p class="text-lg py-4 px-4 text-green-500"
                ><i>{{ __('De inschrijving werd toegevoegd') }}</i></p>

            @endif

            <button class=" rounded-md bg-blue-500 text-white focus:ring-gray-600 px-2 py-2 text-sm"
                    onclick="window.location='{{ route("activiteiten.index") }}'">Terug naar activiteiten
            </button>
            {{--    toon knop enkel als er inschrijvingen zijn om weer te geven --}}
            @if(!empty($activiteit->inschrijvingsdetails->first()))
                <button onclick="window.location='{{ route("inschrijvingsdetails.indexLijsten", $activiteit->id) }}'"
                        class="rounded-md bg-gray-500 text-white focus:ring-gray-600 px-4 py-2 text-sm mt-4">
                    lijsten afdrukken
                </button>
            @else
                <p>Lijsten kan je pas zien als er inschrijvingen zijn</p>
            @endif

            {{--                TODO:: fix small screen colums--}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6 gap-4 gap-y-2 text-sm">
                {{-- Tabel ingeschreven kinderen + capaciteit --}}
                <div>
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight">{{"Ingeschreven kinderen: ".$activiteit->aantalInschrijvingen."/".$activiteit->capaciteit}}</h3>
                </div>

                <table id="example" class="bootstrap-table" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th class="px-2 py-2">Deelnemer voornaam , familienaam</th>
                        <th class="px-2 py-2">Ouder voornaam , familienaam</th>
                        <th class="px-2 py-2">IN / UIT</th>
                        <th class="px-2 py-2">Alleen naar huis?</th>
                        <th class="px-2 py-2">Afhalen</th>
                        <th class="px-2 py-2">Gekozen opties</th>
                        <th class="px-2 py-2">Foto?</th>
                        <th class="px-2 py-2">Medisch</th>
                        <th class="px-2 py-2">Interne info</th>
                        <th class="px-2 py-2">Betaling</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($inschrijvingsdetails as $i)
                        @if(!$i->deleted_at)
                            <tr>

                                <!-- Voornaam, familienaam kind -->
                                <td class="border px-2 py-2">{{$i->kind->voornaam." , ".$i->kind->familienaam}}</td>

                                <!-- Info ouder -->
                                <td class="border px-2 py-2">{{ optional($i->kind->user->profiel)->voornaam." , ".optional($i->kind->user->profiel)->familienaam }}</td>

                                <!-- Knoppen in- en uitchecken -->
                                <td class="border px-2 py-2">
                                    <button
                                        class="rounded-md bg-gray-200 text-black focus:ring-gray-600 px-2 py-2 text-sm">
                                        {{ "inchecken" }}
                                    </button>
                                    <button
                                        class="rounded-md bg-gray-200  text-black focus:ring-gray-600 px-2 py-2 text-sm">
                                        {{ "uitchecken" }}
                                    </button>
                                </td>

                                <!-- Alleen naar huis -->
                                <td class="border px-2 py-2">@if($i->kind->alleenNaarHuis)
                                        <p class="text-green-900"> JA</p>
                                    @else
                                        <p> x </p>
                                    @endif</td>
                                <td class="border px-2 py-2">{{$i->kind->afhalenKind}}</td>

                                <!-- Ingeschreven opties -->
                                <td class="border px-2 py-2">
                                    @foreach($i->inschrijvingsdetail_opties as $detail_optie)
                                        {{$detail_optie->optie->omschrijving}}
                                    @endforeach</td>

                                <!-- Foto toestemming -->
                                <td class="border px-2 py-2">@if($i->kind->fotoToestemming)
                                        <p> v </p>
                                    @else
                                        <p class="text-red-600"> nee </p>
                                    @endif</td>

                                <!-- Knop medische informatie -->
                                <td class="border px-2 py-2"> @if($i->kind->medicatie || $i->kind->allergie || $i->kind->beperking)
                                        <!-- Trigger Button -->
                                        <button name="allergie" onclick="show({{$i->id}})"
                                                class="bg-orange-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Ja
                                        </button>
                                    @endif
                                    <!-- Modal -->
                                    <div id="{{$i->id}}" class="fixed z-10 inset-0 overflow-y-auto hidden">
                                        <div class="flex items-center justify-center min-h-screen">
                                            <div class="bg-blue-500 w-1/2 p-6 rounded shadow-md">
                                                <div class="flex justify-end">
                                                    <!-- Close Button -->
                                                    <button id="close" onclick="hide({{$i->id}})"
                                                            class="text-gray-700 hover:text-red-500">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                             viewBox="0 0 24 24"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <h2 class="text-2xl font-bold mb-4">{{"Medische info ".$i->kind->voornaam}}</h2>
                                                @if($i->kind->allergie)
                                                    <div class="mb-4 font-bold">
                                                        {{"allergie: ".$i->kind->allergie}}
                                                    </div>
                                                @endif
                                                @if($i->kind->medicatie)
                                                    <div class="mb-4 font-bold">
                                                        {{"medicatie: ".$i->kind->medicatie}}
                                                    </div>
                                                @endif
                                                @if($i->kind->beperking)
                                                    <div class="mb-4 font-bold">
                                                        {{"beperking: ".$i->kind->beperking}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Knop interne info voor animatoren -->
                                <td class="border px-2 py-2">@if($i->kind->infoAdminAnimator)
                                        <!-- Trigger Button -->
                                        <button name="infoAdminAnimator" onclick="showInfo({{$i->id}})"
                                                class="bg-orange-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Ja
                                        </button>
                                    @endif
                                    <!-- Modal -->
                                    <div id="info.{{$i->id}}" class="fixed z-10 inset-0 overflow-y-auto hidden">
                                        <div class="flex items-center justify-center min-h-screen">
                                            <div class="bg-blue-500 w-1/2 p-6 rounded shadow-md">
                                                <div class="flex justify-end">
                                                    <!-- Close Button -->
                                                    <button id="close" onclick="hideInfo({{$i->id}})"
                                                            class="text-gray-700 hover:text-red-500">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                             viewBox="0 0 24 24"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <h2 class="text-2xl font-bold mb-4">{{"Interne info ".$i->kind->voornaam}}</h2>
                                                <div class="mb-4 font-bold">
                                                    {{$i->kind->infoAdminAnimator}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Knop betaling -->
                                <td class="border px-2 py-2">
                                    <button
                                        class="rounded-md bg-gray-500 text-white focus:ring-gray-600 px-2 py-2 text-sm">
                                        {{ "betaling" }}
                                    </button>
                            </tr>
                        @endif
                    @endforeach

                    </tbody>
                </table>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6 gap-4 gap-y-2 text-sm">
                <button
                    class="rounded-md mt-4 bg-gray-500 text-white focus:ring-gray-600 px-2 py-2 text-sm"
                    onclick="show('zoekForm')">
                    {{ "Kind toevoegen" }}
                </button>

                <form method="POST" action="{{ route('inschrijvingsdetails.create', $activiteit->id) }}" id="zoekForm" class="hidden">
                    @csrf
                    <p class="font-bold">Kind opzoeken:</p>
                    <div>
                        <label for="zoek">Zoek op (deel van) voornaam, familienaam, rijksregisternummer of uitpasnummer</label>
                        <input type="text" name="zoek" id="zoek"
                               class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                        />
                        <x-input-error :messages="$errors->get('zoek')" class="mt-2"/>
                    </div>
                    <input type="hidden" name="activiteit" value="{{ $activiteit->id }}" />
                    <x-primary-button class="mt-4">{{ __('Zoeken') }}</x-primary-button>
                </form>
            </div>


            {{--                TODO:: fix small screen colums--}}
            <div
                class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6 gap-4 gap-y-2 text-sm mt-4">
                {{-- Overzicht uitgeschreven kinderen --}}
                <div>
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight">{{"Uitgeschreven kinderen"}}</h3>
                </div>

                <div class=" px-6 py-2 grid gap-4 gap-y-2 text-sm grid-cols-2 md:grid-cols-4">

                    {{-- kolomtitels --}}
                    <div class="flex space-x-0">
                        <p class="mt-4 text-lg text-gray-900">Inschrijvingsdatum</p>
                    </div>
                    <div class="flex space-x-0">
                        <p class="mt-4 text-lg text-gray-900">Deelnemer</p>
                    </div>
                    <div class="flex space-x-0">
                        <p class="mt-4 text-lg text-gray-900">Ouder</p>
                    </div>
                    <div class="flex space-x-0">
                        <p class="mt-4 text-lg text-gray-900">Uitgeschreven op</p>
                    </div>

                    {{-- rijen --}}
                    @foreach ($inschrijvingsdetails as $i)
                        {{-- toon inschrijvingen die softdeleted zijn --}}
                        @if($i->deleted_at)

                            {{--    inschrijvingsdatum    --}}
                            <div class="flex space-x-0">
                                <p class="mt-2 text-md text-gray-900">{{ Carbon\Carbon::parse($i->inschrijvingsdatum)->format('d-m-Y')}}</p>
                            </div>

                            {{--    voornaam + familienaam kind    --}}
                            <div class="flex space-x-0">
                                <p class="mt-2 text-md text-gray-900">{{ $i->kind->voornaam." , ".$i->kind->familienaam }}</p>
                            </div>

                            {{--    ouder kind    --}}
                            <div class=" flex space-x-0">
                                <p class="mt-2 text-md text-gray-900">{{ optional($i->kind->user->profiel)->voornaam." , ".optional($i->kind->user->profiel)->familienaam }}</p>
                            </div>

                            {{--    uitschrijvingsdatum    --}}
                            <div class="flex space-x-0">
                                <p class="mt-2 text-md text-gray-900">{{ Carbon\Carbon::parse($i->deleted_at)->format('d-m-Y')}}</p>
                            </div>

                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>

        // JavaScript to toggle the modal

        function show(id) {
            var modal = document.getElementById(id);
            modal.classList.remove('hidden');
        }

        function showInfo(id) {
            var name = "info.".concat(id);
            var modal = document.getElementById(name);
            modal.classList.remove('hidden');
        }

        function hideInfo(id) {
            var name = "info.".concat(id);
            var modal = document.getElementById(name);
            modal.classList.add('hidden');
        }

        function hide(id) {
            var modal = document.getElementById(id);
            modal.classList.add('hidden');
        }


    </script>
</x-app-layout>
