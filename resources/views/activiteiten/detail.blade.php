<x-app-layout>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Activiteit '. $activiteit->naam) }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6">

                    {{--    enkel zichtbaar voor admin    --}}
                    <div>
                        @if (auth()->user()->isAdmin)
                            {{--    TODO:: knop om activiteit aan te passen    --}}
                        @endif
                    </div>

                    {{--    zichtbaar voor iedereen    --}}
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2 px-3 py-3">
                                {{--    TODO:: aanpassen naar kleine schermen    --}}

                                {{--    naam activiteit   --}}
                                <div class="col-span-1">
                                    <p class="mt-4 text-lg text-gray-900 font-bold">{{ $activiteit->naam}}</p>
                                </div>
                                <div class="col-span-1">
                                    <p class="mt-4 text-md text-gray-900 ">{{ "id: ".$activiteit->id}}</p>
                                </div>

                                {{--    omschrijving activiteit   --}}
                                <div class="col-span-2">
                                    <p class="mt-4 text-md text-gray-900">{{ $activiteit->omschrijving}}</p>
                                </div>

                                {{--    locatie activiteit   --}}
                                <div class="col-span-1">
                                    <p class="mt-4 text-md text-gray-900 font-bold">Locatie:</p>
                                </div>
                                <div class="col-span-1">
                                    <p class="mt-4 text-md text-gray-900">{{ $activiteit->locatie->naam}}</p>
                                    <p class=" text-sm text-gray-900">{{ $activiteit->locatie->straat}}</p>
                                    <p class=" text-sm text-gray-900">{{ $activiteit->locatie->gemeente}}</p>
                                </div>

                                {{--    start en eindtijd activiteit    --}}
                                <div class="col-span-1">
                                    <p class="mt-4 text-md text-gray-900 font-bold">Datum:</p>
                                </div><div class="col-span-1">
                                    <p class="mt-4 text-md text-gray-900">{!!"van ".Carbon\Carbon::parse($activiteit->starttijd)->format('d-m-Y G\ui')!!}</p>
                                    <p class="text-md text-gray-900">{!!" tot ".Carbon\Carbon::parse($activiteit->eindtijd)->format('d-m-Y G\ui')!!}</p>
                                </div>

                                {{--    van leerjaar x tot leerjaar y    --}}
                                <div class="col-span-1">
                                    <p class="mt-4 text-md text-gray-900 font-bold">Leeftijd:</p>
                                </div><div class="col-span-1">
                                    <p class="mt-4 text-md text-gray-900">{{ $activiteit->leerjaarVanaf->label()." tot ".$activiteit->leerjaarTot->label() }}</p>
                                </div>

                                {{--    prijs activiteit + opties   --}}
                                <div class="col-span-1">
                                    <p class="mt-4 text-md text-gray-900 font-bold">Prijs:</p>
                                </div><div class="col-span-1">
                                    <p class="mt-4 text-md text-gray-900 font-bold">{{"€ ". $activiteit->prijs}}</p>
                                    @foreach($activiteit->opties as $optie)
                                        <div>
                                            <p class="text-md text-gray-900 ">{{ $optie->omschrijving.": € ".$optie->prijs}}</p>
                                        </div>
                                    @endforeach
                                </div>

                                {{--    inschrijven vanaf    --}}
                                <div class="col-span-1">
                                    <p class="mt-4 text-md text-gray-900 font-bold">Inschrijven kan vanaf:</p>
                                </div><div class="col-span-1">
                                    <p class="mt-4 text-md text-gray-900">{!!Carbon\Carbon::parse($activiteit->inschrijvenVanaf)->format('d-m-Y')!!}</p>
                                </div>

                                {{--    inschrijven tot    --}}
                                <div class="col-span-1">
                                    <p class="mt-4 text-md text-gray-900 font-bold">Inschrijven kan tot en met:</p>
                                </div><div class="col-span-1">
                                    <p class="mt-4 text-md text-gray-900">{!!Carbon\Carbon::parse($activiteit->inschrijvenTot)->format('d-m-Y')!!}</p>
                                </div>

                                {{--    annuleren tot    --}}
                                <div class="col-span-1">
                                    <p class="mt-4 text-md text-gray-900 font-bold">Annuleren kan tot en met:</p>
                                </div><div class="col-span-1">
                                    <p class="mt-4 text-md text-gray-900">{!!Carbon\Carbon::parse($activiteit->annulerenTot)->format('d-m-Y')!!}</p>
                                </div>

                                {{--    capaciteit    --}}
                                <div class="col-span-1">
                                    <p class="mt-4 text-md text-gray-900 font-bold">Inschrijvingen:</p>
                                </div><div class="col-span-1">
                                    <p class="mt-4 text-md text-gray-900">{{ $activiteit->aantalInschrijvingen." / ".$activiteit->capaciteit }}</p>
                                </div>

                            </div>


                </div>
            </div>
        </div>
    </x-app-layout>
