<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Activiteiten van vandaag') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg mx-6 my-6 mt-4 px-4 py-4">

                {{--    toon activiteiten    --}}
                @foreach ($activiteiten as $activiteit)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mx-6 my-6 mt-4 px-4 py-4">

                        <div class="p-2 flex space-x-0 grid-cols-3 md:grid-cols-5 ">
                            {{--    TODO:: aanpassen naar kleine schermen    --}}

                            {{--    naam activiteit + naam locatie   --}}
                            <div class="flex-1">
                                <p class="mt-4 text-lg text-gray-900">{{ $activiteit->naam}}</p>
                                <p class="mt-4 text-sm text-gray-900">{{ $activiteit->locatie->naam}}</p>
                            </div>

                            {{--    start en eindtijd activiteit    --}}
                            <div class="flex-1">
                                <p class="mt-4 text-md text-gray-900">{!!"van ".Carbon\Carbon::parse($activiteit->starttijd)->format('d-m-Y G\ui')!!}</p>
                                <p class="mt-4 text-md text-gray-900">{!!" tot ".Carbon\Carbon::parse($activiteit->eindtijd)->format('d-m-Y G\ui')!!}</p>
                            </div>

                            {{--    van leerjaar x tot leerjaar y    --}}
                            <div class="flex-1">
                                <p class="mt-4 text-md text-gray-900">{{ $activiteit->leerjaarVanaf->label()." tot ".$activiteit->leerjaarTot->label() }}</p>
                            </div>

                            {{--    prijs activiteit + opties   --}}
                            <div class="flex-1">
                                <p class="mt-4 text-md text-gray-900 font-bold">{{"€ ". $activiteit->prijs}}</p>
                                @foreach($activiteit->opties as $optie)
                                    <p>{{ $optie->omschrijving.": € ".$optie->prijs}}</p>
                                @endforeach
                            </div>

                            {{--    knop 'info' + 'inschrijvingen' --}}
                            <div class="flex-1 items-center vertical-align: middle;">

                                <button onclick="window.location='{{ route("activiteiten.show", $activiteit->id) }}'"
                                        class="rounded-md bg-gray-500 text-white focus:ring-gray-600 px-4 py-2 text-sm mt-4">
                                    meer info
                                </button>

                                <button onclick="window.location='{{ route("inschrijvingsdetails.indexActiviteit", $activiteit->id) }}'"
                                        class="rounded-md bg-blue-500 text-white focus:ring-gray-600 px-4 py-2 text-sm mt-4">
                                    inschrijvingen
                                </button>


                            </div>
                        </div>


                    </div>

                @endforeach
            </div>
            {{--    paginatie    --}}
            {{ $activiteiten->links() }}
            </div>
        </div>

</x-app-layout>
