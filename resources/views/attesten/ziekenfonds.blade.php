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


    {{--   Gebaseerd op https://spatie.be/docs/laravel-pdf/v1/advanced-usage/using-tailwind--}}

    <div class="px-2 py-8 max-w-xl mx-auto">
        {{-- Knop Afdrukken --}}
        <button class=" rounded-md bg-gray-500 text-white focus:ring-gray-600 px-2 py-2 text-sm"
                onclick="window.print()">Afdrukken
        </button>

        {{--    TODO:: aanpassen naar kleine schermen    --}}

        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="text-gray-700 font-semibold text-2xl">Bewijs van deelname</div>
            </div>
            <div class="text-gray-700">
                <div class="font-bold text-xl mb-2 uppercase">Attest opgemaakt</div>
                <div class="text-sm">{{ "Datum: ".Carbon\Carbon::parse(today())->format('d-m-Y') }}</div>
                <div class="text-sm">{{ "Te: ".$inschrijving->activiteit->locatie->gemeente }}</div>
            </div>

        </div>

        @if(!$inschrijving->ingechecked)
            <p class=" text-md text-gray-900">Oeps, dit attest kan niet aangemaakt worden.<br>
                Een attest kan enkel aangemaakt worden als de deelnemer aanwezig was. <br>
                Was jouw kind aanwezig en denk je dat deze boodschap foutief is? <br>
                Neem contact op met de organisatie om dit na te kijken.</p>
        @else

            {{--    kind   --}}
            <div>
                <p class="mt-4 text-md text-gray-900 font-bold">Deelnemer</p>
                <p class=" text-md text-gray-900">{{ "Voornaam: ".$inschrijving->kind->voornaam }}</p>
                <p class=" text-md text-gray-900">{{ "Familienaam: ".$inschrijving->kind->familienaam }}</p>
                <p class=" text-md text-gray-900">{{ "Rijksregisternummer: ".$inschrijving->kind->rijksregisternummer }}</p>
            </div>

            {{--    organisatie   --}}
            <div>
                <p class="mt-4 text-md text-gray-900 font-bold">Organisatie</p>
                <p class=" text-md text-gray-900">{{ "Naam organisatie: Speelpleinwerking X" }}</p>
                <p class=" text-md text-gray-900">{{ "Telefoonnummer: 0404 / 00.00.00 " }}</p>
                <p class=" text-md text-gray-900">{{ "Mailadres: info@speelpleinwerkingX.be " }}</p>
            </div>

            {{--    details inschrijving   --}}
            <div class="col-span-1">
                <p class="mt-4 text-lg text-gray-900 font-bold">Activiteit</p>
                <p class=" text-md text-gray-900 ">{{ "Naam activiteit: ".$inschrijving->activiteit->naam}}</p>
                <p class=" text-md text-gray-900">{!!"van ".Carbon\Carbon::parse($inschrijving->activiteit->starttijd)->format('d-m-Y G\ui')!!}</p>
                <p class="text-md text-gray-900">{!!" tot ".Carbon\Carbon::parse($inschrijving->activiteit->eindtijd)->format('d-m-Y G\ui')!!}</p>
                <p class=" text-md text-gray-900">{{ "Locatie: ".$inschrijving->activiteit->locatie->naam}}</p>
                <p class=" text-sm text-gray-900">{{ $inschrijving->activiteit->locatie->straat}}</p>
                <p class=" text-sm text-gray-900">{{ $inschrijving->activiteit->locatie->gemeente}}</p>
            </div>

            {{--    betaald bedrag + opties  --}}
            <div class="border-b-2 border-gray-300 pb-8 mb-8">
                <p class="mt-4 text-md text-gray-900 font-bold">Betaling:</p>
                <p class=" text-md text-gray-900 font-bold">{{"€ ". $inschrijving->prijs}}</p>
                @foreach($inschrijving->inschrijvingsdetail_opties as $detail_optie)
                    <div>
                        <p class=" text-md text-gray-900">
                            {{"inclusief optie: ". $detail_optie->optie->omschrijving.": € ".$detail_optie->optie->prijs}}</p>
                    </div>
                @endforeach
                @if($inschrijving->betalingsdetail)
                    <p class=" text-md text-gray-900 ">{{ "Betaald op: ".$inschrijving->betalingsdetail->datum}}</p>
                @else
                    <p class=" text-md text-red-600 ">{{ "! Deze betaling is nog niet ontvangen !"}}</p>
                @endif
            </div>
            <div class="border-b-2 border-gray-300 pb-8 mb-8 mt-4">
                <h3 class="text-l font-bold mb-4">Info:</h3>
                <div class="text-gray-700 mb-2">Dien dit attest in bij je ziekenfonds voor een (gedeeltelijke) teruggave van inschrijvingsgeld voor deelname aan speelpleinwerking.</div>
            </div>
        @endif
    </div>

</div>

</div>
</body>
</html>

