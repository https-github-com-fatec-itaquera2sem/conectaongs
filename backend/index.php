<?php

require "../vendor/autoload.php";
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Cache-Control: no-cache, no-store, must-revalidate');
use App\Routers\UsuarioRouter;
use App\Routers\UsuarioLocalizacaoRouter;
use App\Routers\OngRouter;
use App\Routers\OngAvaliacaoRouter;
use App\Routers\OngRecursoRouter;
use App\Routers\OngVagaRouter;
use App\Routers\OngLocalizacaoRouter;
use App\Routers\RecursoRouter;
use App\Routers\AvaliacaoRouter;
use App\Routers\PermissaoRouter;
use App\Routers\PerfilRouter;
use App\Routers\IntencaoRouter;
use App\Routers\SolicitacaoRouter;
use App\Routers\VagaRouter;
use App\Controller\UsuarioController;



$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$httpMethod = $_SERVER['REQUEST_METHOD'];
$body = json_decode(file_get_contents('php://input'), true);
$id = isset($_GET['id'])?$_GET['id']:'';
$LoginController = new UsuarioController();


switch($url){

  case '/backend/usuario':
    $userRouter = new UsuarioRouter($httpMethod,$body);
  break;
  case '/backend/usuario/localizacao':
    $userRouter = new UsuarioLocalizacaoRouter($httpMethod,$body);
  break;
  case '/backend/login':
    $email = $body['email'];
    $senha = $body['senha'];
    $lembrar = $body['lembrar'];
    $resultado = $usuarioController->login($email, $senha, $lembrar);
    echo json_encode(['status'=>$resultado]);
  break;

  case'/backend/ong':
    $ongRouter = new OngRouter($httpMethod,$body);
  break;
  case'/backend/ong/avaliacao':
    $ongAvaliacaoRouter = new OngAvaliacaoRouter($httpMethod);
  break;
  case'/backend/ong/recurso':
    $ongRecursoRouter = new OngRecursoRouter($httpMethod);
  break;
  case'/backend/ong/vaga':
    $ongVagaRouter = new OngVagaRouter($httpMethod);
  break;
  case'/backend/ong/localizacao':
    $ongLocalizacaoRouter = new OngLocalizacaoRouter($httpMethod);
  break;
  case'/backend/recurso':
    $recursoRouter = new RecursoRouter($httpMethod,$body);
    break;
  case'/backend/avaliacao':
    $avaliacaoRouter = new AvaliacaoRouter($httpMethod,$body);
  break;
  case'/backend/vaga':
    $vagaRouter = new VagaRouter($httpMethod,$body);
  break;
  case'/backend/perfil':
    $perfilRouter = new PerfilRouter($httpMethod,$body);
  break;
  case'/backend/permissao':
    $permissaoRouter = new PermissaoRouter($httpMethod,$body);
  break;
  case'/backend/solicitacao':
    $solicitacaoRouter = new SolicitacaoRouter($httpMethod,$body);
  break;
  case'/backend/intencao':
    $intencaoRouter = new IntencaoRouter($httpMethod,$body);
  break;
}

?>