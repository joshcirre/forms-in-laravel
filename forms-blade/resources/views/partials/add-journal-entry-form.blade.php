<section x-data="{ rating: {{ old('rating', 0) }} }">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add Journal Entry') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Record your reflections for the day.') }}
        </p>
    </header>

    <form method="POST" action="{{ route('journal.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="summary" :value="__('Summary')" />
            <x-text-input id="summary" name="summary" type="text" class="block w-full mt-1" :value="old('summary')"
                placeholder="Describe your day in two or three words." />
            <x-input-error :messages="$errors->get('summary')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="notes" :value="__('Notes')" />
            <textarea id="notes" name="notes" placeholder="What's one or two things you don't want to forget?"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('notes') }}</textarea>
            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="rating" :value="__('Rating')" />
            <input id="rating" name="rating" type="range" min="0" max="10" step="1"
                class="block w-full mt-1" x-model="rating" />
            <div class="mt-1 text-xs text-gray-600">Rating: <span x-text="rating">{{ old('rating', 0) }}</span></div>
            <x-input-error :messages="$errors->get('rating')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'journal-added')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
