<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\UserEventController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\User\UserCategoryController;
use App\Http\Controllers\User\UserExperienceController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Creator\CreatorEventController;
use App\Http\Controllers\Admin\EventManagementController;
use App\Http\Controllers\User\UserRegistrationController;
use App\Http\Controllers\Admin\AdminRegistrationController;
use App\Http\Controllers\Creator\CreatorRegistrationController;

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// RUTAS USUARIOS:
Route::middleware(['auth', 'verified', 'role:asistente'])->group(function () {

    Route::get('/', [UserEventController::class, 'index'])->name('user.index');
    Route::get('/agenda', [UserEventController::class, 'agenda'])->name('user.agenda');
    Route::get('/agenda/{period}', [UserEventController::class, 'index'])->name('user.agenda.filter');
    Route::get('/events/{event}', [UserEventController::class, 'show'])->name('user.event');

    // CATEGORÍAS
    Route::get('categories', [UserCategoryController::class, 'index'])->name('user.categories');
    Route::get('categories/{categoryId}', [UserCategoryController::class, 'show'])->name('user.categories.show');

    // EXPLORA
    Route::get('/explore', function () {
        return view('user.explore');
    })->name('user.explore');

    // EXPERIENCIAS
    Route::get('experiences', [UserExperienceController::class, 'index'])->name('user.experiences');
    Route::get('experiences/{id}', [UserExperienceController::class, 'show'])->name('user.experiences.show');

    // INSCRIPCIONES
    Route::get('registrations', [UserRegistrationController::class, 'index'])->name('user.registrations.index');
    Route::get('registrations/create/{eventId}', [UserRegistrationController::class, 'create'])->name('user.registrations.create');
    Route::post('registrations', [UserRegistrationController::class, 'store'])->name('user.registrations.store');
});


// RUTAS ADMIN:
Route::prefix('admin')->middleware(['auth', 'verified', 'role:administrador'])->group(function () {

    //EVENTOS:
    Route::get('/events', [EventManagementController::class, 'index'])->name('admin.events');
    Route::get('/events/{event}/edit', [EventManagementController::class, 'edit'])->name('admin.events.edit');
    Route::post('events', [EventManagementController::class, 'store'])->name('admin.events.store');
    Route::put('/events/{event}', [EventManagementController::class, 'update'])->name('admin.events.update');
    Route::delete('/events/{event}', [EventManagementController::class, 'destroy'])->name('admin.events.destroy');

    //INSCRIPCIONES:
    Route::get('/events/{eventId}/registrations', [AdminRegistrationController::class, 'index'])->name('admin.events.registrations');
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
    Route::get('/experiences/{experience}/edit', [ExperienceController::class, 'edit'])->name('admin.experiences.edit');
    Route::post('/experiences', [ExperienceController::class, 'store'])->name('admin.experiences.store');
    Route::put('/experiences/{experience}', [ExperienceController::class, 'update'])->name('admin.experiences.update');
    Route::delete('/experiences/{experience}', [ExperienceController::class, 'destroy'])->name('admin.experiences.destroy');
});


//RUTAS CREADOR EVENTOS:
Route::prefix('creator')->middleware(['auth', 'verified', 'role:creador_eventos'])->group(function () {

    //EVENTOS:
    Route::get('/events', [CreatorEventController::class, 'index'])->name('creator.events');
    Route::get('/events/{event}/edit', [CreatorEventController::class, 'edit'])->name('creator.events.edit');
    Route::post('events', [CreatorEventController::class, 'store'])->name('creator.events.store');
    Route::put('/events/{event}', [CreatorEventController::class, 'update'])->name('creator.events.update');
    Route::delete('/events/{event}', [CreatorEventController::class, 'destroy'])->name('creator.events.destroy');

    //INSCRIPCIONES:
    Route::get('/events/{eventId}/registrations', [CreatorRegistrationController::class, 'index'])->name('creator.events.registrations');
    Route::patch('/registrations/{registration}/cancel', [CreatorRegistrationController::class, 'cancel'])->name('creator.registrations.cancel');
});


require __DIR__ . '/auth.php';
