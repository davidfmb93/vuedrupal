<?php

namespace Drupal\vuedrupal;


class Services {


    public function index() {
        return 'Hello to the services of apigame150';
    }

    /**
     * Filter Pass Band for four numbers
     * 
     */

    function filterPassBand($number){
        $filter1 = substr($number,0, -4);
        $result = substr($filter1,4);
        return $result;
    }

    /**
 * Update Points User
 * 
 * Actualizacion de los puntos de un usuario
 * 
 * 
 */

function updatePointsUser($id){

    // Sacar el mayor puntaje realizado en el juego dentro de la tabla de puntajes
  
    $query = db_select('vuedrupal_data', 's');
    $query->fields('s', array('points', 'user_id'))->condition('user_id', $id,'=');
    $foundGame = $query->orderBy('points', 'DESC')->execute()->fetchAssoc(\PDO::FETCH_ASSOC);
    $pointsByGame = (int)$foundGame['points'];
  
    // Sumar puntajes si quieren agregar un extra o algo se agrega aca, si no pues lo dejamos asi como esta
    $totalPoints = $pointsByGame;
  
    // Actualizar la puntuación al usuario
    db_update('vuedrupal_users')->fields(array( 'points' => $totalPoints))->condition('id', $id,'=')->execute();
  
  
    //Retornar
    return (int)$totalPoints;
  }


  /**
   * Send Data TD
   * 
   * 
   * 
   */
  function __sendTD($form_data, $country, $brand, $campaign, $form, $unify, $production){

    
    $td_env = $production ? 'prod' : 'dev';

    $http_protocol = isset($_SERVER['https']) ? 'https://' : 'http://';

    $form_data['abi_brand'] = $brand;
    $form_data['abi_campaign'] = $campaign;
    $form_data['abi_form'] = $form;
    $form_data['td_unify'] = $unify;
    $form_data['td_import_method'] = 'postback-api-1.2';
    $form_data['td_client_id'] = $_COOKIE['_td'];
    $form_data['td_url'] = $http_protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $form_data['td_host'] = $_SERVER['HTTP_HOST'];

    $td_country = $country;

    $td_apikey = $td_env !== 'prod' ? '9648/41e45454b77308046627548e0b4fe2ddbc0893d2' : '10086/9c06ed6fa48e0fb6952ed42773cca1cc1d43684e';

    $country_zone_mapping = array("nga"=>"africa", "zwe"=>"africa", "zaf"=>"africa", "aus"=>"apac", "chn"=>"apac", "ind"=>"apac", "jpn"=>"apac", "kor"=>"apac", "tha"=>"apac", "vnm"=>"apac", "bel"=>"eur", "fra"=>"eur", "deu"=>"eur", "ita"=>"eur", "nld"=>"eur", "rus"=>"eur", "esp"=>"eur", "ukr"=>"eur", "gbr"=>"eur", "col"=>"midam", "dom"=>"midam", "ecu"=>"midam", "slv"=>"midam", "gtm"=>"midam", "hnd"=>"midam", "mex"=>"midam", "pan"=>"midam", "per"=>"midam", "can"=>"naz", "usa"=>"naz", "arg"=>"saz", "bol"=>"saz", "bra"=>"saz", "chl"=>"saz", "ury"=>"saz");

    $td_zone = $country_zone_mapping[$td_country];
    $curl = curl_init();

    $curl_opts = array(
        CURLOPT_URL => "https://in.treasuredata.com/postback/v3/event/{$td_zone}_source/{$td_country}_web_form",
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            "X-TD-Write-Key: {$td_apikey}"
        ),
        CURLOPT_POSTFIELDS => json_encode($form_data)
    );

    curl_setopt_array($curl, $curl_opts);

    $response = @curl_exec($curl);
    $response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    return $response_code;

  }

  /**
   * Tapit Services
   * 
   * Send data to tapit
   */
  public function tapit($method = null, $url = null, $data = null, $token = null){

        $statusProduction = \Drupal::config('app.core')->get('game_status');
        $production = $statusProduction == 1 ? true : false;

        $curl = curl_init();
        $tokenProduction =  $production ? 'bccae778d63c1b58c9a31c8a6dd0c757f1afb1a8bacaf2343ca435e15b6e3b44' : '5bf504f4989878149848a07c6d8368873af4b3bde4cececc204ea4c8b9c8790f';
        $endpoint = $production ? 'https://api.tapit.com.co' : 'https://api-dev.tapit.com.co';
        curl_setopt_array($curl, array(
        CURLOPT_URL => $endpoint.$url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ".$token,
            "Content-Type: application/json",
            "x-api-appkey: ".$tokenProduction
            )
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
        $request = [
          'data' => json_decode($response),
          'status' => (int)$httpcode,
        ];
        // var_dump(json_decode($request));die;
        return($request);
  }

  public function cities(){

      $cities = array (
        0 => 
        array (
          'id' => 1,
          'name' => 'Barranquilla',
          'allowed' => true,
        ),
        1 => 
        array (
          'id' => 2,
          'name' => 'Cartagena',
          'allowed' => true,
        ),
        2 => 
        array (
          'id' => 3,
          'name' => 'Santa Marta',
          'allowed' => true,
        ),
        3 => 
        array (
          'id' => 4,
          'name' => 'Sincelejo',
          'allowed' => true,
        ),
        4 => 
        array (
          'id' => 5,
          'name' => 'Valledupar',
          'allowed' => true,
        ),
        5 => 
        array (
          'id' => 6,
          'name' => 'Otra',
          'allowed' => false,
        ),
    );
    return $cities;
  }
}
