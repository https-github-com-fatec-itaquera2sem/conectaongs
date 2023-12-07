<?php
namespace App\Controller;
use App\Controller\Cryptonita;
use App\Model\Model;
use App\Model\Vaga;

class VagaController {
    private $db;
    private $vaga;
    private $crypto;

    public function __construct() {
        $this->db = new Model();
        $this->vaga = new Vaga();
        $this->crypto = new Cryptonita();
    }

    public function getVagaList() {
        $vagasList = $this->db->select('vagas');
      foreach($vagasList as $key => $value){
        foreach($value as $campo=>$valor){
            if(!$valor || !$this->crypto->show($valor)){}else{
              $vagasList[$key][$campo]= $this->crypto->show($valor); 
            }
        }
      }
      return $vagasList;
    }

    public function getVagaById($id) {
        $vagasList = $this->db->select('vagas', ['id_vagas_emprego'=>$id]);
        $vagasList= $vagasList[0];
          foreach($vagasList as $campo=>$valor){
              if( !$valor || !$this->crypto->show($valor)){}else{
                $vagasList[$campo] = $this->crypto->show($valor); 
              }
        }
        return $vagasList;
    }

    public function createVaga($dado) {
        $ong = $this->db->select('ong',['id_ong' => $dado['id_ong']]);
        $usuario= $this->db->select('usuario', ['id_usuario'=> $dado['id_usuario']]);
        $this->vaga->setServico($this->crypto->hidden($dado['servico']));
        $this->vaga->setDetalhes($this->crypto->hidden($dado['detalhes']));
        $this->vaga->setQtdVagas($dado['quantidade_de_vagas']);
        $this->vaga->setIP($this->crypto->hidden($_SERVER['REMOTE_ADDR']));
        $this->vaga->setCriador($usuario[0]['Nome']);
        $this->vaga->setIdUsuario($dado['id_usuario']);
        if($ong){
        if ($this->db->insert('vagas', [
            'servico' => $this->vaga->getServico(),
            'detalhes' => $this->vaga->getDetalhes(),
            'quantidade_de_vagas' => $this->vaga->getQtdVagas(),
            'IP' => $this->vaga->getIP(),
            'Criador' => $this->vaga->getCriador(),
            'id_usuario' => $this->vaga->getIdUsuario(),
        ])) {
                $LastId= $this->db->getLastInsertId();
                $this->db->insert('ong_vagas',[
                    'id_ong' => $ong[0]['id_ong'],
                    'id_vagas_emprego' => $LastId
                ]);
                return true;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    public function updateVaga($dadosNovos, $id) {
        foreach($dadosNovos as $campo=>$valor){
            if(is_int($valor)){}else{
              $dadosNovos[$campo] = $this->crypto->hidden($valor); 
            }
          }
        if ($this->db->update('vagas', $dadosNovos, ['id_vagas_emprego' => $id])) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteVaga($id) {
        if($this->db->delete('ong_vagas',['id_vagas_emprego'=>$id])){
            if ($this->db->delete('vagas', ['id_vagas_emprego' => $id])) {
                return true;
            } else {
                return false;
            }
        }
        }
}
