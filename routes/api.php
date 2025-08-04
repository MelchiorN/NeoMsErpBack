<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProformaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DeliveryController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Clients
Route::post('/customers',[CustomerController::class,'store']);
Route::get('/customers',[CustomerController::class,'index']);
Route::get('/customers/stats',[CustomerController::class,'stat']);


//Articles
Route::get('/article',[ArticleController::class,'index']);

//Facture proforma
Route::post('/proforma',[ProformaController::class,'store']);
Route::get('/proforma',[ProformaController::class,'index']);

// Commande
Route::post('/commande',[OrderController::class,'store']);
Route::get('/commande',[OrderController::class,'index']);
Route::patch('/commande/{id}',[OrderController::class],'d');

//Facture acompte
Route::post('/facture/acompte',[InvoiceController::class,'storeAcompte']);
Route::get('/facture/acompte',[InvoiceController::class,'indexAcompte']);

//Facture définitive
Route::post('/facture',[InvoiceController::class,'store']);
Route::get('/facture',[InvoiceController::class,'index']);

//Livraison
Route::post('/livraison',[DeliveryController::class,'store']);
Route::get('/livraison',[DeliveryController::class,'index']);