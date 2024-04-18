<section class="space-y-6">

        <table id="example" class="bootstrap-table" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
            <tr>
                <th class="px-4 py-2">Voornaam, familienaam</th>
                <th class="px-4 py-2">Leerjaar</th>
                <th class="px-4 py-2">Ouder: telefoonnummer</th>
                <th class="px-4 py-2">Extra contactpersoon</th>
                <th class="px-4 py-2">Allergie</th>
                <th class="px-4 py-2">Beperking</th>
                <th class="px-4 py-2">Medicatie</th>
            </tr>
            </thead>
            <tbody>
            @foreach($inschrijvingen as $i)
                @if($i->kind->allergie || $i->kind->medicatie || $i->kind->beperking)
                    <tr>
                        <td class="border px-4 py-2">{{$i->kind->voornaam." , ".$i->kind->familienaam}}</td>
                        <td class="border px-4 py-2">{{$i->kind->leerjaar}}</td>
                        <td class="border px-4 py-2">{{ optional($i->kind->user->profiel)->voornaam." ".optional($i->kind->user->profiel)->familienaam." : ".optional($i->kind->user->profiel)->telefoonnummer }}</td>
                        <td class="border px-4 py-2">{{$i->kind->contactpersoon}}</td>
                        <td class="border px-4 py-2">{{$i->kind->allergie}}</td>
                        <td class="border px-4 py-2">{{$i->kind->beperking}}</td>
                        <td class="border px-4 py-2">{{$i->kind->medicatie}}</td>
                         </tr>
                @endif
            @endforeach

            </tbody>
        </table>

</section>
