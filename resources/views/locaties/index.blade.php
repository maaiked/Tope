<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alle Locaties') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6">
                <div>
                    @if (auth()->user()->isAdmin)
                    <button onclick="window.location='{{ route("locatie.create") }}'"
                    class="col-span-1  inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative">
                    Locatie toevoegen</button>
                    @endif
                </div>
                @if (session('status') === 'locatie-created')
                <p class="text-lg py-4 px-4 text-green-950">
                    <i>{{ __('Locatie is succesvol aangemaakt.') }}</i>
                </p>
                @elseif (session('status') === 'locatie-updated')
                <p class="text-lg py-4 px-4 text-green-950">
                    <i>{{ __('Locatie is succesvol bijgewerkt.') }}</i>
                </p>
                @endif

                <table id="locaties" class="table-auto w-full">
                    <thead>
                    <tr>
                        <th class="px-4 py-2">Naam</th>
                        <th class="px-4 py-2">Straat</th>
                        <th class="px-4 py-2">Gemeente</th>
                        <th class="px-4 py-2">Acties</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($locaties as $locatie)
                    <tr>
                        <td class="border px-4 py-2">{{ $locatie->naam }}</td>
                        <td class="border px-4 py-2">{{ $locatie->straat }}</td>
                        <td class="border px-4 py-2">{{ $locatie->gemeente }}</td>
                        <td class="border px-4 py-2">
                            <button onclick="window.location="{{ route('locatie.edit', $locatie) }}"
                            class="col-span-1  inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative">
                            Bewerken</button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
