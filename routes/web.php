<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
});
Route::get('/formLogin', [\App\Http\Controllers\VisiteurController::class, 'getLogin']);
Route::post('/login', [\App\Http\Controllers\VisiteurController::class, 'signIn']);
Route::get('/getLogout', [\App\Http\Controllers\VisiteurController::class, 'signOut']);


route::group(['prefix' => 'medicament'],function ()
{
    Route::get('/Lister', [\App\Http\Controllers\MedicamentController::class, 'getMedicament']);


    Route::get('/getFormulation/{id_medicament}', [\App\Http\Controllers\FormulationController::class, 'getFormulations']);
    Route::get('/supprimerFormulation/{id_medicament}/{id_presentation}/', [\App\Http\Controllers\FormulationController::class, 'supprimerFormulation']);
    Route::get('/ajoutFormulation/{id_medicament}', [\App\Http\Controllers\FormulationController::class, 'ajoutFormulation']);
    Route::post('/ajouterLaFormulation', [\App\Http\Controllers\FormulationController::class, 'ajouterLaFormulation']);
    Route::get('/modifFormulation/{id_medicament}/{id_presentation}', [\App\Http\Controllers\FormulationController::class, 'modifFormulation']);
    Route::post('/modifierLaFormulation', [\App\Http\Controllers\FormulationController::class, 'modifierLaFormulation']);


    Route::get('/getInteraction/{id_medicament}', [\App\Http\Controllers\InteractionController::class, 'getInteraction']);
    Route::get('/ajoutinteraction/{id_medicament}', [\App\Http\Controllers\InteractionController::class, 'ajoutinteraction']);
    Route::post('/ajouterLaInteraction', [\App\Http\Controllers\InteractionController::class, 'ajouterLaInteraction']);
    Route::get('/supprimerInteraction/{id_medicament}/{med_id_medicament}/', [\App\Http\Controllers\InteractionController::class, 'supprimerInteraction']);
    Route::get('/modifInteractions/{id_medicament}/{med_id_medicament}', [\App\Http\Controllers\InteractionController::class, 'modifInteractions']);
    Route::post('/modifierLaInteraction', [\App\Http\Controllers\InteractionController::class, 'modifierLaInteraction']);


    Route::get('/getPrescription/{id_medicament}', [\App\Http\Controllers\PrescriptionController::class, 'getPrescription']);
    Route::get('/ajoutPrescription/{id_medicament}', [\App\Http\Controllers\PrescriptionController::class, 'ajoutPrescription']);
    Route::post('/ajouterLaPrescription', [\App\Http\Controllers\PrescriptionController::class, 'ajouterLaPrescription']);
    Route::get('/supprimerPrescription/{id_medicament}/{id_dosage}/{id_type_individu}/', [\App\Http\Controllers\PrescriptionController::class, 'supprimerPrescription']);
    Route::get('/modifPrescription/{id_medicament}/{id_dosage}/{id_type_individu}/', [\App\Http\Controllers\PrescriptionController::class, 'modifPrescription']);
    Route::post('/modifierLaPrescription/', [\App\Http\Controllers\PrescriptionController::class, 'modifierLaPrescription']);



    Route::post('/postAfficherVisi',
        [
            'as' => 'postAfficherVisi',
            'uses' => 'App\Http\Controllers\VisiteurController@postAfficherVisi',
        ]);
});



Route::get('/ListerVisi' ,[\App\Http\Controllers\VisiteurController::class,'listerVisiteur']);

