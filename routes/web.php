<?php

// GET - Importar CSV
Route::get('/', function () {
    return view('index');
});

// POST - Importar CSV
route::post('importCsv', ['uses' => 'CsvController@import'])->name('importCsv');;
