<?php
namespace App\Routers;


use App\Controller\PerfilController;

class PerfilRouter{

  private $httpMethod;
  private $body;

  public function __construct($httpMethod,$body){

    $this->httpMethod= $httpMethod;
    $this->body = $body;
    $this->Router();

  }

  public function Router(){
    $perfilController = new PerfilController();
       switch($this->httpMethod) {
       
         case 'POST':
           $resultado = $perfilController->createPerfil($this->body);
           echo json_encode(['status'=>$resultado]);
         break;
         case 'GET':
           if (!isset($_GET['id'])){
             $resultado = $perfilController->getPerfilList();
             echo json_encode(["PerfilList"=>$resultado]);
           } else {
             $resultado = $perfilController->getPerfilById($_GET['id']);
             if ($resultado) {
               echo json_encode(["status"=>true,"Perfil"=>$resultado]);
             } else {
               echo json_encode(["status"=>false]);
             }
           }
         break;
         case 'PUT':
           $resultado = $perfilController->updatePerfil($this->body,intval($_GET['id']));
           echo json_encode(['status'=>$resultado]);
         break;
         case 'DELETE':
           $resultado = $perfilController->deletePerfil(intval($_GET['id']));
           echo json_encode(['status'=>$resultado]);
         break;

    }
   }
}