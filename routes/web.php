<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DeveloperController;
use App\Http\Controllers\Backend\Logs\DeveloperLogsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\PermissionsController;
use App\Http\Controllers\Backend\Logs\SqlLogsController;
use App\Http\Controllers\Backend\PublicController;
use App\Http\Controllers\HomeController;

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
    return redirect()->route("home");
});

Route::get('/phpinfo', function () {
    phpinfo();
});

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/theme', [HomeController::class, 'theme']);
Route::get('/developer-components', [HomeController::class, 'developer_components']);
Route::get('/test', [HomeController::class, 'test']);


Route::group(['prefix' => 'public', 'as'=>'public.'], function () {
    Route::post('ajax_upload', [PublicController::class, 'ajax_upload']);
    Route::post('ajax_upload_base64', [PublicController::class, 'ajax_upload_base64']);
});

Route::group(['prefix' => 'admin', 'as'=>'admin.', 'middleware' => ['auth', 'role_permission']], function () {

    $name = "dashboard";
    Route::get($name, [DashboardController::class, 'index'])->name($name);

    /*** Controller Routes ***/
    Route::resource("users", UsersController::class);
    Route::resource("roles", RolesController::class);

    Route::group(['prefix' => 'permissions', 'as'=>'permissions.'], function () {

        $name = "index";
        Route::get($name, [PermissionsController::class, $name])->name($name);

        $name = "assign";
        Route::get($name, [PermissionsController::class, $name])->name($name);

        $name = "assign";
        Route::any($name, [PermissionsController::class, $name])->name($name);

        $name = "assign_to_many";
        Route::any($name, [PermissionsController::class, $name])->name($name);

        $name = "ajax_get_permissions";
        Route::get("$name/{id}", [PermissionsController::class, $name])->name($name);

        $name = "ajax_delete";
        Route::post($name, [PermissionsController::class, $name])->name($name);
    });

    Route::group(['prefix' => 'logs', 'as'=>'logs.'], function () {
        
        Route::group(['prefix' => 'developer', 'as'=>'developer.'], function () {

            $name = "sql";
            Route::get($name, [DeveloperLogsController::class, $name])->name($name);
        });
    });

    $prefix = "developer";
    Route::group(['prefix' => $prefix, 'as'=> "$prefix."], function () {

        $name = "laravel_routes_index";
        Route::get($name, [DeveloperController::class, $name])->name($name);
    });
});