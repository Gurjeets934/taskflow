<?php
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $user = Auth::user();

    $projects = $user->projects()->with('tasks')->get();

    $total = $projects->count();
    $completed = $projects->where('status', 'completed')->count();
    $pending = $projects->where('status', 'pending')->count();

    $totalTasks = $projects->flatMap->tasks->count();

    $completedTasks = $projects->flatMap->tasks
                        ->where('is_completed', true)
                        ->count();

    $percentage = $totalTasks > 0
        ? round(($completedTasks / $totalTasks) * 100)
        : 0;

    return view('dashboard', compact(
        'total',
        'completed',
        'pending',
        'totalTasks',
        'completedTasks',
        'percentage'
    ));

})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('projects', ProjectController::class);
});

Route::resource('projects.tasks', TaskController::class)
    ->middleware('auth');

require __DIR__.'/auth.php';
