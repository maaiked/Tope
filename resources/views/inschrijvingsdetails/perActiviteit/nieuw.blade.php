<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nieuwe inschrijving voor activiteit: id ').$activiteit->id." - ".$activiteit->naam }}
        </h2>
        <p>{{ $activiteit->locatie->naam." : van ".Carbon\Carbon::parse($activiteit->starttijd)->format('d-m-Y')." tot ".Carbon\Carbon::parse($activiteit->eindtijd)->format('d-m-Y')}}</p>
        <p>{{$activiteit->leerjaarVanaf->label()." - ".$activiteit->leerjaarTot->label()}}</p>
        <p>{{$activiteit->omschrijving}}</p>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        {{--                TODO:: fix small screen colums--}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6 gap-4 gap-y-2 text-sm">
               <form method="POST" action="{{ route('inschrijvingsdetail.store') }}" >
                    @csrf
                    <h1 class="font-bold text-xl">Nieuwe inschrijving</h1>
                   <h2>Let op: enkel kinderen die voldoen aan de leeftijdsvoorwaarde worden getoond.</h2>

                   <input type="hidden" name="activiteit" value="{{ $activiteit->id }}" />
                   <div class="mt-4">
                       <label for="kind">Selecteer kind</label>
                       <select name="kindid" id="kindid" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                           @foreach($kinderen as $kind)
                               <option value="{{ $kind->id }}" @selected(old('kind', $kind))>
                                   {{ $kind->voornaam." ".$kind->familienaam." - ".$kind->leerjaar->label()." - RR: ".$kind->rijksregisternummer." - UP: ".$kind->uitpasnummer." - adres: ".optional($kind->user->profiel)->straat." ".optional($kind->user->profiel)->huisnummer." - ".optional($kind->user->profiel)->bus." , ".optional($kind->user->profiel)->gemeente.". Ouder: ".optional($kind->user->profiel)->voornaam." ".optional($kind->user->profiel)->familienaam }}</option>
                           @endforeach
                       </select>
                       <x-input-error :messages="$errors->get('kind')" class="mt-2"/>
                   </div>
                   <input type="hidden" name="prijs" value="{{ $activiteit->prijs }}" />
                   <p class="mt-4">{{ "Prijs activiteit: €".$activiteit->prijs }}</p>
                   @foreach($activiteit->opties as $optie)
                   <div class="mt-4">
                       <input type="checkbox" name={{$optie->omschrijving}} id={{$optie->omschrijving}} class="checkbox" value="{{$optie->prijs}}" />
                       <label for="{{$optie->omschrijving}}" class=" text-md text-gray-900">
                           {{ $optie->omschrijving.": € ".$optie->prijs}}</label>
                   </div>
                   @endforeach

                   <button
                       class="rounded-md bg-blue-600 text-white focus:ring-blue-400 px-4 py-2 text-sm mt-4"
                       type="submit" name="action" value="inschrijven">
                       inschrijven
                   </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
