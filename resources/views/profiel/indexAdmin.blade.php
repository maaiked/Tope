<x-app-layout>

    {{--    made with https://tailwindflex.com/@rp-ketan/datatable --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alle Ouders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6">

                <table id="example" class="bootstrap-table" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th class="px-4 py-2">Bewerken</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Voornaam</th>
                        <th class="px-4 py-2">Familienaam</th>
                        <th class="px-4 py-2">Straat</th>
                        <th class="px-4 py-2">Huisnummer</th>
                        <th class="px-4 py-2">Bus</th>
                        <th class="px-4 py-2">Postcode</th>
                        <th class="px-4 py-2">Gemeente</th>
                        <th class="px-4 py-2">Rijksregisternummer</th>
                        <th class="px-4 py-2">Telefoonnummer</th>
                        <th class="px-4 py-2">Kinderen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="border px-4 py-2">
                            <button onclick="window.location='{{ route("profiel.editById", $user->id) }}'"
                            class="col-span-1  inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative">
                            Bewerken</button>
                            <button onclick="window.location='{{ route("kinderen.indexAdminOuder", $user->id) }}'"
                            class="rounded-md bg-blue-500 text-white focus:ring-gray-600 px-4 py-2 text-sm mt-4">
                            Kinderen
                            </button>
                        </td>
                        <td class="border px-4 py-2">{{$user->email}}</td>
                        <td class="border px-4 py-2">{{optional($user->profiel)->voornaam}}</td>
                        <td class="border px-4 py-2">{{optional($user->profiel)->familienaam}}</td>
                        <td class="border px-4 py-2">{{optional($user->profiel)->straat}}</td>
                        <td class="border px-4 py-2">{{optional($user->profiel)->huisnummer}}</td>
                        <td class="border px-4 py-2">{{optional($user->profiel)->bus}}</td>
                        <td class="border px-4 py-2">{{optional($user->profiel)->postcode}}</td>
                        <td class="border px-4 py-2">{{optional($user->profiel)->gemeente}}</td>
                        <td class="border px-4 py-2">{{optional($user->profiel)->rijksregisternummer}}</td>
                        <td class="border px-4 py-2">{{optional($user->profiel)->telefoonnummer}}</td>
                        <td class="border px-4 py-2">
                            @foreach($user->kinds as $kind)
                            {{$kind->voornaam." ".$kind->familienaam}}<br>
                            @endforeach
                        </td>
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
                        });
                    });
                </script>

            </div>
        </div>
    </div>
</x-app-layout>
