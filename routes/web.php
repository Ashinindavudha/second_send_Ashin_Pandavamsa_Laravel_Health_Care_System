<?php
Route::get('/', 'User\HomeController@index');
Route::resource('postshows', 'User\HomeController');
Route::redirect('/admin-login', '/login');
Route::redirect('/home', '/admin');

//Route::redirect('/', '/login');
//Route::redirect('/home', '/admin');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

});

//Admin Route Group
Route::group(['namespace' => 'Admin'], function(){
//Western Medicine Route 
    Route::resource('westernmedicines', 'WesternMedicineController');
    //Western Disease Route
    Route::resource('westerndiseases', 'WesternDiseaseController');
//western Doctor
    Route::resource('westerndoctors', 'WesternDoctorController');
    // Patient Route 
    Route::resource('patients', 'PatientController');
    //PatienHistory Route 
    Route::resource('patient/histories', 'PatientHistoryController');
//Medicine History Route 
    Route::resource('medicine/history', 'MonthlyUseMedicineController');
//Doctor Information Post Route 
Route::post('posts/media', 'PostController@storeMedia')->name('posts.storeMedia');

    Route::resource('posts', 'PostController');
});

Route::group(['namespace' => 'User'], function(){


});



