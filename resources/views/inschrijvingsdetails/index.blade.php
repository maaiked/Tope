<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jouw inschrijvingen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @foreach ($inschrijvingsdetails as $inschrijvingsdetail)
                    <div class="p-3 flex space-x-0">
                        <div class="flex-1">
                            <p class="mt-4 text-lg text-gray-900">{{ $inschrijvingsdetail->activiteit->message . " kind:" . $inschrijvingsdetail->kind->voornaam . " ouder:" . $inschrijvingsdetail->kind->user->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $inschrijvingsdetails->links() }}
        </div>
    </div>
</x-app-layout>
