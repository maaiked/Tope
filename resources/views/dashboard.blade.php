<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <p class="text-lg h-2"> {{ "Welkom bij Tope " . optional(Auth::user()->profiel)->voornaam  }} </p>
                </div>
            </div>
{{--            Toon enkel aan ouders: --}}
            @if(!Auth::user()->isAdmin && !Auth::user()->isAnimator)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 text-gray-900">
                   <p>Nieuw? Vul eerst je <a href="/profiel" class="font-bold underline">profiel</a> aan.</p>
                    <p>Daarna kan je je <a href="/kinderen" class="font-bold underline">kinderen</a> toevoegen.</p>
                    <p>Bekijk dan de <a href="/activiteiten" class="font-bold underline">activiteiten</a> en schrijf in!</p>
                </div>
            </div>
            @elseif(Auth::user()->isAdmin)
                <form method="POST" >
                        @csrf
                        @method('POST')
                    <div>
                        <p>TRIX</p>
                        <input id="x" type="hidden" name="content">
                        <trix-editor input="x"></trix-editor>
                    </div>
                    <div>
                        <label for="myeditorinstance"> TinyMCE
                        </label>
                        <textarea id="myeditorinstance">Hello, World!</textarea>
                    </div>
                </form>


            @endif
        </div>
    </div>


{{--    TRIX --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

{{--    Tiny MCE--}}





    <script src="https://cdn.tiny.cloud/1/8ta7ifv5jhlvbfs4pblibf8qblmnzbr5f8gtywf4rx7fcmw5/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'powerpaste advcode table lists checklist emoticons image link lists media searchreplace visualblocks mediaembed',
            toolbar: 'undo redo | blocks fontfamily fontsize backcolor forecolor | bold italic underline | bullist numlist checklist | code | table link image media | emoticons'
        });
    </script>

</x-app-layout>
