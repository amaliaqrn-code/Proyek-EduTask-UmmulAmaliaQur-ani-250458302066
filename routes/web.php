<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// AUTH
Route::get('/login', [AuthController::class, 'showLoginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [AuthController::class, 'showRegisterPage'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// MAHASISWA
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', \App\Livewire\Mahasiswa\Dashboard::class)->name('dashboard');

    // Courses
    Route::get('/courses', \App\Livewire\Mahasiswa\MyCourse::class)->name('courses.index');
    Route::get('/courses/pilih', \App\Livewire\Mahasiswa\CourseSelector::class)->name('courses.pick');
    Route::get('/courses/{course}', \App\Livewire\Mahasiswa\CourseDetail::class)->name('courses.show');

    // Assignments
    Route::get('/assignments', \App\Livewire\Mahasiswa\Assignments::class)->name('assignments.index');
    Route::get('/assignments/{id}', \App\Livewire\Mahasiswa\AssignmentDetail::class)->name('assignments.show');

    // Materials
    Route::get('/materials', \App\Livewire\Mahasiswa\Materials::class)->name('materials.index');

    // Forum
    Route::get('/forum/{course}', \App\Livewire\ForumIndex::class)->name('forum.index');
    Route::get('/forum/{course}/create', \App\Livewire\ForumCreate::class)->name('forum.create');
    Route::get('/forum/{course}/post/{thread}', \App\Livewire\ForumDetail::class)->name('forum.detail');

    // Bookmarks
    Route::get('/bookmarks', \App\Livewire\Mahasiswa\Bookmarks::class)->name('bookmarks.index');

    // Notifications
    Route::get('/notifications', \App\Livewire\Mahasiswa\Notifications::class)->name('notifications');

    // Profile
    Route::get('/profile', \App\Livewire\Mahasiswa\Profile::class)->name('profile.edit');

    // Feedback
    Route::get('/feedback', \App\Livewire\Mahasiswa\FeedbackPage::class)->name('feedback.index');
});
