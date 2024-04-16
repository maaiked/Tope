<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inschrijvingen voor activiteit: id ').$inschrijvingsdetails[0]->activiteit->id." - ".$inschrijvingsdetails[0]->activiteit->naam }}
        </h2>
        {{ $inschrijvingsdetails[0]->activiteit->locatie->naam }} :
        {{Carbon\Carbon::parse($inschrijvingsdetails[0]->activiteit->starttijd)->format('d-m-Y') }}

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <button class=" rounded-md bg-blue-500 text-white focus:ring-gray-600 px-2 py-2 text-sm"
                    onclick="window.history.back()">Terug naar activiteiten</button>


            {{--                TODO:: fix small screen colums--}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6 gap-4 gap-y-2 text-sm">
                {{-- Tabel ingeschreven kinderen + capaciteit --}}
                <div>
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight">{{"Ingeschreven kinderen: ".$inschrijvingsdetails[0]->activiteit->aantalInschrijvingen."/".$inschrijvingsdetails[0]->activiteit->capaciteit}}</h3>
                </div>

                <table id="example" class="bootstrap-table" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th class="px-4 py-2">Inschrijvingsdatum</th>
                        <th class="px-4 py-2">Deelnemer voornaam , familienaam</th>
                        <th class="px-4 py-2">Ouder voornaam , familienaam</th>
                        <th class="px-4 py-2">Gekozen opties</th>
                        <th class="px-4 py-2">Allergie</th>
                        <th class="px-4 py-2">Beperking</th>
                        <th class="px-4 py-2">Medicatie</th>
                        <th class="px-4 py-2">Info animatoren</th>
                        <th class="px-4 py-2">Knoppen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($inschrijvingsdetails as $i)
                        @if(!$i->deleted_at)
                            <tr>
                                <td class="border px-4 py-2">{{Carbon\Carbon::parse($i->inschrijvingsdatum)->format('d-m-Y')}}</td>
                                <td class="border px-4 py-2">{{$i->kind->voornaam." , ".$i->kind->familienaam}}</td>
                                <td class="border px-4 py-2">{{ optional($i->kind->user->profiel)->voornaam." , ".optional($i->kind->user->profiel)->familienaam }}</td>
                                <td class="border px-4 py-2">
                                    @foreach($i->inschrijvingsdetail_opties as $detail_optie)
                                        {{$detail_optie->optie->omschrijving.": € ".$detail_optie->optie->prijs}}
                                    @endforeach</td>
                                <td class="border px-4 py-2">{{$i->kind->allergie}}</td>
                                <td class="border px-4 py-2">{{$i->kind->beperking}}</td>
                                <td class="border px-4 py-2">{{$i->kind->medicatie}}</td>
                                <td class="border px-4 py-2">{{$i->kind->infoAdminAnimator}}</td>
                                <td class="border px-4 py-2">
                                    <button
                                        class="rounded-md bg-gray-500 text-white focus:ring-gray-600 px-2 py-2 text-sm"
                                        onclick="window.location='{{ route("inschrijvingsdetails.show", $i->inschrijvingsdetails_id) }}'">
                                        {{ "details" }}
                                    </button>
                            </tr>
                        @endif
                    @endforeach

                    </tbody>
                </table>

            </div>


            {{--                TODO:: fix small screen colums--}}
            <div
                class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6 gap-4 gap-y-2 text-sm mt-4">
                {{-- Overzicht uitgeschreven kinderen --}}
                <div>
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight">{{"Uitgeschreven kinderen"}}</h3>
                </div>

                <div class=" px-6 py-6 grid gap-4 gap-y-2 text-sm grid-cols-2 md:grid-cols-4">

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
</x-app-layout>
