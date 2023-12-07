<?php 

namespace App\Controller;
use App\Model\Model;
use App\Model\Intencao;
use App\Controller\Cryptonita;

class IntencaoController {
  private $db;
  private $intencao;
  private $crypto;

  public function __construct() {
    $this->db = new Model();
    $this->intencao = new Intencao();
    $this->crypto = new Cryptonita();
  }

  public function getIntencaoList() {
    $intencoesList = $this->db->select('intencoes');
    foreach($intencoesList as $key => $value){
      foreach($value as $campo=>$valor){
          if( !$valor || !$this->crypto->show($valor)){}else{
            $intencoesList[$key][$campo]= $this->crypto->show($valor); 
          }
      }
    }
    return $intencoesList;
  }

  public function getIntencaoById($id) {
    $intencoesList = $this->db->select('intencoes', ['id_intencoes'=>$id]);
    $intencoesList= $intencoesList[0];
      foreach($intencoesList as $campo=>$valor){
          if( !$valor || !$this->crypto->show($valor)){}else{
            $intencoesList[$campo] = $this->crypto->show($valor); 
          }
    }
    return $intencoesList;
  }

  public function createIntencao($dado) {
    $usuario= $this->db->select('usuario', ['id_usuario'=> $dado['id_usuario']]);
    $this->intencao->setDescricao($this->crypto->hidden($dado['descricao']));
    $this->intencao->setHorarioDisponivel($dado['horario_disponivel']);
    $this->intencao->setDiaSemana($this->crypto->hidden($dado['dia_semana']));
    $this->intencao->setIdUsuario($dado['id_usuario']);
    $this->intencao->setIp($this->crypto->hidden($_SERVER['REMOTE_ADDR']));
    $this->intencao->setCriador($usuario[0]['Nome']);

    if ($this->db->insert('intencoes', [
      'descricao' => $this->intencao->getDescricao(),
      'horario_disponivel' => $this->intencao->getHorarioDisponivel(),
      'dia_semana' => $this->intencao->getDiaSemana(),
      'id_usuario' => $this->intencao->getIdUsuario(),
      'IP' => $this->intencao->getIp(),
      'Criador' => $this->intencao->getCriador()
    ])) {
      return true;
    } else {
      return false;
    }
  }

  public function updateIntencao($dadosNovos, $id) {

    foreach($dadosNovos as $campo=>$valor){
      if(is_int($valor) || $campo=="horario_disponivel"){}else{
        $dadosNovos[$campo] = $this->crypto->hidden($valor); 
      }
    }
    if ($this->db->update('intencoes', $dadosNovos, ['id_intencoes'=>$id])) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteIntencao($id) {
    if ($this->db->delete('intencoes', ['id_intencoes'=>$id])) {
      return true;
    } else {
      return false;
    }
  }
}
?>