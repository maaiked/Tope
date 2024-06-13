<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (auth()->user()->isAdmin)
            {{ __('Alle inschrijvingen') }}
            @else
            {{ __('Jouw inschrijvingen') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success') !== null)
                <p class="text-lg py-4 px-4 text-md font-bold underline text-green-500"
                ><i>{{ session()->pull('success', null) }}</i></p>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6">

                <table id="inschrijvingen" class="table-auto w-full">
                    <thead>
                    <tr>
                        <th class="px-4 py-2">Inschrijvingsdatum</th>
                        <th class="px-4 py-2">Deelnemer</th>
                        <th class="px-4 py-2">Activiteit</th>
                        <th class="px-4 py-2">Totaalprijs</th>
                        <th class="px-4 py-2">Knoppen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($inschrijvingsdetails as $inschrijvingsdetail)
                    <tr>
                        <td class="border px-4 py-2">
                            {{ Carbon\Carbon::parse($inschrijvingsdetail->inschrijvingsdatum)->format('d-m-Y') }}
                        </td>
                        <td class="border px-4 py-2">
                            {{ $inschrijvingsdetail->kind->voornaam }} {{ $inschrijvingsdetail->kind->familienaam }}
                        </td>
                        <td class="border px-4 py-2">
                            {{ $inschrijvingsdetail->activiteit->naam." : ".Carbon\Carbon::parse($inschrijvingsdetail->activiteit->starttijd)->format('d-m-Y')." - ".Carbon\Carbon::parse($inschrijvingsdetail->activiteit->eindtijd)->format('d-m-Y') }}
                        </td>
                        <td class="border px-4 py-2">
                            {{ "€ ".$inschrijvingsdetail->prijs }}
                        </td>
                        <td class="border px-4 py-2 flex space-x-2">
                            <button class="rounded-md bg-gray-500 text-white focus:ring-gray-600 px-4 py-2 text-sm"
                                    onclick="window.location='{{ route("inschrijvingsdetails.show", $inschrijvingsdetail->inschrijvingsdetails_id) }}'">
                            {{ "details" }}
                            </button>
                            @if($inschrijvingsdetail->activiteit->annulerenTot > today() || auth()->user()->isAdmin)
                            <button class="rounded-md bg-red-900 text-white focus:ring-gray-600 px-4 py-2 text-sm"
                                    onclick="show({{$inschrijvingsdetail->inschrijvingsdetails_id}})">
                                {{ "uitschrijven" }}
                            </button>
                            <!-- Modal -->
                            <div id="confirm.{{$inschrijvingsdetail->inschrijvingsdetails_id}}" class="fixed z-10 inset-0 overflow-y-auto hidden">
                                <div class="flex items-center justify-center min-h-screen">
                                    <div class="bg-gray-200 w-1/2 p-6 rounded shadow-md">
                                        <div class="flex justify-end">
                                            <!-- Close Button -->
                                            <p id="close" onclick="hide({{$inschrijvingsdetail->inschrijvingsdetails_id}})"
                                               class="text-gray-700 hover:text-red-500">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </p>
                                        </div>
                                        <div class="content-center">
                                            <p class="px-2 py-2">Wil je volgende inschrijving annuleren? </p>
                                            <p class="px-2 py-2 font-bold">{{ $inschrijvingsdetail->activiteit->naam." : ".$inschrijvingsdetail->kind->voornaam." ".$inschrijvingsdetail->kind->familienaam }}</p>
                                            <button
                                                class="rounded-md bg-blue-600 text-white focus:ring-blue-400 px-2 py-2 text-sm"
                                                onclick="window.location='{{ route("inschrijvingsdetails.destroy", $inschrijvingsdetail->inschrijvingsdetails_id) }}'">
                                            {{ "Inschrijving annuleren" }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <p>uitschrijven niet meer mogelijk</p>
                            @endif
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
                        $('#inschrijvingen').DataTable({
                            scrollX: true,
                            language: {
                                search: 'Zoek in inschrijvingen:',
                                lengthMenu: '_MENU_ inschrijvingen per pagina',
                                info: ' _START_ tot _END_ van _TOTAL_ inschrijvingen worden getoond',
                                infoFiltered: '(gefilterd van _MAX_ inschrijvingen in totaal)',
                            }
                        });
                    });

                    function show(id) {
                        var name = "confirm.".concat(id);
                        var modal = document.getElementById(name);
                        modal.classList.remove('hidden');
                    }

                    function hide(id) {
                        var name = "confirm.".concat(id);
                        var modal = document.getElementById(name);
                        modal.classList.add('hidden');
                    }
                </script>
            </div>

        </div>
    </div>
</x-app-layout>
