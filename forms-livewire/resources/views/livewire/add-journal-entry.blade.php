<div x-data="{ rating: 0 }">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add Journal Entry') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Record your reflections for the day.') }}
        </p>
    </header>
    <form wire:submit='save' class="mt-6 space-y-6">
        <div>
            <x-input-label for="summary" :value="__('Summary')" />
            <x-text-input id="summary" name="summary" type="text" class="block w-full mt-1"
                placeholder="Describe your day in two or three words." wire:model='form.summary' />
            <x-input-error :messages="$errors->get('form.summary')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="notes" :value="__('Notes')" />
            <textarea id="notes" name="notes" placeholder="What's one or two things you don't want to forget?"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                wire:model='form.notes'></textarea>
            <x-input-error :messages="$errors->get('form.notes')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="rating" :value="__('Rating')" />
            <input id="rating" name="rating" type="range" min="0" max="10" step="1"
                class="block w-full mt-1" x-model="rating" wire:model='form.rating' />
            <div class="mt-1 text-xs text-gray-600">Rating: <span x-text="rating"></span></div>
            <x-input-error :messages="$errors->get('form.rating')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>

            <x-action-message class="me-3" on="journal-added">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</div>
