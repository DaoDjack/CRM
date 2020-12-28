<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\agence;
use App\Models\response;
use Illuminate\Support\Facades\DB;
use App\Models\tools;


class CoAgence extends Controller
{
    /// Voir la liste des agences

    public function liste()
    {
        $response = new response();

        $agence = DB::table('agence')
                    ->where('status', 1)
                    ->get();

        
        
        if (($agence))
        {
           $response->status = 1;
           $response->message= " Liste des agences ";
           $response->data = $agence;

           return $response; 
         }
          else 
          {
          $response->status = 0;
          $response->message= "Aucune agence enrégistrée";
          $response->data = null;
           
          return $response;

        }

    }
    
    
    
    // fonction d'insertion
    public function create(Request $request)
    {
        $response = new response();
        $agence = new agence();
        $tools = new tools();
        
        
        // recuperation des donnees du formulaire
      
         $agence->id = $tools->NewID();
         $agence->nom  = $request->nom;
         $agence->contact = $request->contact;
         $agence->email = $request->email;
         $agence->localisation = $request->localisation;
         $agence->montant = $request->montant;
         $agence->logo = $request->logo;

         if($agence->save()) // Pour utiliser la methode Save(), il faut ajouter les champs "updated_at" et "created_at"  
         {
           $response->status = 1;
           $response->message= "Agence enregistrée";
           $response->data = $agence;
           return $response;    
         }
         else 
         {
           $response->status = 0;
           $response->message= "Erreur d'enregistrement";
           $response->data = null;
           return $response;  
         }
    }

 //// fonction update agence 

 public function modify(Request $request)
 {
        $response = new response();
        $agence = new agence(); 
    // recuperation des données 

        $id = $request->id;
        $nom  = $request->nom;
        $contact  = $request->contact;
        $email  = $request->email;
        $localisation  = $request->localisation;
        $montant  = $request->montant;
        $logo = $request->logo;

    $modify =  DB::table('agence')
              ->where('id', $id)
              ->update([
                  'nom' => $nom,
                  'contact' => $contact,
                  'email'=> $email,
                  'localisation' => $localisation,
                  'montant' => $montant,
                  'logo' => $logo
              ]);

              if($modify)
              {
                $response->status = 1;
                $response->message= "Agence modifiée";
                $response->data = null;
                return $response; 
              }
              else
              {
                  $response->status = 0;
                  $response->message= "erreur modification  de l'agence";
                  $response->data = null;
                 return $response; 
                  
              }
 }

 public function delete(Request $request)
 {
   $response = new response();
    $agence = new agence();  
    
    $id = $request->id;
    
    $delete = DB::table('agence')
                ->where('id',$id)
                ->update([
                    'status'=> 0
                ]);
                if($delete)
              {
                $response->status = 1;
                $response->message= "Agence supprimée";
                $response->data = null;
                return $response; 
              }
              else
              {
                  $response->status = 0;
                  $response->message= "erreur de suppression de l'agence";
                  $response->data = null;
                 return $response; 
                  
              }
                
 }

}
