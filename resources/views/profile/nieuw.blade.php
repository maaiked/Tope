<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "Gebruiker aanmaken" }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('profile.store') }}">
        @csrf

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-6 px-6">

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="text-gray-800">
                        <p class="font-medium text-lg">Algemene informatie ouder</p>
                        <p>Vul hieronder jouw gegevens in. <br>
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4 px-3 py-3">
                            <div class="md:col-span-2">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       placeholder="vb. user@tope.be"/>
                                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                       placeholder="********"/>
                                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                            </div>
                            <div class="md:col-span-2">
                                <label for="isAdmin">isAdmin</label>
                                <input type="checkbox" name="isAdmin" id="isAdmin"
                                       class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                                <x-input-error :messages="$errors->get('isAdmin')" class="mt-2"/>
                            </div>
                        </div>
                    </div>
                    <x-primary-button class="mt-4">{{ __('Opslaan') }}</x-primary-button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
