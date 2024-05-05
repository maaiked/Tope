<x-app-layout>

    {{--    made with https://tailwindflex.com/@rp-ketan/datatable --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alle Gebruikers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6">

                <table id="example" class="bootstrap-table" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">IsAdmin</th>
                        <th class="px-4 py-2">Bewerk</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="border px-4 py-2">{{$user->email}}</td>
                        <td class="border px-4 py-2">{{$user->isAdmin}}</td>
                        <td class="border px-4 py-2">
                        <button onclick="window.location='{{ route("profile.edit", $user->id) }}'"
                        class="col-span-1  inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="h-4 w-4"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                            />
                        </svg>
                        Bewerk
                        </button>
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
                            // Add any customization options here
                        });
                    });
                </script>

            </div>
        </div>
    </div>
</x-app-layout>
