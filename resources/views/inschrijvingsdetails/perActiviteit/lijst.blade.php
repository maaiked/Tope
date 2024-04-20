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
                <div class="max-w-7xl mx-auto py-2 px-2 sm:px-2 lg:px-2">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Lijst ').$lijstnaam }}
                    </h2>
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">{{$inschrijvingen->first()->activiteit->naam." : ".Carbon\Carbon::parse($inschrijvingen->first()->activiteit->starttijd)->format('d-m-Y')." ".$inschrijvingen->first()->activiteit->locatie->naam}}</h3>
                </div>
        </header>


            <div class="max-w-7xl mx-auto sm:px-2 lg:px-2">
                <div class="p-3 sm:p-3 bg-white sm:rounded-lg mt-2">
                    {{-- Knop terug --}}
                    <button class=" rounded-md bg-blue-500 text-white focus:ring-gray-600 px-2 py-2 text-sm"
                            onclick="window.history.back()">Terug naar overzicht lijsten
                    </button>
                    {{-- Knop Afdrukken --}}
                    <button class=" rounded-md bg-gray-500 text-white focus:ring-gray-600 px-2 py-2 text-sm"
                            onclick="window.print()">Afdrukken
                    </button>

                     @switch($lijstnaam)
                        @case ("alle kinderen")
                            {{-- Lijst ingeschreven kinderen --}}
                            <div>
                                @include('inschrijvingsdetails.perActiviteit.partials.alleKinderen')
                            </div>
                            @break
                        @case ("aanwezige kinderen")
                            {{-- Lijst aanwezige kinderen --}}
                            <div>
                                @include('inschrijvingsdetails.perActiviteit.partials.aanwezigeKinderen')
                            </div>
                            @break
                        @case ("medische gegevens")
                            {{-- Lijst aanwezige kinderen --}}
                            <div>
                                @include('inschrijvingsdetails.perActiviteit.partials.medischAlles')
                            </div>
                            @break
                        @case ("medicatie")
                            {{-- Lijst aanwezige kinderen --}}
                            <div>
                                @include('inschrijvingsdetails.perActiviteit.partials.medicatie')
                            </div>
                            @break
                        @case ("allergieën")
                            {{-- Lijst aanwezige kinderen --}}
                            <div>
                                @include('inschrijvingsdetails.perActiviteit.partials.allergie')
                            </div>
                            @break
                        @case ("opties")
                            {{-- Lijst kinderen per optie --}}
                            <div>
                                @include('inschrijvingsdetails.perActiviteit.partials.opties')
                            </div>
                            @break
                        @case ("alle kinderen met contactgegevens")
                            {{-- Lijst kinderen met contactgegevens --}}
                            <div>
                                @include('inschrijvingsdetails.perActiviteit.partials.alleContact')
                            </div>
                            @break
                    @endswitch
                </div>

            </div>

    </div>
</body>
</html>
