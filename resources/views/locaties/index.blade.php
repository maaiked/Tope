<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alle Locaties') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success') !== null)
                <p class="text-lg py-4 px-4 text-md font-bold underline text-green-500"
                ><i>{{ session()->pull('success', null) }}</i></p>
            @endif

            <div>
                @if (auth()->user()->isAdmin)
                <button onclick="window.location='{{ route("locatie.create") }}'"
                class="col-span-1  inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative">
                Locatie toevoegen</button>
                @endif
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6">

                <table id="locaties" class="bootstrap-table" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
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
                            <button onclick="window.location='{{ route('locatie.edit', $locatie) }}'"
                                    class="col-span-1  inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative">
                                Bewerken</button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                {{-- Scripts voor tabel met search, sorting en paginatie --}}
                <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">
                <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
                <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

                <script>
                    $(document).ready(function() {
                        $('#locaties').DataTable({
                            scrollX: true,
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</x-app-layout>
