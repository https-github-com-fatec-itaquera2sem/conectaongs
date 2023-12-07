<?php
namespace App\Routers;


use App\Controller\OngController;

class OngAvaliacaoRouter{

  private $httpMethod;

  public function __construct($httpMethod){

    $this->httpMethod= $httpMethod;
    $this->Router();

  }

  public function Router(){
      $OngController = new OngController();
       switch($this->httpMethod) {
         case 'GET':
             $resultado = $OngController->getAvaliacaoByOngId($_GET['id']);
             if ($resultado) {
               echo json_encode(["status"=>true,"Ong"=>$resultado]);
             } else {
               echo json_encode(["status"=>false]);
             }
         break;
    }
   }
}