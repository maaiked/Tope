<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jouw inschrijvingen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                    <p class="mt-4 text-lg text-gray-900">Start activiteit</p>
                </div>
                <div class="flex space-x-0">
                    <p class="mt-4 text-lg text-gray-900">Prijs</p>
                </div>

                {{--                TODO: inschrijvingen sorteren op datum inschrijving of activiteit? groeperen per jaar > vakantieperiode? filters toevoegen?--}}


                {{-- rijen --}}
                @foreach ($inschrijvingsdetails as $inschrijvingsdetail)

                    {{--    inschrijvingsdatum    --}}
                    <div class="flex space-x-0">
                        <p class="mt-2 text-md text-gray-900">{{ Carbon\Carbon::parse($inschrijvingsdetail->inschrijvingsdatum)->format('d-m-Y')}}</p>
                    </div>

                    {{--    voornaam kind    --}}
                    <div class="flex space-x-0">
                        <p class="mt-2 text-md text-gray-900">{{ $inschrijvingsdetail->kind->voornaam}}</p>
                    </div>

                    {{--    naam activiteit    --}}
                    <div class=" flex space-x-0">
                        <p class="mt-2 text-md text-gray-900">{{ $inschrijvingsdetail->activiteit->naam}}</p>
                    </div>

                    {{--    datum start activiteit    --}}
                    <div class=" flex space-x-0">
                        <p class="mt-2 text-md text-gray-900">{{ Carbon\Carbon::parse($inschrijvingsdetail->activiteit->starttijd)->format('d-m-Y')}}</p>
                    </div>

                    {{--    prijs activiteit    --}}
                    <div class=" flex space-x-0">
                        <p class="mt-2 text-md text-gray-900">{{ "€ ".$inschrijvingsdetail->prijs }}</p>
                    </div>
                @endforeach
            </div>

            {{--    paginatie    --}}
            {{ $inschrijvingsdetails->links() }}
        </div>
    </div>
</x-app-layout>
