<!DOCTYPE html>
<html>
<head>
    <title>Vérification échouée</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto px-4 py-16 max-w-lg">
        <div class="bg-gray-800 rounded-lg shadow-lg p-8 border border-red-500/20">
            <div class="flex items-center justify-center mb-6 text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold mb-4 text-center">Vérification échouée</h1>
            <p class="text-gray-300 mb-6 text-center">Le lien de confirmation n'est pas valide ou a expiré.</p>
            <p class="text-gray-400 mb-8 text-center">Veuillez vous réinscrire pour recevoir un nouveau lien de confirmation.</p>
            <div class="flex justify-center">
                <a href="/" class="px-4 py-2 bg-gradient-to-r from-red-600 to-purple-600 rounded-md text-white font-medium hover:opacity-90 transition-opacity">
                    Retour à l'accueil
                </a>
            </div>
        </div>
    </div>
</body>
</html>
