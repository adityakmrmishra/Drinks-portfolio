<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Home route
Route::get('/', function () {
    return view('home');
});

// Handle the default /home redirect after registration
Route::get('/home', function () {
    return redirect('/dashboard');
})->name('home');

// Auth routes (already provided by Laravel UI)
Auth::routes();

// After login, redirect to dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Toggle admin status
Route::get('/toggle-admin/{id}', function ($id) {
    // Only admins can change roles
    if (!Auth::user()->is_admin) {
        return redirect()->back()->with('error', 'You do not have permission to perform this action.');
    }
    
    // Don't allow changing your own status
    if ($id == Auth::id()) {
        return redirect()->back()->with('error', 'You cannot change your own admin status.');
    }
    
    $user = User::find($id);
    if ($user) {
        $user->is_admin = !$user->is_admin;
        $user->save();
        
        $newRole = $user->is_admin ? 'Admin' : 'User';
        return redirect()->back()->with('status', "User {$user->name} role changed to {$newRole}.");
    }
    
    return redirect()->back()->with('error', 'User not found.');
})->middleware(['auth', 'admin'])->name('toggle.admin');

// Profile routes
Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Settings routes
    Route::prefix('settings')->group(function () {
        // General Settings
        Route::get('/', [SettingsController::class, 'index'])->name('settings');
        Route::put('/', [SettingsController::class, 'update'])->name('settings.update');
        
        // Password Settings
        Route::get('/password', [SettingsController::class, 'showPassword'])->name('settings.password');
        Route::put('/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update');
        
        // Notification Settings
        Route::get('/notifications', [SettingsController::class, 'showNotifications'])->name('settings.notifications');
        Route::put('/notifications', [SettingsController::class, 'updateNotifications'])->name('settings.notifications.update');
        
        // Privacy Settings
        Route::get('/privacy', [SettingsController::class, 'showPrivacy'])->name('settings.privacy');
        Route::put('/privacy', [SettingsController::class, 'updatePrivacy'])->name('settings.privacy.update');
    });
});

// Product routes for users
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// About and Contact Routes
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about.index');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// Admin routes
Route::middleware(['auth'])->group(function () {
    Route::middleware([\App\Http\Middleware\AdminMiddleware::class])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            // Admin dashboard route
            Route::get('/', function () {
                $users = \App\Models\User::all();
                return view('admin.dashboard', compact('users'));
            })->name('dashboard');
            
            // Admin product routes
            Route::prefix('products')->name('products.')->group(function () {
                Route::get('/', [ProductController::class, 'adminIndex'])->name('index');
                Route::get('/create', [ProductController::class, 'create'])->name('create');
                Route::post('/', [ProductController::class, 'store'])->name('store');
                Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
                Route::put('/{product}', [ProductController::class, 'update'])->name('update');
                Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
                
                // Debug route for product images
                Route::get('/debug-images', function () {
                    return view('admin.products.debug');
                })->name('debug-images');
            });
            
            // Admin contacts routes
            Route::prefix('contacts')->name('contacts.')->group(function () {
                Route::get('/', [App\Http\Controllers\Admin\ContactController::class, 'index'])->name('index');
                Route::get('/{contact}', [App\Http\Controllers\Admin\ContactController::class, 'show'])->name('show');
                Route::patch('/{contact}/toggle-read', [App\Http\Controllers\Admin\ContactController::class, 'toggleRead'])->name('toggle-read');
                Route::delete('/{contact}', [App\Http\Controllers\Admin\ContactController::class, 'destroy'])->name('destroy');
            });
            
            // Admin users
            Route::prefix('users')->name('users.')->group(function () {
                Route::get('/', function () {
                    $users = \App\Models\User::paginate(10);
                    return view('admin.users.index', compact('users'));
                })->name('index');
                
                Route::get('/{id}/edit', function ($id) {
                    $user = \App\Models\User::findOrFail($id);
                    return view('admin.users.edit', compact('user'));
                })->name('edit');
                
                Route::put('/{id}', function (Request $request, $id) {
                    $user = \App\Models\User::findOrFail($id);
                    
                    $validated = $request->validate([
                        'name' => 'required|string|max:255',
                        'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
                        'password' => 'nullable|string|min:8|confirmed',
                    ]);
                    
                    $user->name = $validated['name'];
                    $user->email = $validated['email'];
                    
                    if (!empty($validated['password'])) {
                        $user->password = Hash::make($validated['password']);
                    }
                    
                    $user->is_admin = $request->has('is_admin');
                    $user->save();
                    
                    return redirect()->route('admin.users.index')
                        ->with('status', 'User updated successfully');
                })->name('update');
                
                Route::delete('/{id}', function ($id) {
                    if ($id == Auth::id()) {
                        return redirect()->route('admin.users.index')
                            ->with('error', 'You cannot delete your own account.');
                    }
                    
                    $user = \App\Models\User::findOrFail($id);
                    $name = $user->name;
                    $user->delete();
                    
                    return redirect()->route('admin.users.index')
                        ->with('status', "User '{$name}' has been deleted successfully.");
                })->name('destroy');
                
                // Debug route to see raw user data
                Route::get('/debug', function () {
                    $users = \App\Models\User::all();
                    return view('admin.users.debug', compact('users'));
                })->name('debug');
            });
        });
});

// Database Viewer
Route::middleware(['auth', 'admin'])->get('/database-view', function () {
    $users = DB::table('users')->get();
    return view('admin.database-view', compact('users'));
})->name('database.view');