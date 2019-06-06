<?php

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
Route::post('send-message', function (\Illuminate\Http\Request $request){
    $channel = $request->get('channel','a');
    event(new \App\Events\BroadcastMessage($channel, 
        'messages', [
        'message' => $request->get('message'), 
        'channel' => $channel
    ]));
});

Route::post('new-user', function (\Illuminate\Http\Request $request){
    event(new \App\Events\BroadcastMessage('join_user', 
        'join', [
        'channel' => $request->get('channel'), 
    ]));
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sky', function () {
    return view('sky');
});



Route::get('/ws', function () {
    return view('ws');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function(){
    //Roles
    Route::post('roles/store','RoleController@store')->name('roles.store')
    ->middleware('permission:roles.create');

    Route::get('roles','RoleController@index')->name('roles.index')
    ->middleware('permission:roles.index');

    Route::get('roles/create','RoleController@create')->name('roles.create')
    ->middleware('permission:roles.create');

    Route::put('roles/{role}','RoleController@update')->name('roles.update')
    ->middleware('permission:roles.edit');

    Route::get('roles/{role}','RoleController@show')->name('roles.show')
    ->middleware('permission:roles.show');

    Route::delete('roles/{role}','RoleController@destroy')->name('roles.destroy')
    ->middleware('permission:roles.destroy');

    Route::get('roles/{role}/edit','RoleController@edit')->name('roles.edit')
    ->middleware('permission:roles.edit');

    //Users
    Route::post('users/store','UserController@store')->name('users.store')
    ->middleware('permission:users.create');

    Route::get('users','UserController@index')->name('users.index')
    ->middleware('permission:users.index');

    Route::get('users/create','UserController@create')->name('users.create')
    ->middleware('permission:users.create');

    Route::put('users/{user}','UserController@update')->name('users.update')
    ->middleware('permission:users.edit');

    Route::get('users/{user}','UserController@show')->name('users.show')
    ->middleware('permission:users.show');

    Route::delete('users/{user}','UserController@destroy')->name('users.destroy')
    ->middleware('permission:users.destroy');

    Route::get('users/{user}/edit','UserController@edit')->name('users.edit')
    ->middleware('permission:users.edit');

    //Etiqutas
    Route::get('bancomer/etiquetas/populate/{id}','bancomer\EtiquetasController@populate')->name('bancomer.etiqueta.populate');
    
    Route::post('bancomer/etiquetas/store','bancomer\EtiquetasController@store')->name('bancomer.etiqueta.store')
    ->middleware('permission:etiqueta.create');

    Route::get('bancomer/etiquetas','bancomer\EtiquetasController@index')->name('bancomer.etiqueta.index')
    ->middleware('permission:etiqueta.index');

    Route::get('bancomer/etiquetas/create','bancomer\EtiquetasController@create')->name('bancomer.etiqueta.create')
    ->middleware('permission:etiqueta.create');

    Route::put('bancomer/etiquetas/{etiqueta}','bancomer\EtiquetasController@update')->name('bancomer.etiqueta.update')
    ->middleware('permission:etiqueta.edit');

    Route::get('bancomer/etiquetas/{etiqueta}','bancomer\EtiquetasController@show')->name('bancomer.etiqueta.show')
    ->middleware('permission:etiqueta.show');

    Route::delete('bancomer/etiquetas/{etiqueta}','bancomer\EtiquetasController@destroy')->name('bancomer.etiqueta.destroy')
    ->middleware('permission:etiqueta.destroy');

    Route::get('bancomer/etiquetas/{etiqueta}/edit','bancomer\EtiquetasController@edit')->name('bancomer.etiqueta.edit')
    ->middleware('permission:etiqueta.edit');


    //Ordenes
    Route::post('bancomer/ordenes/store','bancomer\OrdenesController@store')->name('bancomer.ordenes.store')
    ->middleware('permission:ordenes.create');

    Route::get('bancomer/ordenes','bancomer\OrdenesController@index')->name('bancomer.ordenes.index')
    ->middleware('permission:ordenes.index');

    Route::get('bancomer/ordenes/create','bancomer\OrdenesController@create')->name('bancomer.ordenes.create')
    ->middleware('permission:ordenes.create');

    Route::put('bancomer/ordenes/{orden}','bancomer\OrdenesController@update')->name('bancomer.ordenes.update')
    ->middleware('permission:ordenes.edit');

    Route::get('bancomer/ordenes/{orden}','bancomer\OrdenesController@show')->name('bancomer.ordenes.show')
    ->middleware('permission:ordenes.show');

    Route::delete('bancomer/ordenes/{orden}','bancomer\OrdenesController@destroy')->name('bancomer.ordenes.destroy')
    ->middleware('permission:ordenes.destroy');

    Route::get('bancomer/ordenes/{orden}/edit','bancomer\OrdenesController@edit')->name('bancomer.ordenes.edit')
    ->middleware('permission:ordenes.edit');

    //bancomer personal
    Route::get('bancomer/personal/populate','bancomer\PersonalController@populate')->name('bancomer.personal.populate')
    ->middleware('permission:bancomer.personal.index');

    Route::get('bancomer/personal','bancomer\PersonalController@index')->name('bancomer.personal.index')
    ->middleware('permission:bancomer.personal.index');

    Route::post('bancomer/personal/etiquetas/update','bancomer\PersonalController@update_flags')->name('bancomer.personal.etiquetas.update');

});

Route::post('bancomer/personal/store','bancomer\PersonalController@store')
    ->name('bancomer.personal.store');
Route::put('bancomer/personal/{personal}','bancomer\PersonalController@update')->name('bancomer.personal.update');