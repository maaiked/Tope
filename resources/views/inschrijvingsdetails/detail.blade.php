<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail inschrijving') }}
        </h2>
    </x-slot>
    <div class="p-3 sm:p-3 bg-white sm:rounded-lg mt-2">
        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2 px-3 py-3">
            {{--    TODO:: aanpassen naar kleine schermen    --}}

            {{--    details inschrijving   --}}
            <div class="col-span-1">
                <p class="mt-4 text-lg text-gray-900 font-bold">Inschrijving</p>
                <p class=" text-md text-gray-900 ">{{ "activiteitsid: ".$inschrijving->activiteit->id}}</p>
                <p class=" text-md text-gray-900 ">{{ "inschrijvingsid: ".$inschrijving->id}}</p>
            </div>

            {{--    kind   --}}
            <div class="col-span-1">
                <p class="mt-4 text-md text-gray-900 font-bold">Kind:</p>
                <p class=" text-md text-gray-900">{{ $inschrijving->kind->voornaam." ".$inschrijving->kind->familienaam}}</p>
            </div>

            {{--    inschrijfdatum   --}}
            <div class="col-span-1">
                <p class="mt-4 text-md text-gray-900 font-bold">Ingeschreven op:</p>
                <p class=" text-md text-gray-900">{{ Carbon\Carbon::parse($inschrijving->inschrijvingsdatum)->format('d-m-Y') }}</p>
            </div>

            {{--    annuleren mogelijk tot   --}}
            <div class="col-span-1">
                <p class="mt-4 text-md text-gray-900 font-bold">Annuleren mogelijk tot:</p>
                <p class=" text-md text-gray-900">{{ Carbon\Carbon::parse($inschrijving->annulerenTot)->format('d-m-Y G\ui') }}</p>
            </div>

            {{--    betaald bedrag   --}}
            <div class="col-span-1">
                <p class="mt-4 text-md text-gray-900 font-bold">Betaald:</p>
                <p class=" text-md text-gray-900 font-bold">{{"€ ". $inschrijving->prijs}}</p>
            </div>

            {{--    prijs activiteit + opties   --}}
            <div class="col-span-1">
                <p class="mt-4 text-md text-gray-900 font-bold">Standaardprijs activiteit:</p>
                <p class=" text-md text-gray-900 font-bold">{{"€ ". $inschrijving->activiteit->prijs}}</p>
                @foreach($inschrijving->inschrijvingsdetail_opties as $detail_optie)
                    <div>
                        <p class=" text-md text-gray-900">
                            {{ $detail_optie->optie->omschrijving.": € ".$detail_optie->optie->prijs}}</p>
                    </div>
                @endforeach
            </div>

            {{--    activiteit naam   --}}
            <div class="col-span-1">
                <p class="mt-4 text-md text-gray-900 font-bold">Naam activiteit:</p>
                <p class=" text-md text-gray-900">{{ $inschrijving->activiteit->naam}}</p>
            </div>

            {{--    van leerjaar x tot leerjaar y    --}}
            <div class="col-span-1">
                <p class="mt-4 text-md text-gray-900 font-bold">Leeftijd activiteit:</p>
                <p class=" text-md text-gray-900">{{ $inschrijving->activiteit->leerjaarVanaf->label()." tot ".$inschrijving->activiteit->leerjaarTot->label() }}</p>
            </div>

            {{--    locatie activiteit   --}}
            <div class="col-span-1">
                <p class="mt-4 text-md text-gray-900 font-bold">Locatie activiteit:</p>
                <p class=" text-md text-gray-900">{{ $inschrijving->activiteit->locatie->naam}}</p>
                <p class=" text-sm text-gray-900">{{ $inschrijving->activiteit->locatie->straat}}</p>
                <p class=" text-sm text-gray-900">{{ $inschrijving->activiteit->locatie->gemeente}}</p>
            </div>

            {{--    start en eindtijd activiteit    --}}
            <div class="col-span-1">
                <p class="mt-4 text-md text-gray-900 font-bold">Datum activiteit:</p>
                <p class=" text-md text-gray-900">{!!"van ".Carbon\Carbon::parse($inschrijving->activiteit->starttijd)->format('d-m-Y G\ui')!!}</p>
                <p class="text-md text-gray-900">{!!" tot ".Carbon\Carbon::parse($inschrijving->activiteit->eindtijd)->format('d-m-Y G\ui')!!}</p>
            </div>

            {{--    als activiteit afgelopen is, toon onderstaande velden    --}}
            @if($inschrijving->activiteit->eindtijd < today())
                {{--    ingecheckt   --}}
                <div class="col-span-1">
                    <p class="mt-4 text-md text-gray-900 font-bold">Deelgenomen:</p>
                    @if( $inschrijving->ingechecked)
                        <p class=" text-md text-gray-900">aanwezig</p>
                    @else
                        <p>afwezig</p>
                    @endif
                </div>

                {{--    attesten   --}}
                <div class="col-span-1">
                    <p class="mt-4 text-md text-gray-900 font-bold">Attesten:</p>

                    @if( $inschrijving->ingechecked)
                        @if( !empty($inschrijving->fiscaalAttest))
                            <p class=" text-md text-gray-900"> {{ "fiscaal attest beschikbaar sinds: ". Carbon\Carbon::parse($inschrijving->deelnemersattestVerzonden)->format('d-m-Y') }}</p>
                        @else
                            <p>Fiscaal attest nog niet beschikbaar</p>
                        @endif
                        @if( !empty($inschrijving->ziekenfondsAttest))
                            <a href="{{ route("inschrijvingsdetails.ziekenfondsattest", $inschrijving->id) }} "
                               target="_blank" class="underline">Ziekenfondsattest</a>
                        @else
                            <p>Ziekenfondsattest nog niet beschikbaar</p>
                        @endif
                    @else
                        <p>{{ "Attesten zijn beschikbaar voor deelnemers die aanwezig waren op de activiteit. Je kind was (nog) niet aanwezig." }}</p>
                    @endif

                </div>

            @else
            <p>{{ 'Na afloop van de activiteit vind je hier je attest terug' }}</p>
            @endif
        </div>
    </div>
</x-app-layout>
