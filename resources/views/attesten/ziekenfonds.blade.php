<!-- Aparte lay-out zodat afdrukvoorbeeld zo clean mogelijk is -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tope') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-2 lg:px-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ "Ziekenfondsattest" }}
            </h2>
        </div>
    </header>

    <div class="px-4 py-4 sm:p-3 bg-white sm:rounded-lg m-4 ">

        {{-- Knop Afdrukken --}}
        <button class=" rounded-md bg-gray-500 text-white focus:ring-gray-600 px-2 py-2 text-sm"
                onclick="window.print()">Afdrukken
        </button>

            {{--    TODO:: aanpassen naar kleine schermen    --}}


            @if(!$inschrijving->ingechecked)
                <p class=" text-md text-gray-900">Oeps, dit attest kan niet aangemaakt worden.<br>
                Een attest kan enkel aangemaakt worden als de deelnemer aanwezig was.</p>
            @else
                <p>afwezig</p>
            @endif


        {{--    kind   --}}
        <div>
            <p class="mt-4 text-md text-gray-900 font-bold">Deelnemer</p>
            <p class=" text-md text-gray-900">{{ "Voornaam: ".$inschrijving->kind->voornaam }}</p>
            <p class=" text-md text-gray-900">{{ "Familienaam: ".$inschrijving->kind->familienaam }}</p>
            <p class=" text-md text-gray-900">{{ "Rijksregisternummer: ".$inschrijving->kind->rijksregisternummer }}</p>
        </div>

            {{--    details inschrijving   --}}
            <div class="col-span-1">
                <p class="mt-4 text-lg text-gray-900 font-bold">Inschrijving</p>
                <p class=" text-md text-gray-900 ">{{ "activiteitsid: ".$inschrijving->activiteit->id}}</p>
                <p class=" text-md text-gray-900 ">{{ "inschrijvingsid: ".$inschrijving->id}}</p>
            </div>



            {{--    inschrijfdatum   --}}
            <div class="col-span-1">
                <p class="mt-4 text-md text-gray-900 font-bold">Ingeschreven op:</p>
                <p class=" text-md text-gray-900">{{ Carbon\Carbon::parse($inschrijving->inschrijvingsdatum)->format('d-m-Y') }}</p>
            </div>

            {{--    betaald bedrag + opties  --}}
            <div class="col-span-1">
                <p class="mt-4 text-md text-gray-900 font-bold">Betaald:</p>
                <p class=" text-md text-gray-900 font-bold">{{"€ ". $inschrijving->prijs}}</p>
                @foreach($inschrijving->inschrijvingsdetail_opties as $detail_optie)
                    <div>
                        <p class=" text-md text-gray-900">
                            {{"inclusief optie: ". $detail_optie->optie->omschrijving.": € ".$detail_optie->optie->prijs}}</p>
                    </div>
                @endforeach
            </div>

            {{--    activiteit naam   --}}
            <div class="col-span-1">
                <p class="mt-4 text-md text-gray-900 font-bold">Naam activiteit:</p>
                <p class=" text-md text-gray-900">{{ $inschrijving->activiteit->naam}}</p>
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


        </div>

</div>
</body>
</html>

