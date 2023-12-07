<?php
namespace App\Routers;


use App\Controller\LocalizacaoController;

class UsuarioLocalizacaoRouter{

  private $httpMethod;

  public function __construct($httpMethod){

    $this->httpMethod= $httpMethod;
    $this->Router();

  }

  public function Router(){
      $localizacaoController = new LocalizacaoController("");
       switch($this->httpMethod) {
         case 'GET':
             $resultado = $localizacaoController->getLocalizacaoByUsuarioId($_GET['id']);
             if ($resultado) {
               echo json_encode(["status"=>true,"Usuario Localizações"=>$resultado]);
             } else {
               echo json_encode(["status"=>false]);
             }
         break;
    }
   }
}