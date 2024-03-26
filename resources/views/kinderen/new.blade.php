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
