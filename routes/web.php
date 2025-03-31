<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\WorkController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsletterController;

Route::get('/', function () {
    // Si l'utilisateur est authentifié et admin, rediriger vers le tableau de bord admin
    if (Auth::check() && Auth::user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }

    // Sinon, rediriger vers le frontend
    return redirect(env('FRONTEND_URL', 'http://localhost:5173'));
});

Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// Routes d'authentification admin
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('login.post');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('logout');

// Routes admin protégées
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/panel', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('articles', ArticleController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('works', WorkController::class);

    // Ajouter une route pour la gestion des abonnés à la newsletter
    Route::get('/newsletters', [NewsletterController::class, 'index'])->name('newsletters.index');
    Route::delete('/newsletters/{newsletter}', [NewsletterController::class, 'destroy'])->name('newsletters.destroy');
});

// N'incluez pas les routes d'authentification globales si elles entrent en conflit
// require __DIR__.'/auth.php';
