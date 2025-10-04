<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ReflectionController;
use App\Http\Controllers\AdminQuizController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
use App\Models\Laporan;
use App\Models\QuizResult;
use App\Models\Reflection;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Dashboard (butuh login)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $laporanCount   = Laporan::count();
    $quizCount      = QuizResult::count();
    $reflectionCount= Reflection::count();

    return view('dashboard', compact('laporanCount','quizCount','reflectionCount'));
})->name('dashboard')->middleware('auth');


/*
|--------------------------------------------------------------------------
| Routes untuk User (butuh login) - Laporan Milik Sendiri
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::resource('laporan', LaporanController::class);


    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
    Route::get('/quiz/{quiz}', [QuizController::class, 'show'])->name('quiz.show');
    Route::post('/quiz/{quiz}/submit', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::get('/quiz/user/stats', [QuizController::class, 'userStats'])->name('quiz.userStats');
    Route::get('/quiz/{id}/preview', [AdminQuizController::class, 'preview'])->name('quiz.preview');


    // Refleksi
    Route::get('/reflections', [ReflectionController::class, 'index'])->name('reflections.index');
    Route::get('/reflections/create', [ReflectionController::class, 'create'])->name('reflections.create');
    Route::post('/reflections', [ReflectionController::class, 'store'])->name('reflections.store');
    Route::get('/reflections/{reflection}', [ReflectionController::class, 'show'])->name('reflections.show');
    Route::get('/reflections/{reflection}/edit', [ReflectionController::class, 'edit'])->name('reflections.edit');
    Route::put('/reflections/{reflection}', [ReflectionController::class, 'update'])->name('reflections.update');
    Route::delete('/reflections/{reflection}', [ReflectionController::class, 'destroy'])->name('reflections.destroy');
});


/*
|--------------------------------------------------------------------------
| Routes untuk Admin - Mengelola Semua Data
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth', RoleMiddleware::class.':admin'])
    ->name('admin.')
    ->group(function () {
        // Dalam group admin

    // Kelola Semua Laporan (dari semua user)
    Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{laporan}', [AdminLaporanController::class, 'show'])->name('laporan.show');
    // Dalam group admin
    Route::patch('/laporan/{laporan}/status', [AdminLaporanController::class, 'updateStatus'])->name('laporan.updateStatus');
    Route::delete('/laporan/{laporan}', [AdminLaporanController::class, 'destroy'])->name('laporan.destroy');

    // Dalam group admin
    Route::get('/quiz', [AdminQuizController::class, 'index'])->name('quiz.index');
    Route::get('/quiz/create', [AdminQuizController::class, 'create'])->name('quiz.create');
    Route::post('/quiz/store', [AdminQuizController::class, 'store'])->name('quiz.store');
    Route::get('/quiz/{id}/edit', [AdminQuizController::class, 'edit'])->name('quiz.edit');
    Route::put('/quiz/{id}', [AdminQuizController::class, 'update'])->name('quiz.update');
    Route::delete('/quiz/{id}', [AdminQuizController::class, 'destroy'])->name('quiz.destroy');
    Route::post('/quiz/{id}/toggle-status', [AdminQuizController::class, 'toggleStatus'])->name('quiz.toggleStatus');

    // Kelola User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    // Dalam group admin, tambahkan route ini:
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
