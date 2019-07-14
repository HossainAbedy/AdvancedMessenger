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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'ContactsController@getall');
Route::get('/contacts', 'ContactsController@get');
Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
Route::post('/conversation/send', 'ContactsController@send');

//globalpart
Route::get('chat', 'ChatController@chat');
Route::post('sendG', 'ChatController@sendG');
Route::post('getOldMessages', 'ChatController@getOldMessages');
Route::post('saveTosession', 'ChatController@saveTosession');
Route::post('deleteSession', 'ChatController@deleteSession');

//userpart
Route::get('/profile', 'UserController@profile');
Route::put('/updateprofile', 'UserController@updateprofile');
Route::get('/viewprofile/{id}', 'UserController@viewprofile');
Route::post('/profile', 'UserController@update_avatar');

//Friendshippart
Route::get('/check_relationship_status/{id}', [
    'uses' => 'FriendshipController@check',
    'as' => 'check'
]);
Route::get('/add_friend/{id}', [
    'uses' => 'FriendshipController@add_friend',
    'as' => 'add_friend'
]);
Route::get('/accept_friend/{id}', [
    'uses' => 'FriendshipController@accept_friend',
    'as' => 'accept_friend'
]);

