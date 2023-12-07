<?php
namespace App\Routers;


use App\Controller\RecursoController;

class RecursoRouter{

  private $httpMethod;
  private $body;

  public function __construct($httpMethod,$body){

    $this->httpMethod= $httpMethod;
    $this->body = $body;
    $this->Router();

  }

  public function Router(){
      $RecursoController = new RecursoController();
       switch($this->httpMethod) {
         case 'POST':
           $resultado = $RecursoController->createRecurso($this->body);
           echo json_encode(['status'=>$resultado]);
         break;
         case 'GET':
           if (!isset($_GET['id'])){
             $resultado = $RecursoController->getRecursoList();
             echo json_encode(["RecursoList"=>$resultado]);
           } else {
             $resultado = $RecursoController->getRecursoById($_GET['id']);
             if ($resultado) {
               echo json_encode(["status"=>true,"Recurso"=>$resultado]);
             } else {
               echo json_encode(["status"=>false]);
             }
           }
         break;
         case 'PUT':
           $resultado = $RecursoController->updateRecurso($this->body,intval($_GET['id']));
           echo json_encode(['status'=>$resultado]);
         break;
         case 'DELETE':
           $resultado = $RecursoController->deleteRecurso(intval($_GET['id']));
           echo json_encode(['status'=>$resultado]);
         break;

    }
   }
}