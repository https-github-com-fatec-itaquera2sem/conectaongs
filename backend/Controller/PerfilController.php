<?php
namespace App\Controller;
use App\Model\Model;
use App\Model\Perfil;
use App\Controller\Cryptonita;

class PerfilController {
  private $db;
  private $perfil;
  private $crypto;
  public function __construct() {
    $this->db = new Model();
    $this->perfil = new Perfil();
    $this->crypto = new Cryptonita();
  }
  public function getPerfilList() {
    $perfilList = $this->db->select('perfil');
    foreach($perfilList as $key => $value){
      foreach($value as $campo=>$valor){
          if(!$valor || !$this->crypto->show($valor)){}else{
            $perfilList[$key][$campo]= $this->crypto->show($valor); 
          }
      }
    }
    return $perfilList;
  }
  public function getPerfilById($id) {
    $perfilList = $this->db->select('perfil', ['id_perfil'=>$id]);
    $perfilList= $perfilList[0];
      foreach($perfilList as $campo=>$valor){
          if( !$valor || !$this->crypto->show($valor)){}else{
            $perfilList[$campo] = $this->crypto->show($valor); 
          }
    }
    return $perfilList;
  }
  public function createPerfil($dado) {
    $usuario= $this->db->select('usuario', ['id_usuario'=> $dado['id_usuario']]);
    $this->perfil->setTipo($this->crypto->hidden($dado['tipo_usuario']));
    $this->perfil->setIdUsuario($dado['id_usuario']);
    $this->perfil->setIp($this->crypto->hidden($_SERVER['REMOTE_ADDR']));
    $this->perfil->setCriador($usuario[0]['Nome']);
    if ($this->db->insert('perfil', [
      'tipo_usuario' => $this->perfil->getTipo(),
      'id_usuario' => $this->perfil->getIdUsuario(),
      'IP' => $this->perfil->getIp(),
      'Criador' => $this->perfil->getCriador(),
    ])) {
      return true;
    } else {
      return false;
    }
  }
  public function updatePerfil($dadosNovos, $id) {
    foreach($dadosNovos as $campo=>$valor){
      if(is_int($valor)){}else{
        $dadosNovos[$campo] = $this->crypto->hidden($valor); 
      }
    }
    if($this->db->update('perfil', $dadosNovos, ['id_perfil'=>$id])){
      return true;
    } else {
      return false;
    }
  }

  public function deletePerfil($id) {
    if ($this->db->delete('perfil', ['id'=>$id])) {
      return true;
    } else {
      return false;
    }
  }
}
?>