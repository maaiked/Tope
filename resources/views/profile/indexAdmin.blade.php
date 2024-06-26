<x-app-layout>

    {{--    made with https://tailwindflex.com/@rp-ketan/datatable --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alle Gebruikers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{--    enkel zichtbaar voor admin    --}}
            <div>
                @if (auth()->user()->isAdmin)
                <button onclick="window.location='{{ route("profile.create") }}'"
                class="col-span-1  inline-flex border-2 items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 hover:text-gray-900 focus:relative">
                Gebruiker toevoegen</button>
                @endif
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li class="text-red-600">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <table id="example" class="bootstrap-table" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">IsAdmin</th>
                        <th class="px-4 py-2">IsAnimator</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <form method="POST" action="{{ route('profile.updateAdmin', $user->id) }}">
                            @csrf
                            @method('PUT')

                        <td class="border px-4 py-2">{{$user->email}}</td>
                        <td class="border px-4 py-2">


                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                <input type="checkbox"
                                       name="isAdmin"
                                       id="isAdmin"
                                       value="1"
                                       onclick="this.form.submit()"
                                       @if($user->isAdmin) checked @endif
                                >


                        </td>
                        <td class="border px-4 py-2">

                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                <input type="checkbox"
                                       name="isAnimator"
                                       id="isAnimator"
                                       value="1"
                                       onclick="this.form.submit()"
                                       @if($user->isAnimator) checked @endif
                                >
                        </td>
                        </form>
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
                                search: 'Zoek in gebruikers:',
                                lengthMenu: '_MENU_ gebruikers per pagina',
                                info: ' _START_ tot _END_ van _TOTAL_ gebruikers worden getoond',
                                infoFiltered: '(gefilterd van _MAX_ gebruikers in totaal)',
                            }
                        });
                    });
                </script>


            </div>
        </div>
    </div>
</x-app-layout>
