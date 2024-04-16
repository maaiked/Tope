<section class="space-y-6">
    <p> partial test</p>

    @foreach($inschrijvingen as $i)
        {{$i->kind->voornaam}}
    @endforeach
</section>
