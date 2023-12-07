<?php
namespace App\Routers;


use App\Controller\VagaController;

class VagaRouter{

  private $httpMethod;
  private $body;

  public function __construct($httpMethod,$body){

    $this->httpMethod= $httpMethod;
    $this->body = $body;
    $this->Router();

  }

  public function Router(){
    $vagaController = new VagaController();
       switch($this->httpMethod) {
       
         case 'POST':
           $resultado = $vagaController->createVaga($this->body);
           echo json_encode(['status'=>$resultado]);
         break;
         case 'GET':
           if (!isset($_GET['id'])){
             $resultado = $vagaController->getVagaList();
             echo json_encode(["VagaList"=>$resultado]);
           } else {
             $resultado = $vagaController->getVagaById($_GET['id']);
             if ($resultado) {
               echo json_encode(["status"=>true,"Vaga"=>$resultado]);
             } else {
               echo json_encode(["status"=>false]);
             }
           }
         break;
         case 'PUT':
           $resultado = $vagaController->updateVaga($this->body,intval($_GET['id']));
           echo json_encode(['status'=>$resultado]);
         break;
         case 'DELETE':
           $resultado = $vagaController->deleteVaga(intval($_GET['id']));
           echo json_encode(['status'=>$resultado]);
         break;

    }
   }
}