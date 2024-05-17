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


            {{--    zichtbaar voor niet admin    --}}
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg mx-6 my-6 mt-4 px-4 py-4">

                @if (!auth()->user()->isAdmin)
{{--                    als profiel is aangemaakt, maak inschrijven mogelijk--}}
                    @if(!empty(Auth::user()->profiel()->first()))
                        {{--    selecteer kind    --}}
                        <style>
                            input:checked + label {
                                border-color: black;
                                background-color: lightgreen;
                                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                            }
                        </style>

                        <div class="grid md:grid-cols-4 gap-2 w-full max-w-screen-sm vertical-align:middle">
                            <div><span class="text-md font-semibold uppercase">Selecteer kind: </span>
                                <button class="text-sm font-semibold underline"
                                        onclick="window.location='{{ route("activiteiten.index") }}'">Wis selectie
                                </button>
                            </div>
                            {{-- maak radioveld aan voor elk kind --}}
                            @foreach(auth()->user()->kinds()->get() as $kind)
                                <div class="md:col-span-1">
                                    <input class="hidden" id="{{ $kind->id }}" type="radio" name="kinderen"
                                           value="{{ $kind->id }}"
                                           @if (optional($geselecteerdkind)->id == $kind->id) checked="checked" @endif
                                           onclick="window.location='{{ route("activiteiten.index", $kind->id) }}'">
                                    <label class="flex flex-col p-4 border-2 border-gray-400 cursor-pointer"
                                           for="{{ $kind->id }}">
                                        <span class="text-xs font-semibold uppercase">{{ $kind->voornaam}}</span>
                                        <span
                                            class="text-xs font-semibold">{{ $kind->leerjaar->label()}}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
{{--                         als profiel nog niet werd aangemaakt, toon melding--}}
                    @else
                        <p class="text-red-600">Je kan pas een kind inschrijven als je profiel werd aangevuld.
                        </p>
                        <a href="{{ route('profiel.create') }}" class="underline">Ga naar profiel</a>
                    @endif

                @endif
            </div>

            {{--    toon activiteiten    --}}
            @foreach ($activiteiten as $activiteit)
            <form method="POST" action="{{ route('inschrijvingsdetail.store') }}">
                @csrf
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mx-6 my-6 mt-4 px-4 py-4">

                        <div class="p-2 flex space-x-0 grid-cols-3 md:grid-cols-5 ">
                            {{--    TODO:: aanpassen naar kleine schermen    --}}

                            {{--    naam activiteit + naam locatie   --}}
                            <div class="flex-1">
                                <p class="mt-4 text-lg text-gray-900">{{ $activiteit->naam}}</p>
                                <p class="mt-4 text-sm text-gray-900">{{ $activiteit->locatie->naam}}</p>
                                <input type="hidden" name="activiteit" value="{{ $activiteit->id }}" />
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
                                <input type="hidden" name="prijs" value="{{ $activiteit->prijs }}" />
                                @foreach($activiteit->opties as $optie)
                                    <p>{{ $optie->omschrijving.": € ".$optie->prijs}}</p>
                                @endforeach
                            </div>

                            {{--    knop 'info' + knop 'inschrijven'    --}}
                            <div class="flex-1 items-center vertical-align: middle;">

                                @if(empty($geselecteerdkind))
                                    <p>Selecteer een kind om in te schrijven</p>
                                @elseif(!empty($activiteit->inschrijvingsdetails()->where('kind_id', '=',$geselecteerdkind->id)->first()))
                                    <p>&#9989; ingeschreven</p>
                                @elseif($activiteit->inschrijvenVanaf >= today())
                                    <p class="text-sm font-bold">{!!"Inschrijven kan vanaf ".Carbon\Carbon::parse($activiteit->inschrijvenVanaf)->format('d-m-Y')!!}</p>
                                @elseif($activiteit->inschrijvenTot < today())
                                    <p class="text-sm">{!!"Inschrijving is afgelopen sinds ".Carbon\Carbon::parse($activiteit->inschrijvenTot)->format('d-m-Y')!!}</p>
                                @elseif($activiteit->aantalInschrijvingen >= $activiteit->capaciteit)
                                    <p class="text-sm font-bold">VOLZET</p>
                                @else
                                    <input type="hidden" name="kindid" value="{{ $geselecteerdkind->id }}">
                                   <p class="rounded-md bg-blue-600 text-white focus:ring-blue-400 px-4 py-2 text-sm"
                                       onclick="show({{$activiteit->id}})">Inschrijven</p>
                                    <!-- Modal -->
                                    <div id="confirm.{{$activiteit->id}}" class="fixed z-10 inset-0 overflow-y-auto hidden">
                                        <div class="flex items-center justify-center min-h-screen">
                                            <div class="bg-gray-200 w-1/2 p-6 rounded shadow-md">
                                                <div class="flex justify-end">
                                                    <!-- Close Button -->
                                                    <p id="close" onclick="hide({{$activiteit->id}})"
                                                            class="text-gray-700 hover:text-red-500">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                             viewBox="0 0 24 24"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </p>
                                                </div>
                                                <div class="content-center">
                                                    <p class="px-2 py-2">Wil je deze inschrijving bevestigen? </p>
                                                    <p class="px-2 py-2 font-bold">{{ $activiteit->naam." : ".$geselecteerdkind->voornaam." ".$geselecteerdkind->familienaam  }}</p>
                                                    <p>Selecteer je gewenste opties:</p>
                                                    @foreach($activiteit->opties as $optie)
                                                            <div>
                                                                <input type="checkbox" name={{$optie->omschrijving}} id={{$optie->omschrijving}} class="checkbox" value="{{$optie->prijs}}" />
                                                                <label for="{{$optie->omschrijving}}" class=" text-md text-gray-900">
                                                                    {{ $optie->omschrijving.": € ".$optie->prijs}}</label>
                                                            </div>
                                                    @endforeach
                                                    <button
                                                        class="rounded-md bg-blue-600 text-white focus:ring-blue-400 px-2 py-2 mt-4 text-sm"
                                                        type="submit" name="action" value="inschrijven">
                                                        bevestigen
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <button
                                    class="rounded-md bg-gray-500 text-white focus:ring-gray-600 px-4 py-2 text-sm mt-4"
                                    type="submit" name="action" value="info">
                                    meer info
                                </button>
                            </div>
                        </div>

                        @if (auth()->user()->isAdmin)
                            {{--    TODO:: knop om activiteit te bewerken    --}}
                    <button onclick="window.location='{{ route("activiteiten.edit", $activiteit->id) }}'"
                    class="col-span-1  inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative">
                    ></button>
                        @endif
                    </div>
            </form>
            @endforeach

                {{--    paginatie    --}}
                {{ $activiteiten->links() }}

            </div>
        </div>
    <script>

        // JavaScript to toggle the modal

        function show(id) {
            var name = "confirm.".concat(id);
            var modal = document.getElementById(name);
            modal.classList.remove('hidden');
        }

        function hide(id) {
            var name = "confirm.".concat(id);
            var modal = document.getElementById(name);
            modal.classList.add('hidden');
        }


    </script>

</x-app-layout>
