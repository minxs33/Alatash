<?php

use Illuminate\Support\Facades\Route;

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

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
    
    Route::get('/search', 'search');
});

// Route::resources([
//     'login' => LoginController::class,
//     'register' => RegisterController::class,
// ]);

Route::get('/alatash-admin', ["uses" => "LoginController@index"]);

Route::post('login/authenticate', ['uses' => 'LoginController@authenticate']);
Route::post('logout', ['uses' => 'LoginController@logout']);

// Route::get('/cars/{id}', ['uses' => 'CarController@show']);

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', ['uses' => 'AdminController@index']);
    Route::middleware('role:1')->group(function () {
        Route::resources([
            'categories' => CategoriesController::class,
            'roles' => RoleController::class,
            'users' => UserController::class,
        ]);

        // Route::get('car-confirmation', ['uses' => 'CarController@carConfirmation']);

        Route::group(['prefix' => '/ajaxReq'], function () {
            Route::post('/change-car-status', ['uses' => 'CarController@getStatus']);
            Route::post('/change-carousel-status/{id}', ['uses' => 'CarController@getStatus']);
            Route::post('/change-images-status', ['uses' => 'Car_imageController@updateIsActive']);
        });
    });

    Route::middleware('role:1|2')->group(function () {
        Route::resources([
            'cars' => CarController::class,
            'carousels' => CarouselController::class,
            'car_images' => Car_imageController::class,
        ]);
        Route::get('/car_images/create/{id}', ['uses' => 'Car_imageController@create']);
    });

    Route::middleware('role:1|2|3')->group(function () {
        Route::get('/cars', ['uses' => 'CarController@index']);
    });

    Route::middleware('role:1|2')->group(function () {
        Route::group(['prefix' => '/ajaxReq'], function () {
            Route::post('/car-image-list', ['uses' => 'Car_imageController@getCarImage']);
        });
    });
});
