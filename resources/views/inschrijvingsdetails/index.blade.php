<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jouw inschrijvingen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status') === 'inschrijving-verwijderd')
                <p class="text-lg py-4 px-4 text-md font-bold underline text-red-600"
                ><i>{{ __('Inschrijving werd geannuleerd.') }}</i></p>
            @endif

{{--                TODO:: fix small screen colums--}}
               <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6 grid gap-4 gap-y-2 text-sm grid-cols-2 md:grid-cols-5">

                {{-- kolomtitels --}}
                <div class="flex space-x-0">
                    <p class="mt-4 text-lg text-gray-900">Inschrijvingsdatum</p>
                </div>
                <div class="flex space-x-0">
                    <p class="mt-4 text-lg text-gray-900">Deelnemer</p>
                </div>
                <div class="flex space-x-0">
                    <p class="mt-4 text-lg text-gray-900">Activiteit</p>
                </div>
                <div class="flex space-x-0">
                    <p class="mt-4 text-lg text-gray-900">Totaalprijs</p>
                </div>
                <div class="flex space-x-0">
                    <p class="mt-4 text-lg text-gray-900">Knoppen</p>
                </div>

                {{--                TODO: inschrijvingen sorteren op datum inschrijving of activiteit? groeperen per jaar > vakantieperiode? filters toevoegen?--}}


                {{-- rijen --}}
                @foreach ($inschrijvingsdetails as $inschrijvingsdetail)

                    {{--    inschrijvingsdatum    --}}
                    <div class="flex space-x-0">
                        <p class="mt-2 text-md text-gray-900">{{ Carbon\Carbon::parse($inschrijvingsdetail->inschrijvingsdatum)->format('d-m-Y')}}</p>
                    </div>

                    {{--    voornaam + familienaam kind    --}}
                    <div class="flex space-x-0">
                        <p class="mt-2 text-md text-gray-900">{{ $inschrijvingsdetail->kind->voornaam }}</p>

                        <p class="mt-2 text-md px-2 text-gray-900">{{ $inschrijvingsdetail->kind->familienaam }}</p>
                    </div>

                    {{--    naam activiteit    --}}
                    <div class=" flex space-x-0">
                        <p class="mt-2 text-md text-gray-900">{{ $inschrijvingsdetail->activiteit->naam." : ".Carbon\Carbon::parse($inschrijvingsdetail->activiteit->starttijd)->format('d-m-Y')." - ".Carbon\Carbon::parse($inschrijvingsdetail->activiteit->eindtijd)->format('d-m-Y')}}</p>
                    </div>

                    {{--    prijs activiteit    --}}
                    <div class=" flex space-x-0">
                        <p class="mt-2 text-md text-gray-900">{{ "€ ".$inschrijvingsdetail->prijs }}</p>
                            @foreach($inschrijvingsdetail->inschrijvingsdetail_opties as $detailoptie)
                            <p class="mt-2 text-md text-gray-900">{{ " (€".$detailoptie->optie->prijs." ".$detailoptie->optie->omschrijving.") " }}</p>
                            @endforeach
                    </div>

                    {{--     knop details + uitschrijven     --}}
                    <div class=" flex space-x-0">
                        <button class="rounded-md bg-gray-500 text-white focus:ring-gray-600 px-4 py-2 text-sm m-4"
                                onclick="window.location='{{ route("inschrijvingsdetails.show", $inschrijvingsdetail->inschrijvingsdetails_id) }}'">
                                {{ "details" }}
                        </button>
                    @if($inschrijvingsdetail->activiteit->annulerenTot > today())
                            <button class="rounded-md bg-red-900 text-white focus:ring-gray-600 px-4 py-2 text-sm m-4"
                                    onclick="window.location='{{ route("inschrijvingsdetails.destroy", $inschrijvingsdetail->inschrijvingsdetails_id) }}'">
                                {{ "uitschrijven" }}
                            </button>
                        @else
                            <p class="m-4">uitschrijven niet meer mogelijk</p>
                        @endif
                    </div>

                @endforeach
            </div>

            {{--    paginatie    --}}
             {{ $inschrijvingsdetails->links() }}
        </div>
    </div>
</x-app-layout>
