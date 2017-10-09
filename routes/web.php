<?php
use TCG\Voyager\Models\DataType;



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

    try{

        $dataType_ = DataType::where('generate_permissions', '0');
        foreach ($dataType_->get() as $dataType) {
            $breadController = $dataType->controller
                ? $dataType->controller
                : 'BreadController';

            Route::resource($dataType->slug, $breadController);
        }
        // if( $dataType_->count() > 0 ) {
        // }
    }  catch (\InvalidArgumentException $e) {
        throw new \InvalidArgumentException("Custom routes hasn't been configured because: ".$e->getMessage(), 1);
    } catch (\Exception $e) {
        // do nothing, might just be because table not yet migrated.
    }

});
