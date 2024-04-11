<x-app-layout>


        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Activiteiten') }}
            </h2>
        </x-slot>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                {{--    enkel zichtbaar voor admin    --}}
                <div>
                    @if (auth()->user()->isAdmin)
                        {{--    TODO:: knop om nieuwe activiteit aan te maken    --}}
                    @endif
                </div>


                {{--    zichtbaar voor iedereen    --}}
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg mx-6 my-6 mt-4 px-4 py-4">

                    {{--    selecteer kind    --}}
                    <style>
                        input:checked + label {
                            border-color: black;
                            background-color: lightgreen;
                            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                        }
                    </style>

                        <div class="grid md:grid-cols-4 gap-2 w-full max-w-screen-sm vertical-align:middle">
                             <span class="text-md font-semibold uppercase">Selecteer kind: </span>
                            @foreach(auth()->user()->kinds()->get() as $kind)
                                <div class="md:col-span-1">
                                    <input class="hidden" id="{{ $kind->id }}" type="radio" name="kinderen" value="{{ $kind->id }}"
                                           @if (optional($geselecteerdkind)->id == $kind->id) checked="checked" @endif
                                           onclick="window.location='{{ route("activiteiten.index", $kind->id) }}'">
                                    <label class="flex flex-col p-4 border-2 border-gray-400 cursor-pointer"
                                           for="{{ $kind->id }}">
                                        <span class="text-xs font-semibold uppercase">{{ $kind->voornaam}}</span>
                                        <span
                                            class="text-xs font-semibold">{{ $kind->leerjaar->value}}</span>
                                    </label>
                                </div>
                            @endforeach
                            <div class="md:col-span-1">
                                <input class="hidden" id="geenfilter" type="radio" name="kinderen" value=""
                                       onclick="window.location='{{ route("activiteiten.index") }}'">
                                <label class="flex flex-col p-4 border-2 border-gray-400 cursor-pointer"
                                       for="geenfilter">
                                    <span class="text-xs font-semibold uppercase">selectie wissen</span>
                                </label>
                            </div>
                        </div>

                </div>

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
                                <p class="mt-4 text-md text-gray-900">{{ $activiteit->leerjaarVanaf->value." tot ".$activiteit->leerjaarTot->value }}</p>
                            </div>

                            {{--    prijs activiteit + opties   --}}
                            <div class="flex-1">
                                <p class="mt-4 text-md text-gray-900 font-bold">{{"€ ". $activiteit->prijs}}</p>
                                @foreach($activiteit->opties as $optie)
                                    <div>
                                        <input type="checkbox" name={{$optie->omschrijving}} id={{$optie->omschrijving}}
                                               class="checkbox" value="{{$optie->prijs}}"/>
                                        <label for="{{$optie->omschrijving}}" class=" text-md text-gray-900">
                                            {{ $optie->omschrijving.": € ".$optie->prijs}}</label>
                                    </div>
                                @endforeach
                            </div>

                            {{--    knop 'info' + knop 'inschrijven'    --}}
                            <div class="flex-1 items-center vertical-align: middle;">
                                @if($geselecteerdkind == null)
                                    <p>Selecteer een kind om in te schrijven</p>
                                @elseif($activiteit->inschrijvenVanaf >= today())
                                    <p class="text-sm font-bold">{!!"Inschrijven kan vanaf ".Carbon\Carbon::parse($activiteit->inschrijvenVanaf)->format('d-m-Y')!!}</p>
                                @elseif($activiteit->inschrijvenTot < today())
                                    <p class="text-sm">{!!"Inschrijving is afgelopen sinds ".Carbon\Carbon::parse($activiteit->inschrijvenTot)->format('d-m-Y')!!}</p>
                                @elseif($activiteit->aantalInschrijvingen >= $activiteit->capaciteit)
                                    <p class="text-sm font-bold">VOLZET</p>
                                @else
                                    <button
                                        class="rounded-md bg-blue-600 text-white focus:ring-blue-400 px-4 py-2 text-sm"
                                        onclick="window.location='{{ route("activiteiten.show", $activiteit->id) }}'">
                                        inschrijven
                                    </button>
                                @endif
                                <button
                                    class="rounded-md bg-gray-500 text-white focus:ring-gray-600 px-4 py-2 text-sm mt-4"
                                    onclick="window.location='{{ route("activiteiten.show", $activiteit->id) }}'">
                                    meer info
                                </button>
                            </div>
                        </div>

                        @if (auth()->user()->isAdmin)
                            {{--    TODO:: knop om activiteit te bewerken    --}}
                        @endif
                    </div>
                @endforeach

                {{--    paginatie    --}}
                {{ $activiteiten->links() }}

            </div>
        </div>

</x-app-layout>
