<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <p class="text-lg h-2"> {{ "Welkom bij Tope " . optional(Auth::user()->profiel)->voornaam  }} </p>
                    </div>
            </div>
{{--            Toon enkel aan ouders: --}}
            @if(!Auth::user()->isAdmin && !Auth::user()->isAnimator)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 text-gray-900">
                   <p>Nieuw? Vul eerst je <a href="/profiel" class="font-bold underline">profiel</a> aan.</p>
                    <p>Daarna kan je je <a href="/kinderen" class="font-bold underline">kinderen</a> toevoegen.</p>
                    <p>Bekijk dan de <a href="/activiteiten" class="font-bold underline">activiteiten</a> en schrijf in!</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
