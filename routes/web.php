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

Route::get('contacts', 'Contacts@list');
Route::get('contacts/remplir', 'Contacts@remplir');
Route::get('contacts/export', 'Contacts@export');
Route::get('contacts/edit/{contactId}', 'Contacts@edit');
Route::post('contacts/edit/{contactId}', 'Contacts@edit');
Route::get('contacts/add', 'Contacts@add');
Route::post('contacts/add', 'Contacts@add');
Route::get('contacts/delete/{contactId}', 'Contacts@delete');
Route::post('contacts/save', 'Contacts@save');
