<?php
use TCG\Voyager\Models\DataType;

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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::group(['middleware' => 'admin.user'], function () {
        Route::get('import/{item}', "Activities\\ImportsController@getImportView")->name('import');
        Route::post("import", "Activities\\ImportsController@importFileIntoDB")->name("import-csv-excel");
    });
});

Route::get('/', "Auth\\PharmacyController@showLoginForm");
Route::get('/login', "Auth\\PharmacyController@showLoginForm");
Route::get('/pharmacy/login',"Auth\\PharmacyController@showLoginForm")->name('pharmacy.get.login');
Route::post('/pharmacy/login', "Auth\\PharmacyController@login")->name('pharmacy.post.login');

Route::get('/test',function (){
    dd(auth()->guard('pharmacy')->check());
});

Route::group(['middleware' => 'pharmacy.auth', 'prefix' => 'pharmacy'], function (){

    Route::any('/logout', 'Auth\\PharmacyController@logout')->name('pharmacy.logout');

    Route::get('/', "PharmacistController@dashboard");
    Route::get('/dashboard', "PharmacistController@dashboard")->name('pharmacy.dashboard');

    $dataType_ = DataType::where('generate_permissions', '0');
    if( $dataType_->count() > 0 ) {
        foreach ($dataType_->get() as $dataType) {
            $breadController = $dataType->controller
                ? $dataType->controller
                : 'BreadController';

            Route::resource($dataType->slug, $breadController);
        }
    }

});
