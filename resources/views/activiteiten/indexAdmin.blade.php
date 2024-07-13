<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Activiteiten') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success') !== null)
                <p class="text-lg py-4 px-4 text-md font-bold underline text-green-500"
                ><i>{{ session()->pull('success', null) }}</i></p>
            @endif

            {{-- Admin button to add new activity & view archived activities --}}
            @if (auth()->user()->isAdmin)
                <div>
                    <button onclick="window.location='{{ route("activiteiten.create") }}'"
                            class="col-span-1  inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative">
                        Activiteit toevoegen
                    </button>
                    <button onclick="window.location='{{ route("activiteiten.indexArchief") }}'"
                            class="col-span-1  inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative">
                        Gearchiveerde activiteiten
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
                        @if(!$activiteit->deleted_at)
                            <tr>
                                <td class="border px-4 py-2">
                                    <div>
                                        <p class="mt-4 text-lg text-gray-900">{{ $activiteit->naam }}</p>
                                        <p class="mt-4 text-sm text-gray-900">{{ $activiteit->locatie->naam }}</p>
                                        <input type="hidden" name="activiteit" value="{{ $activiteit->id }}"/>
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
                                        <input type="hidden" name="prijs" value="{{ $activiteit->prijs }}"/>
                                        @foreach($activiteit->opties as $optie)
                                            <p>{{ $optie->omschrijving.": € ".$optie->prijs }}</p>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="border px-4 py-2">
                                    <div class="flex-1 items-center vertical-align: middle;">
                                        <button
                                            onclick="window.location='{{ route("activiteiten.show", $activiteit->id) }}'"
                                            class="rounded-md bg-gray-500 text-white focus:ring-gray-600 px-4 py-2 text-sm mt-4">
                                            meer info
                                        </button>

                                        <button
                                            onclick="window.location='{{ route("inschrijvingsdetails.indexActiviteit", $activiteit->id) }}'"
                                            class="rounded-md bg-blue-500 text-white focus:ring-gray-600 px-4 py-2 text-sm mt-4">
                                            inschrijvingen
                                        </button>

                                        <button
                                            onclick="window.location='{{ route("activiteiten.edit", $activiteit->id) }}'"
                                            class="col-span-1 inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative mt-2">
                                            Aanpassen
                                        </button>

                                        <button onclick="showDeleteActiviteit({{$activiteit->id}})"
                                                class="rounded-md bg-red-500 text-white px-1 py-1 text-sm">
                                            {{ "Archiveren" }}
                                        </button>
                                        <!-- Modal -->
                                        <div id="DeleteActiviteit.{{$activiteit->id}}"
                                             class="fixed z-10 inset-0 overflow-y-auto hidden">
                                            <div class="flex items-center justify-center min-h-screen">
                                                <div class="bg-blue-500 w-1/2 p-6 rounded shadow-lg">
                                                    <div class="flex justify-end">
                                                        <!-- Close Button -->
                                                        <button id="close"
                                                                onclick="hideDeleteActiviteit({{$activiteit->id}})"
                                                                class="text-gray-700 hover:text-red-500">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                                 viewBox="0 0 24 24"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      stroke-width="2"
                                                                      d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{ route("activiteiten.delete")}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <h2 class="text-2xl font-bold mb-4">{{"Archiveer de activiteit: ".$activiteit->naam}}</h2>
                                                        <p>Hoe minder actieve activiteiten dat het programma moet
                                                            ophalen, hoe sneller het werkt.<br>
                                                            Archiveer daarom activiteiten die meer dan 2 jaar oud zijn.<br>
                                                            <b>Let op!
                                                                <br>! Hiermee worden ook de inschrijvingen gearchiveerd !
                                                                <br>! Gearchiveerde activiteiten kunnen niet terug
                                                                actief gemaakt worden !</b></p>
                                                        <input type="hidden" name="activiteit_id"
                                                               value="{{ $activiteit->id }}"/>
                                                        <div>
                                                            <button
                                                                class="rounded-md mt-4 bg-red-500 text-white focus:ring-gray-600 px-2 py-2 text-sm">
                                                                {{ "Definitief archiveren" }}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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

        function showDeleteActiviteit(id) {
            var name = "DeleteActiviteit.".concat(id);
            var modal = document.getElementById(name);
            modal.classList.remove('hidden');
        }

        function hideDeleteActiviteit(id) {
            var name = "DeleteActiviteit.".concat(id);
            var modal = document.getElementById(name);
            modal.classList.add('hidden');
        }
    </script>
</x-app-layout>
