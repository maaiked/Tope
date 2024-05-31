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
                <button onclick="window.location='{{ route("activiteiten.create") }}'"
                class="col-span-1  inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative">
                Activiteit toevoegen</button>
                @endif
            </div>
            {{--    toon activiteiten    --}}
            @foreach ($activiteiten as $activiteit)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mx-6 my-6 mt-4 px-4 py-4">
                    <form method="POST" action="{{ route('inschrijvingsdetail.store') }}">
                        @csrf
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

                        {{--    knop 'info'  --}}
                        <div class="flex-1 items-center vertical-align: middle;">
                            <button
                                class="rounded-md bg-gray-500 text-white focus:ring-gray-600 px-4 py-2 text-sm mt-4"
                                type="submit" name="action" value="info">
                                meer info
                            </button>
                        </div>
                    </div>
                    </form>
                    @if (auth()->user()->isAdmin)
                    <button onclick="window.location='{{ route("activiteiten.edit", $activiteit->id) }}'"
                    class="col-span-1  inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative">
                    Aanpassen</button>
                    @endif
                </div>
            @endforeach

            {{--    paginatie    --}}
            {{ $activiteiten->links() }}

        </div>
    </div>
</x-app-layout>
