<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\OperativeController;
use App\Http\Controllers\StagesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});
Route::prefix('/frontend')->group(function () {
    Route::get('login', function () {
        return view('frontend.login');
    });
    Route::get('client', function () {
        return view('frontend.client');
    });
    Route::get('operator', function () {
        return view('frontend.operator');
    });
    Route::get('jobs', function () {
        return view('frontend.jobs');
    });
    Route::get('clientform', function () {
        return view('frontend.clientform');
    });
    Route::get('operatorform', function () {
        return view('frontend.operatorform');
    });
    Route::get('jobsform', function () {
        return view('frontend.jobsform');
    });
    Route::get('jobsdetail', function () {
        return view('frontend.jobsdetail');
    });
    Route::get('jobsdetailmore', function () {
        return view('frontend.jobsdetailmore');
    });
    Route::get('form', function () {
        return view('frontend.form');
    });
    Route::get('createform', function () {
        return view('frontend.createform');
    });
});


Route::get('/forget-password', [AdminController::class, 'forgetPassword'])->name('forgetpassword');
Route::post('/submit-forgetpassword-email', [AdminController::class, 'submitForgePasswordEmail'])->name('ForgePasswordEmail');


// Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'client'], function () {
        Route::get('/', [ClientController::class, 'index'])->name('client.index');
        Route::get('/create', [ClientController::class, 'create'])->name('client.create');
        Route::post('/store', [ClientController::class, 'store'])->name('client.store');
        Route::get('/edit/{id}', [ClientController::class, 'edit'])->name('client.edit');
        Route::post('/update/{id}', [ClientController::class, 'update'])->name('client.update');
        Route::get('/delete/{id}', [ClientController::class, 'delete'])->name('client.delete');
    });


    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/permission-index', [AdminController::class, 'permission_index'])->name('admin.permission.index');
        Route::post('/permission-update', [AdminController::class, 'permission_update'])->name('admin.permission.update');
        Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
        Route::post('/update/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::get('/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
        Route::get('/show', [AdminController::class, 'editprofile'])->name('adminprofile');
        Route::post('/updateprofile', [AdminController::class, 'updateprofile'])->name('adminprofileupdate');
        
    });



    Route::group(['prefix' => 'operative'], function () {
        Route::get('/', [OperativeController::class, 'index'])->name('operative.index');
        Route::get('/create', [OperativeController::class, 'create'])->name('operative.create');
        Route::post('/store', [OperativeController::class, 'store'])->name('operative.store');
        Route::get('/edit/{id}', [OperativeController::class, 'edit'])->name('operative.edit');
        Route::post('/update/{id}', [OperativeController::class, 'update'])->name('operative.update');
        Route::get('/delete/{id}', [OperativeController::class, 'delete'])->name('operative.delete');
        Route::get('/resetemail/{id}', [OperativeController::class, 'resetemail'])->name('operative.sendemail');
    });

    Route::group(['prefix' => 'job'], function () {
        Route::get('/', [JobController::class, 'index'])->name('job.index');
        Route::get('/create', [JobController::class, 'create'])->name('job.create');
        Route::get('/show/{id?}', [JobController::class, 'show'])->name('job.show');
        Route::post('/store', [JobController::class, 'store'])->name('job.store');
        Route::get('/edit/{id}', [JobController::class, 'edit'])->name('job.edit');
        Route::post('/update/{id}', [JobController::class, 'update'])->name('job.update');
        Route::get('/delete/{id}', [JobController::class, 'delete'])->name('job.delete');

        Route::get('/sites/{id?}', [JobController::class, 'clientSites'])->name('job.sites');
        Route::get('/depot-resourse/{id?}', [JobController::class, 'depotResourse'])->name('job.depot-resourse');
    });

    Route::group(['prefix' => 'form'], function () {
        Route::get('/', [FormController::class, 'index'])->name('form.index');
        Route::get('/create/{id?}', [FormController::class, 'create'])->name('form.create');
        Route::post('/store', [FormController::class, 'store'])->name('form.store');
        Route::get('/edit/{id}', [FormController::class, 'edit'])->name('form.edit');
        Route::post('/update/{id}', [FormController::class, 'update'])->name('form.update');
        Route::get('/delete/{id}', [FormController::class, 'delete'])->name('form.delete');
        Route::get('/dublicate/{id}', [FormController::class, 'dublicate'])->name('form.dublicate');
    });

    Route::group(['prefix' => 'stage'], function () {
        Route::get('/', [StagesController::class, 'index'])->name('stage.index');
        Route::get('/create', [StagesController::class, 'create'])->name('stage.create');
        Route::post('/store', [StagesController::class, 'store'])->name('stage.store');
        Route::get('/edit/{id}', [StagesController::class, 'edit'])->name('stage.edit');
        Route::post('/update/{id}', [StagesController::class, 'update'])->name('stage.update');
        Route::get('/delete/{id}', [StagesController::class, 'delete'])->name('stage.delete');
    });

    Route::group(['prefix' => 'section'], function () {
        Route::get('/create/{id?}', [FormController::class, 'sectionCreate'])->name('section.create');
        Route::post('/save/{id?}', [FormController::class, 'sectionSave'])->name('section.save');
        Route::get('/addQuestion/{id?}', [FormController::class, 'sectionaddQuestion'])->name('section.addQuestion');
    });
});

Route::group(['middleware' => ['auth', 'operativeAuth']], function () {
    Route::get('/operativeDetail/{id}', [OperativeController::class, 'operativeDetail'])->name('operative.detail');
    Route::get('/editoperativeDetail/{id}', [OperativeController::class, 'operativeDetailEdit'])->name('operative.editdetail');
    Route::post('/updateoperativeDetail/{id}', [OperativeController::class, 'operativeDetailUpdate'])->name('operative.updatedetail');
    Route::get('/showJobDetail/{id}', [OperativeController::class, 'showJobDetails'])->name('operative.showjobdetails');
});



Route::group(['middleware' => ['guest']], function () {
    Route::get('/reset_password/{token?}', [OperativeController::class, 'reset_password'])->name('reset_password');
    Route::post('/new_password', [OperativeController::class, 'new_password'])->name('new_password');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/passport', function () {
    shell_exec('php ../artisan passport:install');
    dd("Done");
});

Route::get('/clear', function () {
    Artisan::call('optimize:clear');
    dd("Done");
});

// Route::get('/migrate', function () {
//     Artisan::call('migrate');
//     dd("Done");
// });


// Route::get('/refresh', function () {
//     Artisan::call('migrate:refresh');
//     dd("Done");
// });


// Route::get('/seed', function () {
//     Artisan::call('db:seed');
//     dd("Done");
// });
