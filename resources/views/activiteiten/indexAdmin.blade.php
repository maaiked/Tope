<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Activiteiten') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Admin button to add new activity --}}
            @if (auth()->user()->isAdmin)
            <div>
                <button onclick="window.location='{{ route("activiteiten.create") }}'"
                class="col-span-1  inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative">
                Activiteit toevoegen
                </button>
            </div>
            @endif

            {{-- Activities Table --}}
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg mx-6 my-6 mt-4 px-4 py-4">
                <table id="myTable" class="bootstrap-table" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th class="px-4 py-2">Activiteit + locatie</th>
                        <th class="px-4 py-2">Van - Tot</th>
                        <th class="px-4 py-2">Leerjaren</th>
                        <th class="px-4 py-2">Prijs + opties</th>
                        <th class="px-4 py-2">Acties</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($activiteiten as $activiteit)
                    <tr>
                        <form method="POST" action="{{ route('inschrijvingsdetail.store') }}">
                            @csrf
                            <td class="border px-4 py-2">
                                <div>
                                    <p class="mt-4 text-lg text-gray-900">{{ $activiteit->naam }}</p>
                                    <p class="mt-4 text-sm text-gray-900">{{ $activiteit->locatie->naam }}</p>
                                    <input type="hidden" name="activiteit" value="{{ $activiteit->id }}" />
                                </div>
                            </td>
                            <td class="border px-4 py-2">
                                <div>
                                    <p class="mt-4 text-md text-gray-900">
                                        {{ Carbon\Carbon::parse($activiteit->starttijd)->format('d-m-Y G\ui') }}
                                    </p>
                                    <p class="mt-4 text-md text-gray-900">
                                        {{ " tot ".Carbon\Carbon::parse($activiteit->eindtijd)->format('d-m-Y G\ui') }}
                                    </p>
                                </div>
                            </td>
                            <td class="border px-4 py-2">
                                <div>
                                    <p class="mt-4 text-md text-gray-900">
                                        {{ $activiteit->leerjaarVanaf->label()." tot ".$activiteit->leerjaarTot->label() }}
                                    </p>
                                </div>
                            </td>
                            <td class="border px-4 py-2">
                                <div>
                                    <p class="mt-4 text-md text-gray-900 font-bold">{{ "€ ". $activiteit->prijs }}</p>
                                    <input type="hidden" name="prijs" value="{{ $activiteit->prijs }}" />
                                    @foreach($activiteit->opties as $optie)
                                    <p>{{ $optie->omschrijving.": € ".$optie->prijs }}</p>
                                    @endforeach
                                </div>
                            </td>
                            <td class="border px-4 py-2">
                                <div class="flex-1 items-center vertical-align: middle;">
                                    <button class="rounded-md bg-gray-500 text-white focus:ring-gray-600 px-4 py-2 text-sm mt-4" type="submit" name="action" value="info">
                                        meer info
                                    </button>
                                    @if (auth()->user()->isAdmin)
                                    <button onclick="window.location='{{ route("activiteiten.edit", $activiteit->id) }}'"
                                    class="col-span-1 inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative mt-2">
                                    Aanpassen
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </form>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    {{-- Scripts for table with search, sorting, and pagination --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                scrollX: true,
                ordering: false,
                language: {
                    search: 'Zoek in activiteiten:',
                    lengthMenu: '_MENU_ activiteiten per pagina',
                    info: ' _START_ tot _END_ van _TOTAL_ activiteiten worden getoond',
                    infoFiltered: '(gefilterd van _MAX_ activiteiten in totaal)',
                }
            });
        });
    </script>
</x-app-layout>
