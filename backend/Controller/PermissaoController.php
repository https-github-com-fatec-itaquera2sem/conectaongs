<?php
namespace App\Controller;
use App\Model\Model;
use App\Model\Permissao;
use App\Controller\Cryptonita;

class PermissaoController {
  private $db;
  private $permissao;
  private $crypto;
  public function __construct() {
    $this->db = new Model();
    $this->permissao = new Permissao();
    $this->crypto = new Cryptonita();
  }
  public function getPermissaoList() {
    $permissoesList = $this->db->select('permissoes');
    foreach($permissoesList as $key => $value){
      foreach($value as $campo=>$valor){
          if(!$valor || !$this->crypto->show($valor)){}else{
            $permissoesList[$key][$campo]= $this->crypto->show($valor); 
          }
      }
    }
    return $permissoesList;
  }
  public function getPermissaoById($id) {
      $permissoesList = $this->db->select('permissoes', ['id_permissao'=>$id]);
      $permissoesList= $permissoesList[0];
        foreach($permissoesList as $campo=>$valor){
            if( !$valor || !$this->crypto->show($valor)){}else{
              $permissoesList[$campo] = $this->crypto->show($valor); 
            }
      }
      return $permissoesList;
  }
  public function createPermissao($dado) {
    $usuario= $this->db->select('usuario', ['id_usuario'=> $dado['id_usuario']]);
    $this->permissao->setNome($this->crypto->hidden($dado['permissao']));
    $this->permissao->setIdUsuario($dado['id_usuario']);
    $this->permissao->setIp($this->crypto->hidden($_SERVER['REMOTE_ADDR']));
    $this->permissao->setCriador($usuario[0]['Nome']);
    if($usuario){
      if ($this->db->insert('permissoes', [
      'id_usuario' => $this->permissao->getIdUsuario(),
      'permissao' => $this->permissao->getNome(),
      'IP' => $this->permissao->getIp(),
      'Criador' => $this->permissao->getCriador()
    ])) {
      return true;
    } else {
      return false;
    }
  }else{
    return false;
  }
    
  }
  public function updatePermissao($dadosNovos, $id) {
    foreach($dadosNovos as $campo=>$valor){
      if(is_int($valor)){}else{
        $dadosNovos[$campo] = $this->crypto->hidden($valor); 
      }
    }
    if($this->db->update('permissoes', $dadosNovos, ['id_permissao'=>$id])){
      return true;
    } else {
      return false;
    }
  }

  public function deletePermissao($id) {
    if ($this->db->delete('permissoes', ['id_permissao'=>$id])) {
      return true;
    } else {
      return false;
    }
  }
}
?>