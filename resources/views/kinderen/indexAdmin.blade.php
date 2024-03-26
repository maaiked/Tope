<x-app-layout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <h2 class="text-2xl font-bold mb-4">Kind database</h2>
                <table id="example" class="table-auto w-full">
                    <thead>
                    <tr>
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
                            <td class="border px-4 py-2">{{$kind->voornaam}}</td>
                            <td class="border px-4 py-2">{{$kind->familienaam}}</td>
                            <td class="border px-4 py-2">{{$kind->user->name}}</td>
                            <td class="border px-4 py-2">{{$kind->allergie}}</td>
                            <td class="border px-4 py-2">{{$kind->beperking}}</td>
                            <td class="border px-4 py-2">{{$kind->medicatie}}</td>
                            <td class="border px-4 py-2">{{$kind->infoAdminAnimator}}</td>
                            <td class="border px-4 py-2">{{$kind->infoAdmin}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

{{--            scripts voor tabel met search, sorting en paginatie--}}
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('#example').DataTable({
                        // Add any customization options here
                    });
                });
            </script>

    </div>
</x-app-layout>
