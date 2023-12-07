<?php

namespace App\Controller;
require "../vendor/autoload.php";
use App\Model\Recurso;
use App\Model\Model;
use App\Controller\Cryptonita;

class RecursoController
{
    private $db;
    private $recurso;
    private $crypto;

    public function __construct()
    {
        $this->db = new Model();
        $this->recurso = new Recurso();
        $this->crypto = new Cryptonita();
    }

    public function getRecursoList()
    {
        $recursosList = $this->db->select('recursos');
        foreach($recursosList as $key => $value){
          foreach($value as $campo=>$valor){
              if($campo == 'id_recursos' || !$valor || !$this->crypto->show($valor)){}else{
                $recursosList[$key][$campo]= $this->crypto->show($valor); 
              }
          }
        }
        return $recursosList;
    }

    public function getRecursoById($id)
    {
        $recursosList = $this->db->select('recursos', ['id_recursos'=>$id]);
        $recursosList= $recursosList[0];
          foreach($recursosList as $campo=>$valor){
              if( !$valor || !$this->crypto->show($valor)){}else{
                $recursosList[$campo] = $this->crypto->show($valor); 
              }
        }
        return $recursosList;
    }

    public function createRecurso($dados)
    {
        $ong = $this->db->select('ong',['id_ong' => $dados['id_ong']]);
        $usuario= $this->db->select('usuario', ['id_usuario'=> $dados['id_usuario']]);
        $this->recurso->setNomeRecursos($this->crypto->hidden($dados['nome']));
        $this->recurso->setIdOng($dados['id_ong']);
        $this->recurso->setQuantidadeRecursos($dados['quantidade_disponivel']);
        $this->recurso->setDescricao($this->crypto->hidden($dados['descricao']));
        $this->recurso->setSituacaoRecursos($this->crypto->hidden($dados['situacao_recurso']));
        $this->recurso->setIp($this->crypto->hidden($_SERVER['REMOTE_ADDR']));
        $this->recurso->setCriador($usuario[0]['Nome']);
        if($ong){
        if ($this->db->insert(
            'recursos',
            [
                'id_ong' => $this->recurso->getIdOng(),
                'nome' => $this->recurso->getNomeRecursos(),
                'situacao_recurso' => $this->recurso->getSituacaoRecursos(),
                'quantidade_disponivel' => $this->recurso->getQuantidadeRecursos(),
                'descricao' => $this->recurso->getDescricao(),
                'IP' => strval($this->recurso->getIP()),
                'Criador'=> $this->recurso->getCriador()
            ]
        )) {
            
                $LastId= $this->db->getLastInsertId();
                $this->db->insert('ong_recursos',[
                    'id_ong' => $ong[0]['id_ong'],
                    'id_recursos' => $LastId
                ]);
                return true;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    public function updateRecurso($novosDados, $id) {
        foreach($novosDados as $campo=>$valor){
            if(is_int($valor)){}else{
              $novosDados[$campo] = $this->crypto->hidden($valor); 
            }
          }
        if ($this->db->update('recursos', $novosDados, ['id_recursos'=>$id])) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteRecurso($id)
    {
        if($this->db->delete('ong_recursos',['id_recursos'=>$id])){
            if ($this->db->delete('recursos', ['id_recursos'=>$id])) {
                return true;
            } else {
                return false;
            }
        }
    }
}
