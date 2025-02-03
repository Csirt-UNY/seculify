<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTestController;
use App\Http\Controllers\AdminAttemptController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminConfigController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminTestController;
use App\Http\Controllers\AdminQuestionController;
use App\Http\Controllers\AdminUserController;

use App\Http\Controllers\CreatorController;
use App\Http\Controllers\CreatorCategoryController;
use App\Http\Controllers\CreatorTestController;
use App\Http\Controllers\CreatorQuestionController;

use App\Models\Config;
use App\Http\Controllers\Auth\GoogleAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->isUser()) {
            return to_route('user');
        }
    }
    $video = Config::where('key', 'tutorial_video')->first();
    return view('index', compact('video'));
});

Route::middleware(['middleware' => 'PreventBackHistory'])->group(function () {
    Auth::routes();
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// User routes
Route::group(['prefix' => 'user', 'middleware' => ['isUser', 'auth', 'PreventBackHistory']], function () {
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('profile', [UserController::class, 'editProfile'])->name('user.profile.update');
    Route::put('firstUpdate', [UserController::class, 'firstProfile'])->name('user.profile.firstUpdate');
    Route::put('change-password', [UserController::class, 'changePassword'])->name('user.password.update');
    Route::group(['middleware' => ['CompleteProfile']], function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::get('tests', [UserTestController::class, 'index'])->name('user.tests');
        Route::post('start/{test_id}', [UserTestController::class, 'start'])->name('user.start');
        Route::get('do-test/{attempt_id}', [UserTestController::class, 'doTest'])->name('user.doTest');
        Route::post('answer/{score_id}/{answer}', [UserTestController::class, 'answer'])->name('user.answer');
        Route::get('finish/{attempt_id}', [UserTestController::class, 'finish'])->name('user.finish');
        Route::get('attempts', [UserTestController::class, 'attempts'])->name('user.attempts');
        Route::get('attempts/{attempt_id}', [UserTestController::class, 'showAttempts'])->name('user.attempts.show');
    });
});

// Admin routes
Route::group((['prefix' => 'admin', 'middleware' => ['isAdmin', 'auth', 'PreventBackHistory']]), function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::resource('users', AdminUserController::class)->names([
        'index' => 'admin.users',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'show' => 'admin.users.show',
        'destroy' => 'admin.users.delete',
    ]);
    Route::resource('categories', AdminCategoryController::class)->names([
        'index' => 'admin.categories',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'show' => 'admin.categories.show',
        'destroy' => 'admin.categories.delete',
    ]);
    Route::resource('tests', AdminTestController::class)->names([
        'index' => 'admin.tests',
        'create' => 'admin.tests.create',
        'store' => 'admin.tests.store',
        'edit' => 'admin.tests.edit',
        'update' => 'admin.tests.update',
        'show' => 'admin.tests.show',
        'destroy' => 'admin.tests.delete',
    ]);
    Route::resource('/{test}/quests', AdminQuestionController::class)->names([
        'index' => 'admin.quests',
        'create' => 'admin.quests.create',
        'store' => 'admin.quests.store',
        'edit' => 'admin.quests.edit',
        'update' => 'admin.quests.update',
        'show' => 'admin.quests.show',
        'destroy' => 'admin.quests.delete',
    ]);
    Route::resource('attempts', AdminAttemptController::class)->names([
        'index' => 'admin.attempts',
        'create' => 'admin.attempts.create',
        'store' => 'admin.attempts.store',
        'edit' => 'admin.attempts.edit',
        'update' => 'admin.attempts.update',
        'show' => 'admin.attempts.show',
        'destroy' => 'admin.attempts.delete',
    ]);
    Route::resource('configs', AdminConfigController::class)->names([
        'index' => 'admin.configs',
        'create' => 'admin.configs.create',
        'store' => 'admin.configs.store',
        'edit' => 'admin.configs.edit',
        'update' => 'admin.configs.update',
        'show' => 'admin.configs.show',
        'destroy' => 'admin.configs.delete',
    ]);
});

// Creator routes
Route::group((['prefix' => 'creator', 'middleware' => ['isCreator', 'auth', 'PreventBackHistory']]), function () {
    Route::get('/', [CreatorController::class, 'index'])->name('creator');
    Route::resource('categories', CreatorCategoryController::class)->names([
        'index' => 'creator.categories',
        'create' => 'creator.categories.create',
        'store' => 'creator.categories.store',
        'edit' => 'creator.categories.edit',
        'update' => 'creator.categories.update',
        'show' => 'creator.categories.show',
        'destroy' => 'creator.categories.delete',
    ]);
    Route::resource('tests', CreatorTestController::class)->names([
        'index' => 'creator.tests',
        'create' => 'creator.tests.create',
        'store' => 'creator.tests.store',
        'edit' => 'creator.tests.edit',
        'update' => 'creator.tests.update',
        'show' => 'creator.tests.show',
        'destroy' => 'creator.tests.delete',
    ]);
    Route::resource('/{test}/quests', CreatorQuestionController::class)->names([
        'index' => 'creator.quests',
        'create' => 'creator.quests.create',
        'store' => 'creator.quests.store',
        'edit' => 'creator.quests.edit',
        'update' => 'creator.quests.update',
        'show' => 'creator.quests.show',
        'destroy' => 'creator.quests.delete',
    ]);
});

// Google
Route::get('auth/redirect', [GoogleAuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
