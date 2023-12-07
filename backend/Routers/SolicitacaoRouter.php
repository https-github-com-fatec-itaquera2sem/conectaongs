<?php
namespace App\Routers;


use App\Controller\SolicitacaoController;

class SolicitacaoRouter{

  private $httpMethod;
  private $body;

  public function __construct($httpMethod,$body){

    $this->httpMethod= $httpMethod;
    $this->body = $body;
    $this->Router();

  }

  public function Router(){
    $SolicitacaoController = new SolicitacaoController();
       switch($this->httpMethod) {
       
         case 'POST':
           $resultado = $SolicitacaoController->createSolicitacao($this->body);
           echo json_encode(['status'=>$resultado]);
         break;
         case 'GET':
           if (!isset($_GET['id'])){
             $resultado = $SolicitacaoController->getSolicitacaoList();
             echo json_encode(["SolicitacaoList"=>$resultado]);
           } else {
             $resultado = $SolicitacaoController->getSolicitacaoById($_GET['id']);
             if ($resultado) {
               echo json_encode(["status"=>true,"Solicitacao"=>$resultado]);
             } else {
               echo json_encode(["status"=>false]);
             }
           }
         break;
         case 'PUT':
           $resultado = $SolicitacaoController->updateSolicitacao($this->body,intval($_GET['id']));
           echo json_encode(['status'=>$resultado]);
         break;
         case 'DELETE':
           $resultado = $SolicitacaoController->deleteSolicitacao(intval($_GET['id']));
           echo json_encode(['status'=>$resultado]);
         break;

    }
   }
}