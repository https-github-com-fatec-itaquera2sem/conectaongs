<?php
namespace App\Routers;


use App\Controller\OngController;

class OngRouter{

  private $httpMethod;
  private $body;

  public function __construct($httpMethod,$body){

    $this->httpMethod= $httpMethod;
    $this->body = $body;
    $this->Router();

  }

  public function Router(){
      $OngController = new OngController();
       switch($this->httpMethod) {
         case 'POST':
          if(!isset($_GET['id'])){
            $resultado = $OngController->createOng($this->body);
           echo json_encode(['status'=>$resultado]);
          }else{
            $resultado = $OngController->AddOngLocalizacao($_GET['id'],$this->body);
           echo json_encode(['status'=>$resultado]);
          }
         break;
         case 'GET':
           if (!isset($_GET['id'])){
             $resultado = $OngController->getOngList();
             echo json_encode(["OngList"=>$resultado]);
           } else {
             $resultado = $OngController->getOngById($_GET['id']);
             if ($resultado) {
               echo json_encode(["status"=>true,"Ong"=>$resultado]);
             } else {
               echo json_encode(["status"=>false]);
             }
           }
         break;
         case 'PUT':
           $resultado = $OngController->updateOng($this->body,intval($_GET['id']));
           echo json_encode(['status'=>$resultado]);
         break;
         case 'DELETE':
           $resultado = $OngController->deleteOng(intval($_GET['id']));
           echo json_encode(['status'=>$resultado]);
         break;

    }
   }
}