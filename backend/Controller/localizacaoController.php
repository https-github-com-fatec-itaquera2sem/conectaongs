<?php

namespace App\Controller;

use App\Model\Model;
use App\Controller\Cryptonita;

class LocalizacaoController {
    private $db;
    private $localizacao;
    private $crypto;

    public function __construct($localizacao) {
        $this->db = new Model();
        $this->localizacao =  $localizacao;
        $this->crypto = new Cryptonita();
    }

    public function getLocalizacaoList() {
    $localizacaoList = $this->db->select('localizacao');
      foreach($localizacaoList as $key => $value){
        foreach($value as $campo=>$valor){
            if( !$valor || !$this->crypto->show($valor)){}else{
              $localizacaoList[$key][$campo]= $this->crypto->show($valor); 
            }
        }
      }
      return $localizacaoList;
    }

    public function getLocalizacaoById($id) {
        $localizacaoList = $this->db->select('localizacao', ['id_localizacao'=>$id]);
        $localizacaoList= $localizacaoList[0];
          foreach($localizacaoList as $campo=>$valor){
              if($campo=="Latitude"|| $campo=="Longitude"|| !$valor || !$this->crypto->show($valor)){}else{
                $localizacaoList[$campo] = $this->crypto->show($valor); 
              }
        }
     
        return $localizacaoList;
    }
    public function getLocalizacaoByOngId($id) {
        $localizacaoidList = $this->db->select('ong_localizacao', ['id_ong'=>$id]);
        foreach($localizacaoidList as $key => $value){
          foreach($value as $campo=>$valor){
            if($campo=='id_ong'){}else{
              $localizacao = $this->getlocalizacaoById($valor);
              unset($localizacao['id_localizacao']);
              array_push($localizacaoidList[$key], $localizacao);
            }
          }
        }
        return $localizacaoidList;
    }
    public function getLocalizacaoByUsuarioId($id) {
        $localizacaoidList = $this->db->select('usuario_localizacao', ['id_usuario'=>$id]);
        foreach($localizacaoidList as $key => $value){
          foreach($value as $campo=>$valor){
            if($campo=='id_usuario'){}else{
              $localizacao = $this->getlocalizacaoById($valor);
              unset($localizacao['id_localizacao']);
              unset($localizacao['Latitude']);
              unset($localizacao['Longitude']);
              array_push($localizacaoidList[$key], $localizacao);
            }
          }
        }
        return $localizacaoidList;
    }


    public function createLocalizacao() {

        if ($this->db->insert('localizacao', [
            'Pais' => $this->localizacao->getPais(),
            'Cidade' => $this->localizacao->getCidade(),
            'Estado' => $this->localizacao->getEstado(),
            'CEP' => $this->localizacao->getCEP(),
            'Bairro' => $this->localizacao->getBairro(),
            'Rua' => $this->localizacao->getRua(),
            'IP' => $this->localizacao->getIP(),
            'Criador' => $this->localizacao->getCriador(),
            'Latitude' => $this->localizacao->getLatitude(),
            'Longitude' => $this->localizacao->getLongitude()
        ])) {
            $id=$this->db->getLastInsertId();
            return ['status'=>true, 'Lastid'=>$id];
        } else {
            return false;
        }
    }

    public function updateLocalizacao($dadosNovos, $id) {
        foreach($dadosNovos as $campo=>$valor){
            if(is_int($valor)){}else{
              $dadosNovos[$campo] = $this->crypto->hidden($valor); 
            }
          }
        if ($this->db->update('localizacao', $dadosNovos, ['id_localizacao' => $id])) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteLocalizacao($id) {
        if ($this->db->delete('localizacao', ['id_localizacao' => $id])) {
            return true;
        } else {
            return false;
        }
    }
}