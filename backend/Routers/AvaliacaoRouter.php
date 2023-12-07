<?php
namespace App\Routers;


use App\Controller\AvaliacaoController;

class AvaliacaoRouter{

  private $httpMethod;
  private $body;

  public function __construct($httpMethod,$body){

    $this->httpMethod= $httpMethod;
    $this->body = $body;
    $this->Router();

  }

  public function Router(){
    $avaliacaoController = new AvaliacaoController();
       switch($this->httpMethod) {
       
         case 'POST':
           $resultado = $avaliacaoController->createAvaliacao($this->body);
           echo json_encode(['status'=>$resultado]);
         break;
         case 'GET':
           if (!isset($_GET['id'])){
             $resultado = $avaliacaoController->getAvaliacaoList();
             echo json_encode(["AvaliacaoList"=>$resultado]);
           } else {
             $resultado = $avaliacaoController->getAvaliacaoById($_GET['id']);
             if ($resultado) {
               echo json_encode(["status"=>true,"Avaliacao"=>$resultado]);
             } else {
               echo json_encode(["status"=>false]);
             }
           }
         break;
         case 'PUT':
           $resultado = $avaliacaoController->updateAvaliacao($this->body,intval($_GET['id']));
           echo json_encode(['status'=>$resultado]);
         break;
         case 'DELETE':
           $resultado = $avaliacaoController->deleteAvaliacao(intval($_GET['id']));
           echo json_encode(['status'=>$resultado]);
         break;

    }
   }
}