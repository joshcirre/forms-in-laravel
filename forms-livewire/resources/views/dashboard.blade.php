<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <livewire:add-journal-entry />
                </div>
                @foreach ($journals as $journal)
                    <div class="p-6 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 text-sm text-gray-500">
                                {{ $journal->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="mt-2 text-lg text-gray-900">
                            {{ $journal->summary }}
                        </div>
                        <div class="mt-2 text-sm text-gray-500">
                            {{ $journal->notes }}
                        </div>
                        <div class="flex items-center mt-2">
                            <div class="flex-shrink-0">
                                ⭐
                            </div>
                            <div class="ml-3 text-sm text-gray-500">
                                {{ $journal->rating }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
