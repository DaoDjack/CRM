<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\equipe;
use App\Models\response;
use Illuminate\Support\Facades\DB;
use App\Models\tools;

class CoEquipe extends Controller
{
    // fonction d'insertion
    public function create(Request $request)
    {
        $response = new response();
        $tools = new tools();
        $equipe = new equipe();
        
        
        // recuperation des donnees du formulaire
      
         $equipe->id = $tools->NewID();
         $equipe->libelle  = $request->libelle;
         $equipe->createdOn = $request->createdOn;
         $equipe->agenceId = $request->agenceId; 

         $insert = DB::table('equipe')->insert([
            'id' => $equipe->id,
            'libelle' => $equipe->libelle,
            'createdOn' => $equipe->createdOn,
            'agenceId' => $equipe->agenceId
            ]);

         if($equipe)   
         {
           $response->status = 1;
           $response->message= " Enregistré avec succes";
           $response->data = $equipe;
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



            //affichage
            
    public function SelectAll(request $request){
        $response = new response();
        $agenceId = $request->agenceId;
        $selectall = DB::table('equipe')
        ->select('*')
        ->where('equipe.agenceId',$agenceId)
        ->where('status', 1)
        ->get();

        if($selectall)    
         {
           $response->status = 1;
           $response->message= "Liste des équipes ";
           $response->data = $selectall;
           return $response;    
         }
         else 
         {
           $response->status = 0;
           $response->message= "Aucune équipe enrégistrée";
           $response->data = null;
           return $response;  
         }
    }


    public function SelectOne(request $request){

        $response = new response();
        $id = $request->id;
        $selectone = DB::table('equipe')
        //->select('commercial.*','equipe.nom as NomEquipe')
        //->join('equipe','commercial.equipeId','=','equipe.equipeId')
        ->where('equipe.Id',$id)
        ->where('status',1)
        ->get();

        if($selectone)
        {
            $response->status = 1;
            $response->message= "Element trouvé ";
            $response->data = $selectone;
            return $response;  

            return $response;
        }
        else 
        {
            $response->status = 0;
           $response->message= "Aucun élément";
           $response->data = null;
           return $response;  
        }

        
    }


               //mise à jour
    public function Update(Request $request){


        $response = new response();
        $equipe = new equipe();
        $equipe->id = $request->id ;
        $equipe->libelle =$request->libelle;
        $equipe->createdOn=$request->createdOn;
        //$equipe->agenceId=$request->agenceId;

        $update = DB::table('equipe')
            ->where('id',$equipe->id)
            ->update([
            'libelle' => $equipe->libelle,
            'createdOn' => $equipe->createdOn,
            'agenceId' => $equipe->agenceId        
            ]);

        if ($update)
        {
           
            $response->status = 1 ;
            $response->message = "Modification effectuée avec succès";
            $response->data = $update ;

            return $response;
        }
        else 
        {
            $response->status = 0 ;
            $response->message = "Cest djinzin";
            $response->data = null ;

            return $response;

        }
    }


    public function delete(Request $request)
    {
      $response = new response();
       $equipe = new equipe();  
       
       $id = $request->id;
       
       $delete = DB::table('equipe')
                   ->where('id',$id)
                   ->update([
                       'status'=> 0
                   ]);
                   if($delete)
                 {
                   $response->status = 1;
                   $response->message= "Supprimé avec succes";
                   $response->data = null;
                   return $response; 
                 }
                 else
                 {
                     $response->status = 0;
                     $response->message= "erreur de suppression";
                     $response->data = null;
                    return $response; 
                     
                 }
                   
    }


}
