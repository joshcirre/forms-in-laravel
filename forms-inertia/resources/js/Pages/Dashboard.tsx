import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage } from '@inertiajs/react';
import { PageProps } from '@/types';
import AddJournalEntryForm from './Profile/Partials/AddJournalEntryForm';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';

dayjs.extend(relativeTime);

export default function Dashboard() {
    const { auth, journals } = usePage<PageProps>().props;

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                             <AddJournalEntryForm  />
                        </div>
                        {journals.map((journal) => (
                            <div key={journal.id} className="p-6 border-t border-gray-200">
                                <div className="flex items-center justify-between">
                                    <div className="flex-1 text-sm text-gray-500">
                                        {dayjs(journal.created_at).fromNow()}
                                    </div>
                                </div>
                                <div className="mt-2 text-lg text-gray-900">
                                    {journal.summary}
                                </div>
                                <div className="mt-2 text-sm text-gray-500">
                                    {journal.notes}
                                </div>
                                <div className="flex items-center mt-2">
                                    <div className="flex-shrink-0">
                                        ⭐
                                    </div>
                                    <div className="ml-3 text-sm text-gray-500">
                                        {journal.rating}
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
