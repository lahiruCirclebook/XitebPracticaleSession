<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\pharmacyController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', function () {
    return view('home.login');
});

Route::get('/register', function () {
    return view('home.register');
});

//user
/*Route::get('/pharmacy', function () {
    return view('Pharmacy.pharmacy');
});*/
Route::get('/users', function () {
    return view('Users.users');
});
Route::post('login', [UserController::class, 'Login']);
Route::get('logout', [UserController::class, 'Logout']);
Route::post('registered', [UserController::class, 'UserRegister']);
Route::post('prescription', [UserController::class, 'AddPrescription']);
Route::get('/view/Prepared/Quotation', [UserController::class, 'ViewPreparedQuotation']);

//Pharmacy
Route::get('/prescriptions', [pharmacyController::class, 'PrescriptionList']);
Route::get('/prepare/quotation', [pharmacyController::class, 'PrepareQuotation']);
Route::post('/addQuotation', [pharmacyController::class, 'AddQuotation']);

