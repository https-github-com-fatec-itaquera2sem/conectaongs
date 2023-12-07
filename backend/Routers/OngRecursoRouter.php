<?php
namespace App\Routers;


use App\Controller\OngController;

class OngRecursoRouter{

  private $httpMethod;

  public function __construct($httpMethod){

    $this->httpMethod= $httpMethod;
    $this->Router();

  }

  public function Router(){
      $OngController = new OngController();
       switch($this->httpMethod) {
         case 'GET':
             $resultado = $OngController->getRecursoByOngId($_GET['id']);
             if ($resultado) {
               echo json_encode(["status"=>true,"Ong"=>$resultado]);
             } else {
               echo json_encode(["status"=>false]);
             }
         break;
    }
   }
}