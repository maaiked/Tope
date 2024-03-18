<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            {{--@if (auth()->user()->isAdmin)--}}
            @foreach ($inschrijvingsdetails as $inschrijvingsdetail)
                <div class="p-3 flex space-x-0">
                    <div class="flex-1">
                        <p class="mt-4 text-lg text-gray-900">{{ $inschrijvingsdetail->activiteit->message . " kind:" . $inschrijvingsdetail->kind->name . " ouder:" . $inschrijvingsdetail->kind->user->name }}</p>
                    </div>
                </div>
            @endforeach
            {{--@endif--}}
        </div>
        {{ $inschrijvingsdetails->links() }}
    </div>
</x-app-layout>
