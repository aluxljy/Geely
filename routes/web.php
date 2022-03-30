<?php

use App\Http\Controllers\CollectionController; //new added for resource controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; 

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

// Route::get('/', function(){
//     return redirect()->route('login');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/','App\Http\Controllers\DashboardController@viewPage');

Route::get('/catalogue','App\Http\Controllers\CatalogueController@viewPage')->name('catalogue.viewpage');
Route::get('/catalogue/search','App\Http\Controllers\CatalogueController@search');
Route::get('/catalogue/advanced','App\Http\Controllers\CatalogueController@advanced');

Route::get('/collection/comparison','App\Http\Controllers\ComparisonController@viewPage');
Route::get('/collection/compare', function(){


    dd(request()->all());
    
})->name('collection.compare1');
Route::post('/collection/compare', function(Request $request){

    $collectionSelected = $request->except('_token');

    $i  = 1;
    foreach ($collectionSelected as $key => $value) {
        
        ${'collectionID' . $i} = $value; 
        $i = $i + 1;
    }

    return redirect()->route('collection.compare1', ['collectionID1' => $collectionID1, 'collectionID2' => $collectionID2]);
})->name('collection.compare');
Route::resource('collection', CollectionController::class);


Route::get('/catalogue/usedcardetails','App\Http\Controllers\UsedCarController@viewPage')->name('UsedCarDetails');


Route::get('/admin/inspection','App\Http\Controllers\InspectionController@viewAdminPage');
Route::post('/admin/inspection/carModelDropBox','App\Http\Controllers\InspectionController@subOptions')->name('subOptions');
Route::get('/admin/inspection/file/view/{inspectionID}','App\Http\Controllers\InspectionController@viewInspectionFile');
Route::post('/admin/inspection/add','App\Http\Controllers\InspectionController@newInspection');
Route::get('/admin/inspection/delete/{inspectionID}','App\Http\Controllers\InspectionController@delete');
Route::get('/admin/inspection/details/{inspectionID}','App\Http\Controllers\InspectionController@viewDetailsPage');

Route::get('/admin/catalogue','App\Http\Controllers\CatalogueController@viewAdminPage');

Route::get('/admin/newsletter','App\Http\Controllers\NewsletterController@viewAdminPage');

Route::get('/admin/carmodel','App\Http\Controllers\CarModelController@viewAdminPage');


