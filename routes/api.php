<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoAgence;
use App\Http\Controllers\Coproduit;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
     

                                // ROUTES AGENCE///

            // liste des agences 
            Route::get('/listeAgence', [CoAgence::class, 'liste']);

            // insertion d'une agence
            Route:: post('/addAgence', [CoAgence::class, 'create']);

            //update agence
            Route::post('modifyAgence',[CoAgence::class, 'modify']);

            // delete agence
            Route::post('/deleteAgence',[CoAgence::class, 'delete']);


Route:: post('/addprod', [Coproduit::class, 'create']);