<?php
namespace App\Routers;


use App\Controller\PermissaoController;

class PermissaoRouter{

  private $httpMethod;
  private $body;

  public function __construct($httpMethod,$body){

    $this->httpMethod= $httpMethod;
    $this->body = $body;
    $this->Router();

  }

  public function Router(){
    $permissaoController = new PermissaoController();
       switch($this->httpMethod) {
       
         case 'POST':
           $resultado = $permissaoController->createPermissao($this->body);
           echo json_encode(['status'=>$resultado]);
         break;
         case 'GET':
           if (!isset($_GET['id'])){
             $resultado = $permissaoController->getPermissaoList();
             echo json_encode(["PermissaoList"=>$resultado]);
           } else {
             $resultado = $permissaoController->getPermissaoById($_GET['id']);
             if ($resultado) {
               echo json_encode(["status"=>true,"Permissao"=>$resultado]);
             } else {
               echo json_encode(["status"=>false]);
             }
           }
         break;
         case 'PUT':
           $resultado = $permissaoController->updatePermissao($this->body,intval($_GET['id']));
           echo json_encode(['status'=>$resultado]);
         break;
         case 'DELETE':
           $resultado = $permissaoController->deletePermissao(intval($_GET['id']));
           echo json_encode(['status'=>$resultado]);
         break;

    }
   }
}