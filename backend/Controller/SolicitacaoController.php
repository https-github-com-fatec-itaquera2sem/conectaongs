<?php

namespace App\Controller;
use App\Controller\Cryptonita;
use App\Model\Solicitacao;
use App\Model\Model;

class SolicitacaoController
{
    private $crypto;
    private $solicitacao;
    private $db;

    public function __construct()
    {
        $this->solicitacao = new Solicitacao();
        $this->db = new Model();
        $this->crypto = new Cryptonita();
    }

    public function getSolicitacaoList()
    {
    $solicitacaoList = $this->db->select('solicitacao');
      foreach($solicitacaoList as $key => $value){
        foreach($value as $campo=>$valor){
            if( !$valor || !$this->crypto->show($valor)){}else{
              $solicitacaoList[$key][$campo]= $this->crypto->show($valor); 
            }
        }
      }
      return $solicitacaoList;
    }


    public function getSolicitacaoById($id)
    {
        $solicitacaoList = $this->db->select('solicitacao', ['id_solicitacao'=>$id]);
        $solicitacaoList= $solicitacaoList[0];
          foreach($solicitacaoList as $campo=>$valor){
              if( !$valor || !$this->crypto->show($valor)){}else{
                $solicitacaoList[$campo] = $this->crypto->show($valor); 
              }
        }
        return $solicitacaoList;
    }

    public function createSolicitacao($dado)
    {
        $usuario= $this->db->select('usuario', ['id_usuario'=> $dado['id_usuario']]);
        $this->solicitacao->setTipo($this->crypto->hidden($dado['tipo_de_recurso']));
        $this->solicitacao->setDetalhes($this->crypto->hidden($dado['detalhes_da_solicitacao']));
        $this->solicitacao->setNivel($this->crypto->hidden($dado['nivel_de_urgencia']));
        $this->solicitacao->setIdUsuario($dado['id_usuario']);
        $this->solicitacao->setIdLocalizacao($dado['id_localizacao']);
        $this->solicitacao->setCriador($usuario[0]['Nome']);
        $this->solicitacao->setIp($this->crypto->hidden($_SERVER['REMOTE_ADDR']));
        
        if ($this->db->insert(
            'solicitacao',
            [
                'tipo_de_recurso'=> $this->solicitacao->getTipo(),
                'detalhes_da_solicitacao'=> $this->solicitacao->getDetalhes(),
                'nivel_de_urgencia'=> $this->solicitacao->getNivel(),
                'id_usuario' => $this->solicitacao->getIdUsuario(),
                'id_localizacao'=> $this->solicitacao->getIdLocalizacao(),
                'IP' => $this->solicitacao->getIp(),
                'Criador' => $this->solicitacao->getCriador()
            ]
        )) {
          return true;
        } else {
            return false;
        }
    }

    public function updateSolicitacao($novosDados, $id) {
        foreach($novosDados as $campo=>$valor){
            if(is_int($valor)){}else{
              $novosDados[$campo] = $this->crypto->hidden($valor); 
            }
          }
        if ($this->db->update('solicitacao', $novosDados, ['id_solicitacao'=>$id]
        )) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteSolicitacao($id) {
      
            if ($this->db->delete('solicitacao', ['id_solicitacao'=>$id])) {
                return true;
            } else {
                return false;
            }
        
       
    }
}
