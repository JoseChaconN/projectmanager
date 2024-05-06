<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\TaskController;
use App\Models\Project;
use App\Models\Step;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->resource('project', ProjectController::class);
Route::middleware('auth')->resource('stage', StageController::class);
Route::middleware('auth')->resource('step', StepController::class);
Route::middleware('auth')->resource('activity', ActivityController::class);
#Route::middleware('auth')->resource('task', TaskController::class);
Route::middleware(['auth', 'verified'])->prefix('project-tasks')->group(function () {
    Route::get('', [TaskController::class, 'index'])->name('task.index');
    Route::get('{project}/tasks', [TaskController::class, 'create'])->name('task.create');
    Route::post('', [TaskController::class, 'store'])->name('task.store');
    Route::get('{task}/edit', [TaskController::class, 'edit'])->name('task.edit')->middleware(['auth', 'verified']);
    Route::match(['put', 'patch'], '/{task}', [TaskController::class, 'update'])->name('task.update');
    //Route::get('/items-reception', [TaskController::class, 'items_reception'])->name('property-reception.items');
    //Route::post('/upload-image', [TaskController::class, 'upload_image'])->name('property-reception.upload.image');
    #Route::delete('{property_reception}/delete', 'TaskController@delete')->name('property-reception.delete');
});
require __DIR__.'/auth.php';
