<section class="space-y-6">
    @foreach($inschrijvingen->first()->activiteit->opties as $opties)
        <h1 class="font-semibold underline text-xl text-gray-800 leading-tight">{{$opties->omschrijving}}</h1>
        <table id="example" class="bootstrap-table text-left" style="width:100%; padding-bottom: 1em;">
            <thead>
            <tr>
                <th class="border px-4 py-2">Voornaam</th>
                <th class="border px-4 py-2">Familienaam</th>
                <th class="border px-4 py-2">Leerjaar</th>
                <th class="border px-4 py-2">Optie</th>
                <th class="border px-4 py-2">Afhalen</th>
                <th class="border px-4 py-2">Alleen naar huis</th>
                <th class="border px-4 py-2">Foto</th>
            </tr>
            </thead>
            <tbody>
                @foreach($inschrijvingen as $i)
                    @foreach($i->inschrijvingsdetail_opties as $o)
                        @if($o->optie == $opties)
                        <tr>
                            <td class="border px-4 py-2">{{$i->kind->voornaam}}</td>
                            <td class="border px-4 py-2">{{$i->kind->familienaam}}</td>
                            <td class="border px-4 py-2">{{$i->kind->leerjaar}}</td>
                            <td class="border px-4 py-2">{{ $o->optie->omschrijving }}</td>
                            <td class="border px-4 py-2">{{$i->kind->afhalenKind}}</td>
                            <td class="border px-4 py-2">@if($i->kind->alleenNaarHuis) ja @else nee @endif</td>
                            <td class="border px-4 py-2">@if($i->kind->fotoToestemming) ja @else <p class="text-red-600">nee</p> @endif</td>
                        </tr>
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endforeach
</section>
