<section class="space-y-6">

        <table id="example" class="bootstrap-table" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
            <tr>
                <th class="px-4 py-2">Voornaam</th>
                <th class="px-4 py-2">Familienaam</th>
                <th class="px-4 py-2">Leerjaar</th>
                <th class="px-4 py-2">Ouder</th>
                <th class="px-4 py-2">Afhalen</th>
                <th class="px-4 py-2">Alleen naar huis</th>
                <th class="px-4 py-2">Foto</th>
            </tr>
            </thead>
            <tbody>
            @foreach($inschrijvingen as $i)
                @if($i->ingechecked && !$i->uitgechecked )
                    <tr>
                        <td class="border px-4 py-2">{{$i->kind->voornaam}}</td>
                        <td class="border px-4 py-2">{{$i->kind->familienaam}}</td>
                        <td class="border px-4 py-2">{{$i->kind->leerjaar}}</td>
                        <td class="border px-4 py-2">{{ optional($i->kind->user->profiel)->voornaam." , ".optional($i->kind->user->profiel)->familienaam }}</td>
                        <td class="border px-4 py-2">{{$i->kind->afhalenKind}}</td>
                        <td class="border px-4 py-2">@if($i->kind->alleenNaarHuis) ja @else nee @endif</td>
                        <td class="border px-4 py-2">@if($i->kind->fotoToestemming) ja @else <p class="text-red-600">nee</p> @endif</td>
                    </tr>
                @endif
            @endforeach

            </tbody>
        </table>

</section>
