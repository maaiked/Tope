<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
       @if (!auth()->user()->isAdmin) <form method="POST" action="{{ route('kinderen.store') }}">
            @csrf
            <textarea
                name="name"
                placeholder="{{ __('Geef de naam van je kind op') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('name') }}</textarea>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Voeg toe') }}</x-primary-button>
        </form>
        @endif
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($kinderen as $kind)
                <div class="p-3 flex space-x-2">
                    <div class="flex-1">
                        <p class="mt-4 text-lg text-gray-900">{{ $kind->name }} - Ouder: {{ $kind->user->name }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        @if (auth()->user()->isAdmin)
        {{ $kinderen->links() }}
        @endif
    </div>
</x-app-layout>
