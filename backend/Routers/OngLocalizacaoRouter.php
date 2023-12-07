<?php
namespace App\Routers;


use App\Controller\LocalizacaoController;

class OngLocalizacaoRouter{

  private $httpMethod;

  public function __construct($httpMethod){

    $this->httpMethod= $httpMethod;
    $this->Router();

  }

  public function Router(){
      $localizacaoController = new LocalizacaoController("");
       switch($this->httpMethod) {
         case 'GET':
             $resultado = $localizacaoController->getLocalizacaoByOngId($_GET['id']);
             if ($resultado) {
               echo json_encode(["status"=>true,"Ong Localizações"=>$resultado]);
             } else {
               echo json_encode(["status"=>false]);
             }
         break;
    }
   }
}