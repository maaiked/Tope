<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{--            Toon enkel aan ouders: --}}
            @if(!Auth::user()->isAdmin && !Auth::user()->isAnimator)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                    <div class="p-6 text-gray-900">
                        <p class="text-lg h-2"> {{ "Welkom bij Tope " . optional(Auth::user()->profiel)->voornaam  }} </p>
                        <p class="mt-4">Nieuw? Vul eerst je <a href="/profiel" class="font-bold underline">profiel</a> aan.</p>
                        <p>Daarna kan je je <a href="/kinderen" class="font-bold underline">kinderen</a> toevoegen.</p>
                        <p>Bekijk dan de <a href="/activiteiten" class="font-bold underline">activiteiten</a> en schrijf
                            in!</p>
                    </div>
                </div>

            @endif

            {{--      Toon aan ouders en animator : --}}
            @if(!Auth::user()->isAdmin)

            @if($text !== null)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                        <div class="p-6 text-gray-900 trix-content">
                            {!! $text->trixRender('content') !!}
                        </div>
                    </div>
            @endif

                {{--            Toon enkel aan admin: --}}
            @elseif(Auth::user()->isAdmin)

                @if($text === null)
                    <p>Geef hieronder de tekst in die je op het dashboard wilt laten verschijnen bij elke ingelogde user</p>
                <form method="POST" action="{{ route('text.store') }}">
                    @csrf
                    @trix(\App\Text::class, 'content')
                    <input type="submit">
                </form>

                @else
                    <p>Pas hieronder de tekst aan die getoond wordt op het dashboard van elke ingelogde user</p>
                    <form method="POST" action="{{ route('text.store') }}">
                        @csrf
                        @trix($text, 'content')
                        <input type="submit">
                    </form>

                @endif
            @endif
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" />
    @endpush

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js" defer></script>
    @endpush

</x-app-layout>
