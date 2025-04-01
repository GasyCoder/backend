<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    // Dans votre contrôleur AdminNewsletterController
    public function index()
    {
        // Récupérer uniquement les abonnés vérifiés (confirmed_at n'est pas null)
        $subscribers = Newsletter::whereNotNull('verified_at')
                            ->orderBy('created_at', 'desc')
                            ->paginate(20);

        return view('admin.newsletters.index', compact('subscribers'));
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return redirect()->route('admin.newsletters.index')
            ->with('success', 'Abonné supprimé avec succès.');
    }
}
