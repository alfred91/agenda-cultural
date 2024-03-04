<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\EventManagementController;
use App\Http\Controllers\Admin\AdminRegistrationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/index', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('admin/categories', CategoryController::class);

    Route::resource('events', EventController::class);
    Route::resource('registrations', RegistrationController::class);
});

// RUTAS ADMIN:
Route::prefix('admin')->middleware(['auth', 'verified', 'role:administrador'])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/category', function () {
        return view('admin.category');
    })->name('admin.category');

    Route::get('/experiences', function () {
        return view('admin.experiences');
    })->name('admin.experiences');

    //EVENTOS:
    Route::get('/events', [EventManagementController::class, 'index'])->name('admin.events');
    Route::get('/events/{event}/edit', [EventManagementController::class, 'edit'])->name('admin.events.edit');
    Route::post('events', [EventManagementController::class, 'store'])->name('admin.events.store');
    Route::put('/events/{event}', [EventManagementController::class, 'update'])->name('admin.events.update');
    Route::put('/registrations/{id}/cancel', [AdminRegistrationController::class, 'cancel'])->name('admin.registrations.cancel');
    Route::delete('/events/{event}', [EventManagementController::class, 'destroy'])->name('admin.events.destroy');

    //INSCRIPCIONES:
    Route::get('/events/{eventId}/registrations', [AdminRegistrationController::class, 'showRegistrations'])->name('admin.events.registrations');
    Route::put('/events/{event}', [EventManagementController::class, 'update'])->name('admin.events.update');
    Route::patch('/registrations/{registration}/cancel', [AdminRegistrationController::class, 'cancel'])->name('admin.registrations.cancel');

    //EMPRESAS:
    Route::get('/company', [CompanyController::class, 'index'])->name('admin.company');
    Route::post('/company', [CompanyController::class, 'store'])->name('admin.company.store');
    Route::delete('/companies/{company}', [CompanyController::class, 'destroy'])->name('company.destroy');

    //USUARIOS:
    Route::get('/users', [UserManagementController::class, 'index'])->name('admin.users');
    Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');

    //CATEGORIAS:
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::post('/category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

    //EXPERIENCIAS:
    Route::get('/experiences', [ExperienceController::class, 'index'])->name('admin.experiences');
    Route::delete('/experiences/{experience}', [ExperienceController::class, 'destroy'])->name('admin.experiences.destroy');
    Route::post('/experiences', [ExperienceController::class, 'store'])->name('admin.experiences.store');
});


//RUTAS CREADOR EVENTOS:
Route::prefix('creator')->middleware(['auth', 'verified', 'role:creador_eventos'])->group(function () {

    Route::get('/dashboard', function () {
        return view('creator.dashboard');
    })->name('creator.dashboard');
});


require __DIR__ . '/auth.php';
