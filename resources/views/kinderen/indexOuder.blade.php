<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

            @foreach ($kinderen as $kind)
            <div class="mt-6 bg-grey shadow-sm rounded-lg divide-y">
                <div class="p-3 flex space-x-2">
                    <div class="flex-1">
                        <p class="mt-4 text-lg text-gray-900">{{ $kind->voornaam }}</p>
{{--                        TODO: bewerk knop weergeven naar edit/{id}--}}
                    </div>
                </div>
            </div>
            @endforeach
    </div>
</x-app-layout>
