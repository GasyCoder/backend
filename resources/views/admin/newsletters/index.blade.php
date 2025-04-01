@extends('layouts.admin')

@section('title', 'Abonnés à la newsletter')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">Abonnés confirmés à la newsletter</h2>
        <a href="#" onclick="exportToCSV()" class="bg-green-600 hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-800 text-white py-2 px-4 rounded">
            <i class="fas fa-download mr-1"></i> Exporter en CSV
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded shadow overflow-hidden">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <p class="text-gray-700 dark:text-gray-200">Total: <span class="font-semibold">{{ $subscribers->total() }}</span> abonnés confirmés</p>
        </div>

        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date d'inscription</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date de confirmation</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($subscribers as $subscriber)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-gray-100">{{ $subscriber->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $subscriber->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $subscriber->verified_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <form action="{{ route('admin.newsletters.destroy', $subscriber) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet abonné ?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            Aucun abonné confirmé trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $subscribers->links() }}
    </div>
@endsection

@push('scripts')
    <script>
        function exportToCSV() {
            // Fonction pour télécharger la liste en CSV
            const subscribers = @json($subscribers->items());

            if (subscribers.length === 0) {
                alert('Aucune donnée à exporter.');
                return;
            }

            // Créer l'en-tête CSV
            let csvContent = "Email,Date d'inscription,Date de confirmation\n";

            // Ajouter chaque abonné
            subscribers.forEach(subscriber => {
                const inscriptionDate = new Date(subscriber.created_at).toLocaleDateString('fr-FR');
                const confirmationDate = new Date(subscriber.verified_at).toLocaleDateString('fr-FR');
                csvContent += `${subscriber.email},"${inscriptionDate}","${confirmationDate}"\n`;
            });

            // Créer un blob et télécharger
            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.setAttribute('href', url);
            link.setAttribute('download', 'abonnés-newsletter-confirmés.csv');
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
@endpush
