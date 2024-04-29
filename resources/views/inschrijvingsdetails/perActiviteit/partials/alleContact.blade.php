<section class="space-y-6">

        <table id="example" class="bootstrap-table" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
            <tr>
                <th class="px-4 py-2">Voornaam</th>
                <th class="px-4 py-2">Familienaam</th>
                <th class="px-4 py-2">Leerjaar</th>
                <th class="px-4 py-2">Ouder</th>
                <th class="px-4 py-2">Telefoonnummer</th>
                <th class="px-4 py-2">Extra contactpersoon</th>
            </tr>
            </thead>
            <tbody>
            @foreach($inschrijvingen as $i)
                    <tr>
                        <td class="border px-4 py-2">{{$i->kind->voornaam}}</td>
                        <td class="border px-4 py-2">{{$i->kind->familienaam}}</td>
                        <td class="border px-4 py-2">{{$i->kind->leerjaar->label()}}</td>
                        <td class="border px-4 py-2">{{ optional($i->kind->user->profiel)->voornaam." , ".optional($i->kind->user->profiel)->familienaam }}</td>
                        <td class="border px-4 py-2">{{optional($i->kind->user->profiel)->telefoonnummer}}</td>
                        <td class="border px-4 py-2">{{$i->kind->contactpersoon}} </td>
                    </tr>
            @endforeach

            </tbody>
        </table>

</section>
