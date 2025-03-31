<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use App\Notifications\NewsletterConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletters,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Cette adresse email est déjà inscrite ou invalide.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Créer un nouvel enregistrement en utilisant les colonnes correctes
        $newsletter = Newsletter::create([
            'email' => $request->email,
            // verified_at sera null par défaut
        ]);

        // Envoyer la notification
        $newsletter->notify(new NewsletterConfirmation($newsletter));

        return response()->json([
            'success' => true,
            'message' => 'Vous êtes maintenant pré-inscrit à la newsletter ! Veuillez vérifier votre email pour confirmer votre inscription.',
        ]);
    }

    public function verify($code)
    {
        $newsletter = Newsletter::where('verification_code', $code)->first();

        if (!$newsletter) {
            return view('newsletter.verification-failed');
        }

        $newsletter->verified_at = now();
        $newsletter->save();

        return view('newsletter.verification-success');
    }
}
