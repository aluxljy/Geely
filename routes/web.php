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
Route::get('/admin/newsletter/view/{newsletterID}','App\Http\Controllers\NewsletterController@viewImage');
Route::post('/admin/newsletter/add','App\Http\Controllers\NewsletterController@add');
Route::get('/admin/newsletter/edit/{newsletterID}','App\Http\Controllers\NewsletterController@viewEditPage');
Route::patch('/admin/newsletter/editfunction/{newsletterID}','App\Http\Controllers\NewsletterController@edit');
Route::get('/admin/newsletter/delete/{newsletterID}','App\Http\Controllers\NewsletterController@delete');

Route::get('/admin/car','App\Http\Controllers\CarController@viewAdminPage');
Route::post('/admin/car/add','App\Http\Controllers\CarController@addCar');
Route::get('/admin/car/delete/{carID}','App\Http\Controllers\CarController@delete');
Route::get('/admin/car/file/viewspec/{carID}','App\Http\Controllers\CarController@viewSpecFile');
Route::get('/admin/car/file/viewdata/{carID}','App\Http\Controllers\CarController@viewDataFile');
Route::get('/admin/car/edit/{carID}','App\Http\Controllers\CarController@viewEditPage');
Route::patch('/admin/car/editfunction/{carID}','App\Http\Controllers\CarController@edit');

Route::get('/admin/brand_model_variant','App\Http\Controllers\BrandModelVariantController@viewAdminPage');

Route::get('/admin/carbrand','App\Http\Controllers\CarBrandController@viewAdminPage');
Route::post('/admin/carbrand/add','App\Http\Controllers\CarBrandController@addCarBrand');
Route::get('/admin/carbrand/delete/{carbrandID}','App\Http\Controllers\CarBrandController@delete');
Route::get('/admin/carbrand/edit/{carbrandID}','App\Http\Controllers\CarBrandController@viewEditPage');
Route::patch('/admin/carbrand/editfunction/{carbrandID}','App\Http\Controllers\CarBrandController@edit');

Route::get('/admin/carmodel','App\Http\Controllers\CarModelController@viewAdminPage');
Route::post('/admin/carmodel/add','App\Http\Controllers\CarModelController@addCarModel');
Route::get('/admin/carmodel/delete/{carmodelID}','App\Http\Controllers\CarModelController@delete');
Route::get('/admin/carmodel/edit/{carmodelID}','App\Http\Controllers\CarModelController@viewEditPage');
Route::patch('/admin/carmodel/editfunction/{carmodelID}','App\Http\Controllers\CarModelController@edit');

Route::get('/admin/carvariant','App\Http\Controllers\CarVariantController@viewAdminPage');
Route::post('/admin/carvariant/add','App\Http\Controllers\CarVariantController@addCarVariant');
Route::get('/admin/carvariant/delete/{carvariantID}','App\Http\Controllers\CarVariantController@delete');
Route::get('/admin/carvariant/edit/{carvariantID}','App\Http\Controllers\CarVariantController@viewEditPage');
Route::patch('/admin/carvariant/editfunction/{carvariantID}','App\Http\Controllers\CarVariantController@edit');
