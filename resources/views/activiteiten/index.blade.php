<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

        @if (auth()->user()->isAdmin)
        <form method="POST" action="{{ route('activiteiten.store') }}">
            @csrf
            <textarea
                name="message"
                placeholder="{{ __('Geef de naam van de nieuwe activiteit') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Voeg toe') }}</x-primary-button>
        </form>
        @endif
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($activiteiten as $activiteit)
                <div class="p-3 flex space-x-0">
                    <div class="flex-1">
                        <p class="mt-4 text-lg text-gray-900">{{ $activiteit->message }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $activiteiten->links() }}
    </div>
</x-app-layout>
