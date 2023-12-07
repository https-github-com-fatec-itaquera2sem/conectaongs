<?php
namespace App\Routers;


use App\Controller\UsuarioController;

class UsuarioRouter{

  private $httpMethod;
  private $body;

  public function __construct($httpMethod,$body){

    $this->httpMethod= $httpMethod;
    $this->body = $body;
    $this->Router();

  }

  public function Router(){
    $usuarioController = new UsuarioController();
       switch($this->httpMethod) {
       
         case 'POST':
          if(!isset($_GET['id'])){
            $resultado = $usuarioController->createUsuario($this->body);
            echo json_encode(['status'=>$resultado]);
          }else{
            $resultado = $usuarioController->AddUsuarioLocalizacao($_GET['id'],$this->body);
            echo json_encode(['status'=>$resultado]);
          }
           
         break;
         case 'GET':
           if (!isset($_GET['id'])){
             $resultado = $usuarioController->getUsuarioList();
             echo json_encode(["usuarioList"=>$resultado]);
           } else {
             $resultado = $usuarioController->getUsuarioById($_GET['id']);
             if ($resultado) {
               echo json_encode(["status"=>true,"usuario"=>$resultado]);
             } else {
               echo json_encode(["status"=>false]);
             }
           }
         break;
         case 'PUT':
           $resultado = $usuarioController->updateUsuario($this->body,intval($_GET['id']));
           echo json_encode(['status'=>$resultado]);
         break;
         case 'DELETE':
           $resultado = $usuarioController->deleteUsuario(intval($_GET['id']));
           echo json_encode(['status'=>$resultado]);
         break;
       }
   }
}