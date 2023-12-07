<?php
  namespace App\Controller;
  require "../vendor/autoload.php";
  use App\Model\Model; //Mudar caso a classe de conexão com o banco seja outra
  use App\Model\Usuario;
  use App\Model\Endereco;
  use App\Controller\LocalizacaoController;
  use App\Controller\PerfilController;
  use App\Controller\Cryptonita;
use App\Routers\PerfilRouter;
use Firebase\JWT\JWT;

  class UsuarioController {
    private $db;
    private $usuario;
    private $crypto;
    private $endereco;


    public function __construct() {
      $this->db = new Model();
      $this->usuario = new Usuario();
      $this->crypto = new Cryptonita();
      $this->endereco = new Endereco();
    }
    public function getUsuarioList() {
      $usuarioList = $this->db->select('usuario');
      foreach($usuarioList as $key => $value){
        foreach($value as $campo=>$valor){
            if($campo == 'id_usuario' || !$valor || !$this->crypto->show($valor)){}else{
              $usuarioList[$key][$campo]= $this->crypto->show($valor); 
            }
        }
      }
      return $usuarioList;
    }
    public function getUsuarioById($id) {
        $usuarioList = $this->db->select('usuario', ['id_usuario'=>$id]);
        $usuarioList= $usuarioList[0];
          foreach($usuarioList as $campo=>$valor){
              if( !$valor || !$this->crypto->show($valor)){}else{
                $usuarioList[$campo] = $this->crypto->show($valor); 
              }
        }
        return $usuarioList;
    }

    public function getUsuarioByEmail($email) {
        $usuario = $this->db->select('usuario', ['Email'=>$this->crypto->hidden($email)]);
        if($usuario){
          $usuario->setNome($this->crypto->show($usuario->getNome()));
          $usuario->setEmail($this->crypto->show($usuario->getEmail()));
          $usuario->setSenha($this->crypto->show($usuario->getSenha()));
          return $usuario;
        }else{
          return false;
        }
      }
      public function AddUsuarioLocalizacao($id,$dado){
        $usuario= $this->db->select('usuario', ['id_usuario'=> $dado['id_usuario']]);
        $this->endereco->setPais($this->crypto->hidden($dado['Pais']));
        $this->endereco->setCidade($this->crypto->hidden($dado['Cidade']));
        $this->endereco->setEstado($this->crypto->hidden($dado['Estado']));
        $this->endereco->setCEP($dado['CEP']);
        $this->endereco->setBairro($this->crypto->hidden($dado['Bairro']));
        $this->endereco->setRua($this->crypto->hidden($dado['Rua']));
        $this->endereco->setIP($this->crypto->hidden($_SERVER['REMOTE_ADDR']));
        $this->endereco->setCriador($usuario[0]['Nome']);
        $localizacaoController= new LocalizacaoController($this->endereco);
        $resultado = $localizacaoController->createLocalizacao($this->endereco);
          $idLocalizacao = $resultado['Lastid'];
          if($resultado['status']){
            $this->db->insert("usuario_localizacao",[
                'id_usuario' =>$id,
                'id_localizacao'=>$idLocalizacao
            ]);
            return true;
          }else{
            return false;
          }
      }

    public function createUsuario($dado) {
        $usuario= $this->db->select('usuario', ['id_usuario'=> $dado['id_usuario']]);
      if(!$usuario){
        $usuario = "";
      }else{
        $usuario = $usuario[0]['Nome'];
       }
        $this->usuario->setNome($this->crypto->hidden($dado['Nome']));
        $this->usuario->setEmail($this->crypto->hidden($dado['Email']));
        $this->usuario->setSenha($this->crypto->hidden($dado['Senha']));
        $this->usuario->setCriador($usuario);
        $this->usuario->setTipo($dado['id_perfil']);
        $this->usuario->setIp($this->crypto->hidden($_SERVER['REMOTE_ADDR']));
      if ($this->getUsuarioByEmail($this->usuario->getEmail())) {
        return "Usuário já existe!";
      } else {
        if ($this->db->insert('usuario', [
          'Nome' => $this->usuario->getNome(),
          'Email' => $this->usuario->getEmail(),
          'Senha' => $this->usuario->getSenha(),
          'Criador' => $this->usuario->getCriador(),
          'id_perfil' => $this->usuario->getTipo(),
          'IP' => $this->usuario->getIp()
        ])) {
          $id= $this->db->getLastInsertId();
          $perfilController = new PerfilController();
          $perfilController->createPerfil([
            'tipo_usuario'=> 'Voluntário',
            'id_usuario'=> $id
          ]);
          $this->endereco->setPais($this->crypto->hidden($dado['Pais']));
          $this->endereco->setCidade($this->crypto->hidden($dado['Cidade']));
          $this->endereco->setEstado($this->crypto->hidden($dado['Estado']));
          $this->endereco->setCEP($dado['CEP']);
          $this->endereco->setBairro($this->crypto->hidden($dado['Bairro']));
          $this->endereco->setRua($this->crypto->hidden($dado['Rua']));
          $this->endereco->setIP($this->crypto->hidden($_SERVER['REMOTE_ADDR']));
          $this->endereco->setCriador($usuario);
          $localizacaoController= new LocalizacaoController($this->endereco);
          $resultado = $localizacaoController->createLocalizacao($this->endereco);
          $idLocalizacao = $resultado['Lastid'];
          if($resultado['status']){
            $this->db->insert("usuario_localizacao",[
                'id_usuario' =>$id,
                'id_localizacao'=>$idLocalizacao
            ]);
            return true;
          }else{
            return false;
          }
        } else {
          return false;
        }
      }
    }

    public function updateUsuario($dadosNovos, $id) {
      foreach($dadosNovos as $campo=>$valor){
        if(is_int($valor)){}else{
          $dadosNovos[$campo] = $this->crypto->hidden($valor); 
        }
      }
      if($this->db->update('usuario', $dadosNovos, ['id_usuario'=>$id])){
        return true;
      } else {
        return false;
      }
    }

    public function deleteUsuario($id) {
      $this->db->delete('usuario_localizacao',['id_usuario' => $id]);
      $this->db->delete('perfil',['id_usuario' =>$id]);
      if ($this->db->delete('usuario', ['id_usuario'=>$id])) {
        return true;
      } else {
        return false;
      }
    }
    
    public function login($email, $senha, $lembrar) {
      $this->usuario->setEmail($email);
      $this->usuario->setSenha($senha);
      $checado = $lembrar? 60*12 : 3;
      $usuarioEncontrado = $this->getUsuarioByEmail($this->usuario->getEmail());
      if (!$usuarioEncontrado) {
        return ['status' => false, 'message' => 'Usuário não encontrado!'];
      }
      if (!password_verify($senha, $usuarioEncontrado->senha)) {
        return ['status' => false, 'message' => 'Senha incorreta!'];
      }
      $key = "1234567890098765432109876543211234567890";
      $algoritmo = 'HS256';
      $payload = [
        "iss" => "127.0.0.1",
        "aud" => "127.0.0.1",
        "iat" => time(),
        "exp" => time() + (60 * $checado),
        "sub" => $this->usuario->getEmail(),
      ];
      
      $jwt = JWT::encode($payload, $key, $algoritmo);

      return ['status' => true, 'message' => 'Login efetuado com sucesso!', 'token' => $jwt];
    }
  }
?>