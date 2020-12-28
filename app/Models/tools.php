<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tools extends Model
{
     public static $enabled = 1;
    public static $desabled = 2;
    public static $deleted = 3;
    //Récuperation du domaine
    public static function getDomaine() {
        //return (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]/BackEnd/";
        return (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]/API_REST_CLI/";
    }
    public static function getMessageEmpty(){
        $_RESPONSE['message'] = 'Veuillez remplir les champs obligatoires svp...';
        $_RESPONSE['status'] = true;
        $_RESPONSE['donnes'] = null;
        return $_RESPONSE;
    }
    public static function getMessageSuccess($response){

        if($response == 1)
        {
            $_RESPONSE['message'] = 'Opération éffectuée avec succès';
            $_RESPONSE['status'] = false;
            $_RESPONSE['donnes'] = null;
        }
        else{
            $_RESPONSE['message'] = 'Erreur lors de l\'opération. Veuillez contacter l\'administrateur.';
            $_RESPONSE['status'] = true;
            $_RESPONSE['donnes'] = null;
        }
        return $_RESPONSE;
    }
    //Gestion des messages d'erreurs
    public static function getMessageError(array $response){
        //print_r(sizeof($response));
        if(sizeof($response) <= 0)
        {
            //Nothing Item result
            $_RESPONSE['message'] = 'Aucun élement trouvé dans le système';
            $_RESPONSE['status'] = true;
            $_RESPONSE['donnes'] = null;
        }
        elseif (sizeof($response)== 1)
        {
            //One Item result
            $_RESPONSE['donnees'] = $response;
            $_RESPONSE['message'] = '01 élement(s) trouvé(s) dans le système';
            $_RESPONSE['status'] = false;

        }elseif (sizeof($response)> 1)
        {
            $_RESPONSE['status'] = false;
            $_RESPONSE['donnees'] = $response;
            $_RESPONSE['message'] = (sizeof($response) < 9 ? '0'.sizeof($response) : sizeof($response)) .' élement(s) trouvée(s) dans le système';
        }
        else
        { //Nothing Item result
            $_RESPONSE['message'] = 'Opération éffectuée avec succès';
            $_RESPONSE['status'] = false;
            $_RESPONSE['donnes'] = null;

        }
        //print_r($_RESPONSE);
        return $_RESPONSE;
    }
    //Generation d'une clé unique de type Guid
    public static function NewID() {
        $uuid = array(
            'time_low' => 0,
            'time_mid' => 0,
            'time_hi' => 0,
            'clock_seq_hi' => 0,
            'clock_seq_low' => 0,
            'node' => array()
        );

        $uuid['time_low'] = mt_rand(0, 0xffff) + (mt_rand(0, 0xffff) << 16);
        $uuid['time_mid'] = mt_rand(0, 0xffff);
        $uuid['time_hi'] = (4 << 5) | (mt_rand(0, 0x1000));
        $uuid['clock_seq_hi'] = (1 << 7) | (mt_rand(0, 128));
        $uuid['clock_seq_low'] = mt_rand(0, 255);

        for ($i = 0; $i < 6; $i++) {
            $uuid['node'][$i] = mt_rand(0, 255);
        }
        $toReturn = sprintf('%08x-%04x-%04x-%02x%02x-%02x%02x%02x%02x%02x%02x', $uuid['time_low'], $uuid['time_mid'], $uuid['time_hi'], $uuid['clock_seq_hi'], $uuid['clock_seq_low'], $uuid['node'][0], $uuid['node'][1], $uuid['node'][2], $uuid['node'][3], $uuid['node'][4], $uuid['node'][5]
        );
        return $toReturn;
    }
    //La date en francais (date et time)
    public static function dateformatFrancaisLong($Odate) {

        $date = date_create($Odate);
        $time = date_format($date, 'd/m/Y H:i:s');
        return $time;
    }
    //La date en francais (date)
    public static function dateformatFrancaishort($Odate) {

        $date = date_create($Odate);
        $time = date_format($date, 'd-m-Y');
        return $time;
    }
    //Recuperer l'adresse ip de l'utilisateur
    public static function recuperAdresseIp() {

        $http_x = 'HTTP_X_FORWARDED_FOR';
        $http_client = 'HTTP_CLIENT_IP';
        $remote = 'REMOTE_ADDR';

        if (getenv($http_x)) {
            return getenv($http_x);
        } elseif (getenv($http_client)) {
            return getenv($http_client);
        } else {
            return getenv($remote);
        }
    }
    /**
    Get Two Date , Calculate days
     * */
    public static function GetDaysBeetwenTwoDates($datedebut, $datefin)
    {
        $now = $datedebut; // or your date as well
        $your_date = $datefin;
        $datediff = $now - $your_date;
        // echo floor($datediff / (60 * 60 * 24));
        return floor($datediff / (60 * 60 * 24));
    }
    //Date en francais
    public static function dateEnFr($date = '0000-00-00')
    {
        if ($date != '0000-00-00') {
            list($annee, $mois, $jour) = explode('-', $date);
            return $jour . '-' . $mois . '-' . $annee;
        }
    }
    //Date en francais
    public static function dateFrEnLong($date = '00-00-0000 00:00:00')
    {
        if ($date != '00-00-0000 00:00:00') {
            list($dateAnnee, $dateHeure) = explode(' ', $date);
            list($jour, $mois, $annee) = explode('-', $dateAnnee);
            //print_r($annee);
            return $annee . '-' . $mois . '-' .$jour.' '.$dateHeure;
        }
    }
}