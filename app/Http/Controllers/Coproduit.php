<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produit;
use App\Models\response;
use Illuminate\Support\Facades\DB;

class Coproduit extends Controller
{
     // fonction d'insertion
    public function create(Request $request)
    {
        $response = new response();

        // recuperation des donnees du formulaire
        $produitId = $request->produitId;
        $libelle = $request->libelle;
        $prix = $request->prix;
        $agenceId = $request->agenceId;


         $insert = DB::table('produit')->insert([
             'produitId' => $produitId,
             'libelle' =>$libelle,
             'prixUnitaire' =>$prix,
             'agenceId' =>$agenceId
         ]);      
         
         if($insert){

            $response ->status = 1;
            $response->message = "insertion reussie";
            $response ->data = null ; 

            return $response; 
        }
        else
        {
             $response ->status = 0;
            $response->message = "insertion echec ";
            $response ->data = null ; 

            return $response; 
        }
         


    }
}
