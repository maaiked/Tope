<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('UiTPAS gegevens organisatie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6">

                <button class="col-span-1  inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative" onclick="window.location='{{ route("uitpas.edit") }}'">
                    Bewerk uitpas gegevens
                </button>

            <p class="mt-4 text-gray-900">
                {{"Client id: ".$uitpas['clientId']}}
            </p>
{{--                Todo:: delete client secret once testing is done--}}
            <p class="mt-2 text-gray-900">
                {{"Client secret: ".$uitpas['clientSecret']}}
            </p>
            <p class="mt-2 text-gray-900">
                {{"Api url: ".$uitpas['api_url']}}
            </p>
            <p class="mt-2 text-gray-900">
                {{"IO url: ".$uitpas['io_url']}}
            </p>
            <p class="mt-2 text-gray-900">
                {{"Account url: ".$uitpas['account_url']}}
            </p>
            <p class="mt-2 text-gray-900">
                {{"Organizer id: ".$uitpas['organizerId']}}
            </p>
            <p class="mt-2 text-gray-900">
                {{"Location id: ".$uitpas['locationId']}}
            </p>
{{--                Todo:: hide once testing is done--}}
            <p class="mt-2 text-gray-900">
                {{"Token: ".$uitpas['uitpastoken']}}
            </p>
            <p class="mt-2 text-gray-900">
                {{"Token expires in: ".$uitpas['expires_in']}}
            </p>

            </div>
            <button class="col-span-1  inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative" onclick="window.location='{{ route("uitpas.create") }}'">ENKEL IN NOOD: Vraag nieuwe token op</button>

        </div>
    </div>
</x-app-layout>
