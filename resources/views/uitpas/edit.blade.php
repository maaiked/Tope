<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('UiTPAS gegevens bewerken') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('uitpas.update') }}">
        @csrf

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-600">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <div class="text-gray-800 mt-4">
                        <p class="font-medium text-lg">Inloggegevens ontvangen van UiTPAS</p>
                        <p>De velden met een sterretje (*) zijn verplicht.</p>

                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2 px-3 py-3">
                            <div class="md:col-span-1">
                                <label for="clientId">Client Id *</label>
                                <input type="text" name="clientId" id="clientSecret" required
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 "
                                       value="{{ old('clientId', $uitpas->clientId) }}"
                                       placeholder="exacte client id zoals ontvangen van uitpas inclusief hoofdletters"/>
                                <x-input-error :messages="$errors->get('clientId')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-1">
                                <label for="clientSecret">Client Secret *</label>
                                <input type="text" name="clientSecret" id="clientSecret" required
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 "
                                       value="{{ old('clientSecret') }}"
                                       placeholder="exacte client secret zoals ontvangen van uitpas inclusief hoofdletters"/>
                                <x-input-error :messages="$errors->get('clientSecret')" class="mt-2"/>
                            </div>
                        </div>
                    </div>

                        <div class="text-gray-800 mt-4">
                            <p class="font-medium text-lg">UiTPAS ID's</p>
                            <p>De velden met een sterretje (*) zijn verplicht.</p>

                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2 px-3 py-3">
                                <div class="md:col-span-1">
                                    <label for="organizerId">Organizer Id *</label>
                                    <input type="text" name="organizerId" id="organizerId" required
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 "
                                           value="{{ old('organizerId', $uitpas->organizerId) }}"
                                           placeholder="exacte organizer id zoals ontvangen van uitpas inclusief hoofdletters"/>
                                    <x-input-error :messages="$errors->get('organizerId')" class="mt-2"/>
                                </div>
                                <div class="md:col-span-1">
                                    <label for="locationId">Location Id *</label>
                                    <input type="text" name="locationId" id="locationId" required
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 "
                                           value="{{ old('locationId', $uitpas->locationId) }}"
                                           placeholder="exacte location id zoals ontvangen van uitpas inclusief hoofdletters"/>
                                    <x-input-error :messages="$errors->get('locationId')" class="mt-2"/>
                                </div>
                            </div>
                        </div>

                        <div class="text-gray-800 mt-4">
                            <p class="font-medium text-lg">URL's voor UiTPAS requests</p>
                            <p>De velden met een sterretje (*) zijn verplicht.</p>

                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2 px-3 py-3">
                                <div class="md:col-span-1">
                                    <label for="api_url">API url *</label>
                                    <input type="text" name="api_url" id="api_url" required
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 "
                                           value="{{ old('api_url', $uitpas->api_url) }}"
                                           placeholder="test url = https://api-test.uitpas.be"/>
                                    <x-input-error :messages="$errors->get('api_url')" class="mt-2"/>
                                </div>
                                <div class="md:col-span-1">
                                    <label for="io_url">IO url *</label>
                                    <input type="text" name="io_url" id="io_url" required
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 "
                                           value="{{ old('io_url', $uitpas->io_url) }}"
                                           placeholder="test url = https://io-test.uitdatabank.be"/>
                                    <x-input-error :messages="$errors->get('io_url')" class="mt-2"/>
                                </div>
                                <div class="md:col-span-1">
                                    <label for="account_url">Account url *</label>
                                    <input type="text" name="account_url" id="account_url" required
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 "
                                           value="{{ old('account_url', $uitpas->account_url) }}"
                                           placeholder="test url = https://account-test.uitid.be"/>
                                    <x-input-error :messages="$errors->get('account_url')" class="mt-2"/>
                                </div>
                            </div>
                        </div>
                        <x-primary-button class="mt-4">{{ __('Opslaan') }}</x-primary-button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
