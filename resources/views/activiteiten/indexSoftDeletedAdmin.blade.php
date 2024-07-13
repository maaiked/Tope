<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gearchiveerde activiteiten') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Softdeleted Activities Table --}}
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg mx-6 my-6 mt-4 px-4 py-4">
                <h3>{{ "Gearchiveerde activiteiten" }}</h3>
                <table id="myTable" class="bootstrap-table" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th class="px-4 py-2">Activiteit</th>
                        <th class="px-4 py-2">Inschrijvingen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($activiteiten as $activiteit)
                        @if($activiteit->deleted_at)
                            <tr>
                                <td class="border px-4 py-2">
                                    <div>
                                        <p class="text-lg text-gray-900 font-bold">{{ $activiteit->naam }}</p>
                                        <p class="text-md text-gray-900">{{ "ID: ".$activiteit->id }}</p>
                                        <p class="text-md text-gray-900">{{ $activiteit->locatie->naam }}</p>
                                        <p class="text-md text-gray-900">
                                            {{ Carbon\Carbon::parse($activiteit->starttijd)->format('d-m-Y G\ui')." tot ".Carbon\Carbon::parse($activiteit->eindtijd)->format('d-m-Y G\ui') }}
                                        </p>
                                        <p class="text-md text-gray-900">
                                            {{ $activiteit->leerjaarVanaf->label()." tot ".$activiteit->leerjaarTot->label() }}
                                        </p>
                                        <p class="text-md text-gray-900 font-bold">{{ "€ ". $activiteit->prijs }}</p>
                                        @foreach($activiteit->opties as $optie)
                                            <p>{{ $optie->omschrijving.": € ".$optie->prijs }}</p>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="border px-4 py-2">
                                    <div>
                                        <p class="font-bold">{{ $activiteit->aantalInschrijvingen." / ".$activiteit->capaciteit. " inschrijvingen" }}</p>
                                        @foreach($activiteit->inschrijvingsdetails as $i)
                                            <p>{{ $i->kind->voornaam." ".$i->kind->familienaam." - € ".$i->prijs }}</p>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endif
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
