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

use VerumConsilium\Browsershot\Facades\PDF;
use Spatie\Browsershot\Browsershot as PDFB;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/pdf',function(){
    $pdf = PDFB::html("<p>hola</p>")
    ->setNodeBinary(env('NODEJS_PATH','/usr/bin/node'))
    ->setNpmBinary(env('NPM_PATH','/usr/bin/npm'))
    ->noSandbox()
    ->format('A4')
    ->margins(10, 10, 10, 10)
    ->pdf();
    $fileName= 'prueba.pdf';
    return new Response($pdf, 200, array(
        'Content-Type' => 'application/pdf',
        'Content-Disposition' =>  'attachment; filename="'.$fileName.'"'
    ));
});
