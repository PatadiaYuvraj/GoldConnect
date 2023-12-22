<?php

use App\Http\Controllers\Manager;
use Illuminate\Support\Facades\Route;

Route::get('/', [Manager::class, 'index'])->name('index');
// Route::get('/getAccounts', [Manager::class, 'getAccounts']);
// Route::get('/testMail', [Manager::class, 'testMail']);
Route::post('/form-submit', [Manager::class, 'formSubmit'])->name('form.submit');
