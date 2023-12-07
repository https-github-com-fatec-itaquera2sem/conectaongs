<?php

namespace App\Controller;

use App\Model\Model;

class PerfilPermissaoController
{
    private $db;
    public function __construct(){
        $this->db = new Model();
    }
    public function adicionarPermissao($perfilId, $permissao){
        $resultado=$this->db->listarPermissao($permissao);
        if(!$resultado){
            $this->db->cadPermissao($permissao);
            return $this->db->associar($perfilId, $this->db->getLastInsertId());
        }else{
            $permissoes = array_column($this->obterPermissoesDoPerfil($perfilId),'permissao',0);

            if(array_search($permissao,$permissoes) != false){
                return false;
            }else{
                return $this->db->associar($perfilId, $resultado[0]['id_permissao']);
            }
        }
    }
    public function removerPermissao($perfilId, $permissao){
        $resultado=$this->db->listarPermissao($permissao);
        return $this->db->desassociar($perfilId, $resultado[0]['id_permissao']);
    }

    public function obterPermissoesDoPerfil($perfilId){
        return $this->db->selectPermissoesPorPerfil($perfilId);
    }

    public function obterPerfisDaPermissao($permissaoId){
        return $this->db->listarPerfisPorPermissao($permissaoId);
    }
    public function listarTodos(){
        return $this->db->listarTodosOsPerfis();
    }
    public function listarPermissoes(){
        return $this->db->listarTodasPermissoes();
    }

}