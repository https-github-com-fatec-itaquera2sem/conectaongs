<?php

namespace App\Controller;
use App\Controller\Cryptonita;
use App\Model\Avaliacao;
use App\Model\Model;

class AvaliacaoController
{
    private $crypto;
    private $avaliacao;
    private $db;

    public function __construct()
    {
        $this->avaliacao = new Avaliacao();
        $this->db = new Model();
        $this->crypto = new Cryptonita();
    }

    public function getAvaliacaoList()
    {
    $avaliacaoList = $this->db->select('avaliacao');
      foreach($avaliacaoList as $key => $value){
        foreach($value as $campo=>$valor){
            if( !$valor || !$this->crypto->show($valor)){}else{
              $avaliacaoList[$key][$campo]= $this->crypto->show($valor); 
            }
        }
      }
      return $avaliacaoList;
    }


    public function getAvaliacaoById($id)
    {
        $avaliacaoList = $this->db->select('avaliacao', ['id_avaliacao'=>$id]);
        $avaliacaoList= $avaliacaoList[0];
          foreach($avaliacaoList as $campo=>$valor){
              if( !$valor || !$this->crypto->show($valor)){}else{
                $avaliacaoList[$campo] = $this->crypto->show($valor); 
              }
        }
        return $avaliacaoList;
    }

    public function createAvaliacao($dado)
    {
        $ong = $this->db->select('ong',['id_ong' => $dado['id_ong']]);
        $usuario= $this->db->select('usuario', ['id_usuario'=> $dado['id_usuario']]);
        $this->avaliacao->setIdUsuario($dado['id_usuario']);
        $this->avaliacao->setComentario($this->crypto->hidden($dado['comentarios']));
        $this->avaliacao->setCriador($usuario[0]['Nome']);
        $this->avaliacao->setIp($this->crypto->hidden($_SERVER['REMOTE_ADDR']));
        if($ong){
        if ($this->db->insert(
            'avaliacao',
            [
                'id_usuario' => $this->avaliacao->getIdUsuario(),
                'comentarios' => $this->avaliacao->getComentario(),
                'IP' => $this->avaliacao->getIp(),
                'Criador' => $this->avaliacao->getCriador(),
            ]
        )) {
                $LastId= $this->db->getLastInsertId();
                $this->db->insert('ong_avaliacao',[
                    'id_ong' => $ong[0]['id_ong'],
                    'id_avaliacao' => $LastId
                ]);
                return true;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    public function updateAvaliacao($novosDados, $id) {
        foreach($novosDados as $campo=>$valor){
            if(is_int($valor)){}else{
              $novosDados[$campo] = $this->crypto->hidden($valor); 
            }
          }
        if ($this->db->update('avaliacao', $novosDados, ['id_avaliacao'=>$id]
        )) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteAvaliacao($id) {
        if($this->db->delete('ong_avaliacao',['id_avaliacao'=>$id])){
            if ($this->db->delete('avaliacao', ['id_avaliacao'=>$id])) {
                return true;
            } else {
                return false;
            }
        }
       
    }
}
