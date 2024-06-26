<x-app-layout>

{{--    made with https://tailwindflex.com/@rp-ketan/datatable --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alle kinderen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6">
                @if (session('success') !== null)
                    <p class="text-lg py-4 px-4 text-md font-bold underline text-green-500"
                    ><i>{{ session()->pull('success', null) }}</i></p>
                @endif

                <table id="example" class="bootstrap-table" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th class="px-4 py-2">Bewerken</th>
                        <th class="px-4 py-2">Voornaam</th>
                        <th class="px-4 py-2">Familienaam</th>
                        <th class="px-4 py-2">Ouder</th>
                        <th class="px-4 py-2">Allergie</th>
                        <th class="px-4 py-2">Beperking</th>
                        <th class="px-4 py-2">Medicatie</th>
                        <th class="px-4 py-2">Info animatoren</th>
                        <th class="px-4 py-2">Info admin</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($kinderen as $kind)
                        <tr>
                            <td class="border px-4 py-2">
                                <button onclick="window.location='{{ route("kind.edit", $kind->id) }}'"
                                class="col-span-1  inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative">
                                Bewerken</button>
                            </td>
                            <td class="border px-4 py-2">{{$kind->voornaam}}</td>
                            <td class="border px-4 py-2">{{$kind->familienaam}}</td>
                            <td class="border px-4 py-2">{{ optional($kind->user->profiel)->voornaam." ".optional($kind->user->profiel)->familienaam }}</td>
                            <td class="border px-4 py-2">{{$kind->allergie}}</td>
                            <td class="border px-4 py-2">{{$kind->beperking}}</td>
                            <td class="border px-4 py-2">{{$kind->medicatie}}</td>
                            <td class="border px-4 py-2">{{$kind->infoAdminAnimator}}</td>
                            <td class="border px-4 py-2">{{$kind->infoAdmin}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>


{{--            scripts voor tabel met search, sorting en paginatie--}}

            <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">
            <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
            <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>


            <script>
                $(document).ready(function() {
                    $('#example').DataTable({
                        scrollX: true,
                        language: {
                            search: 'Zoek in kinderen:',
                        lengthMenu: '_MENU_ kinderen per pagina',
                        info: ' _START_ tot _END_ van _TOTAL_ kinderen worden getoond',
                        infoFiltered: '(gefilterd van _MAX_ kinderen in totaal)',
                    }
                    });
                });
            </script>

            </div>
        </div>
    </div>
</x-app-layout>
