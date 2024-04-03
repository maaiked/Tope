<x-app-layout>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Activiteiten') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6">

                    {{--    enkel zichtbaar voor admin    --}}
                    <div>
                        @if (auth()->user()->isAdmin)
                            {{--    TODO:: knop om nieuwe activiteit aan te maken    --}}
                        @endif
                    </div>

                    {{--    zichtbaar voor iedereen    --}}
                    <div class="bg-white shadow-sm rounded-lg divide-y">
                        @foreach ($activiteiten as $activiteit)
                            <div class="p-2 flex space-x-0 grid-cols-6">

                                {{--    naam activiteit    --}}
                                <div class="flex-1">
                                    <p class="mt-4 text-lg text-gray-900">{{ $activiteit->naam}}</p>
                                </div>

                                {{--    start en eindtijd activiteit    --}}
                                <div class="flex-1">
                                    <p class="mt-4 text-md text-gray-900">{!!"van ".Carbon\Carbon::parse($activiteit->starttijd)->format('d-m-Y G\ui').
                                    "<br/>  tot ".Carbon\Carbon::parse($activiteit->eindtijd)->format('d-m-Y G\ui')!!}</p>
                                </div>

                                {{--    van leerjaar x tot leerjaar y    --}}
                                <div class="flex-1">
                                    <p class="mt-4 text-md text-gray-900">{{ $activiteit->leerjaarVanaf->value." tot ".$activiteit->leerjaarTot->value }}</p>
                                </div>

                                {{--    prijs activiteit    --}}
                                <div class="flex-1">
                                    <p class="mt-4 text-md text-gray-900">{{"€ ". $activiteit->prijs}}</p>
                                </div>

                                {{--    opties met prijs    --}}
                                <div class="flex-1">
                                    @foreach($activiteit->opties as $optie)
                                        <p class="mt-4 text-md text-gray-900">{{ $optie->omschrijving.": € ".$optie->prijs}}</p>
                                    @endforeach
                                </div>

                                {{--    locatie    --}}
                                <div class="flex-1">
                                    <p class="mt-4 text-md text-gray-900">{{ $activiteit->locatie->naam}}</p>
                                    <p class="mt-4 text-sm text-gray-900">{!!  $activiteit->locatie->straat.",</br> ".$activiteit->locatie->gemeente !!}</p>

                                </div>
                            </div>

                            @if (auth()->user()->isAdmin)
                                {{--    TODO:: knop om activiteit te bewerken    --}}
                            @endif

                        @endforeach
                    </div>


                    {{--    paginatie    --}}
                    {{ $activiteiten->links() }}

                </div>
            </div>
        </div>
    </x-app-layout>
