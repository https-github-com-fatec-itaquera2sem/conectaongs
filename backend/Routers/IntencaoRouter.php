<?php
namespace App\Routers;


use App\Controller\IntencaoController;

class IntencaoRouter{

  private $httpMethod;
  private $body;

  public function __construct($httpMethod,$body){

    $this->httpMethod= $httpMethod;
    $this->body = $body;
    $this->Router();

  }

  public function Router(){
    $intencaoController = new IntencaoController();
       switch($this->httpMethod) {
       
         case 'POST':
           $resultado = $intencaoController->createIntencao($this->body);
           echo json_encode(['status'=>$resultado]);
         break;
         case 'GET':
           if (!isset($_GET['id'])){
             $resultado = $intencaoController->getIntencaoList();
             echo json_encode(["IntencaoList"=>$resultado]);
           } else {
             $resultado = $intencaoController->getIntencaoById($_GET['id']);
             if ($resultado) {
               echo json_encode(["status"=>true,"Intencao"=>$resultado]);
             } else {
               echo json_encode(["status"=>false]);
             }
           }
         break;
         case 'PUT':
           $resultado = $intencaoController->updateIntencao($this->body,intval($_GET['id']));
           echo json_encode(['status'=>$resultado]);
         break;
         case 'DELETE':
           $resultado = $intencaoController->deleteIntencao(intval($_GET['id']));
           echo json_encode(['status'=>$resultado]);
         break;

    }
   }
}