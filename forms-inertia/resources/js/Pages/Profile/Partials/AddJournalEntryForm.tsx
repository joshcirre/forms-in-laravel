import { FormEventHandler } from 'react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { useForm } from '@inertiajs/react';
import { Transition } from '@headlessui/react';

export default function AddJournalEntryForm({ className = '' }: { className?: string }) {

    const { data, setData, errors, post, reset, processing, recentlySuccessful } = useForm({
        summary: '',
        notes: '',
        rating: 0,
    });

    const addJournalEntry: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('journal.store'), {
            preserveScroll: true,
            onSuccess: () => reset(),
        });
    };

    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900">Add Journal Entry</h2>
                <p className="mt-1 text-sm text-gray-600">Record your reflections for the day.</p>
            </header>

            <form onSubmit={addJournalEntry} className="mt-6 space-y-6">
                <div>
                    <InputLabel htmlFor="summary" value="Summary" />
                    <TextInput
                        id="summary"
                        value={data.summary}
                        onChange={(e) => setData('summary', e.target.value)}
                        placeholder="Describe your day in two or three words."
                        type="text"
                        className="block w-full mt-1"
                        autoFocus={!!errors.summary}
                    />
                    <InputError message={errors.summary} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="notes" value="Notes" />
                    <textarea
                        id="notes"
                        value={data.notes}
                        onChange={(e) => setData('notes', e.target.value)}
                        placeholder="What's one or two things you don't want to forget?"
                        className="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    />
                    <InputError message={errors.notes} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="rating" value="Rating" />
                    <input
                        id="rating"
                        value={data.rating}
                        onChange={(e) => setData('rating', parseInt(e.target.value, 10))}
                        type="range"
                        min={0}
                        max={10}
                        step={1}
                        className="block w-full mt-1"
                    />
                    <div className="mt-1 text-xs text-gray-600">Rating: {data.rating}</div>
                    <InputError message={errors.rating} className="mt-2" />
                </div>

                <div className="flex items-center gap-4">
                    <PrimaryButton disabled={processing}>Save</PrimaryButton>

                    <Transition
                        show={recentlySuccessful}
                        enter="transition ease-in-out"
                        enterFrom="opacity-0"
                        leave="transition ease-in-out"
                        leaveTo="opacity-0"
                    >
                        <p className="text-sm text-gray-600">Saved.</p>
                    </Transition>
                </div>
            </form>
        </section>
    );
}
