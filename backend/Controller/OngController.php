<?php
namespace App\Controller;
use App\Model\Model;
use App\Model\Ong;
use App\Controller\Cryptonita;
use App\Controller\AvaliacaoController;
use App\Controller\RecursoController;
use App\Controller\VagaController;
use App\Model\Endereco;

class OngController {
  private $db;
  private $ong;
  private $crypto;
  private $avaliacaoController;
  private $recursoController;
  private $endereco;
  private $vagaController;

  public function __construct() {
    $this->db = new Model();
    $this->ong = new Ong();
    $this->endereco = new Endereco();
    $this->crypto = new Cryptonita();
    $this->avaliacaoController= new AvaliacaoController();
    $this->recursoController = new RecursoController();
    $this->vagaController = new VagaController();
  }

  public function getOngList() {
    $ongList = $this->db->select('ong');
    foreach($ongList as $key => $value){
      foreach($value as $campo=>$valor){
          if(!$valor || !$this->crypto->show($valor)){}else{
            $ongList[$key][$campo]= $this->crypto->show($valor); 
          }
      }
    }
    return $ongList;
  }

  public function getOngById($id) {
    $ongList = $this->db->select('ong', ['id_ong'=>$id]);
    $ongList= $ongList[0];
      foreach($ongList as $campo=>$valor){
          if( !$valor || !$this->crypto->show($valor)){}else{
            $ongList[$campo] = $this->crypto->show($valor); 
          }
    }
    return $ongList;
  }

  public function getOngByTipo($tipo) {
    $ongList = $this->db->select('ong', ['area_de_atuacao'=>$tipo]);
    foreach($ongList as $key => $value){
      foreach($value as $campo=>$valor){
          if(!$valor || !$this->crypto->show($valor)){}else{
            $ongList[$key][$campo]= $this->crypto->show($valor); 
          }
      }
    }
    return $ongList;
  }

  public function getVagaByOngId($id) {
    $vagaidList = $this->db->select('ong_vagas', ['id_ong'=>$id]);
    foreach($vagaidList as $key => $value){
      foreach($value as $campo=>$valor){
        if($campo=='id_ong'){}else{
          $Vaga = $this->vagaController->getVagaById($valor);
          unset($Vaga['id_vagas_emprego']);
          array_push($vagaidList[$key], $Vaga);
        }
      
      }
      
    }

    return $vagaidList;
  }

  public function getRecursoByOngId($id) {
    $recursoidList = $this->db->select('ong_recursos', ['id_ong'=>$id]);
    foreach($recursoidList as $key => $value){
      foreach($value as $campo=>$valor){
        if($campo=='id_ong'){}else{
          $recurso = $this->recursoController->getRecursoById($valor);
          unset($recurso['id_recursos']);
          array_push($recursoidList[$key], $recurso);
        }
      
      }
      
    }

    return $recursoidList;
  }

  
  public function getAvaliacaoByOngId($id) {
    $avaliacaoidList = $this->db->select('ong_avaliacao', ['id_ong'=>$id]);
    foreach($avaliacaoidList as $key => $value){
      foreach($value as $campo=>$valor){
        if($campo=='id_ong'){}else{
          $avaliacao = $this->avaliacaoController->getAvaliacaoById($valor);
          unset($avaliacao['id_avaliacao']);
          array_push($avaliacaoidList[$key], $avaliacao);
        }
      
      }
      
    }

    return $avaliacaoidList;
  }

  public function getOngByNome($nome) {
    $ongList = $this->db->select('ong', ['nome'=>$nome]);
    foreach($ongList as $key => $value){
      foreach($value as $campo=>$valor){
          if(!$valor || !$this->crypto->show($valor)){}else{
            $ongList[$key][$campo]= $this->crypto->show($valor); 
          }
      }
    }
    return $ongList;
  }

  public function AddOngLocalizacao($id, $dado){
    $usuario= $this->db->select('usuario', ['id_usuario'=> $dado['id_usuario']]);
    $this->endereco->setPais($this->crypto->hidden($dado['Pais']));
    $this->endereco->setCidade($this->crypto->hidden($dado['Cidade']));
    $this->endereco->setEstado($this->crypto->hidden($dado['Estado']));
    $this->endereco->setCEP($dado['CEP']);
    $this->endereco->setBairro($this->crypto->hidden($dado['Bairro']));
    $this->endereco->setRua($this->crypto->hidden($dado['Rua']));
    $this->endereco->setIP($this->crypto->hidden($_SERVER['REMOTE_ADDR']));
    $this->endereco->setCriador($usuario[0]['Nome']);
    $this->endereco->setLatitude($dado['Latitude']);
    $this->endereco->setLongitude($dado['Longitude']);
    $localizacaoController= new LocalizacaoController($this->endereco);
    $resultado = $localizacaoController->createLocalizacao($this->endereco);
    $idLocalizacao = $resultado['Lastid'];
    if($resultado['status']){
      $this->db->insert("ong_localizacao",[
          'id_ong' =>$id,
          'id_localizacao'=>$idLocalizacao
      ]);
      return true;
    }else{
      return false;
    }

  }

  public function createOng($dado) {
    $usuario= $this->db->select('usuario', ['id_usuario'=> $dado['id_usuario']]);
    $this->ong->setNome($this->crypto->hidden($dado['nome']));
    $this->ong->setTipo($this->crypto->hidden($dado['area_de_atuacao']));
    $this->ong->setTelefone($dado['telefone']);
    $this->ong->setEmail($this->crypto->hidden($dado['email']));
    $this->ong->setIp($this->crypto->hidden($_SERVER['REMOTE_ADDR']));
    $this->ong->setCriador($usuario[0]['Nome']);
    if ($this->getOngByNome($this->ong->getNome())) {
      return "Ong já existe!";
    } else {
        if ($this->db->insert('ong', [
          'nome' => $this->ong->getNome(),
          'area_de_atuacao' => $this->ong->getTipo(),
          'telefone' => $this->ong->getTelefone(),
          'email' => $this->ong->getEmail(),
          'IP' => $this->ong->getIp(),
          'Criador' => $this->ong->getCriador()
        ])) {
          $id= $this->db->getLastInsertId();
          $this->endereco->setPais($this->crypto->hidden($dado['Pais']));
          $this->endereco->setCidade($this->crypto->hidden($dado['Cidade']));
          $this->endereco->setEstado($this->crypto->hidden($dado['Estado']));
          $this->endereco->setCEP($dado['CEP']);
          $this->endereco->setBairro($this->crypto->hidden($dado['Bairro']));
          $this->endereco->setRua($this->crypto->hidden($dado['Rua']));
          $this->endereco->setIP($this->crypto->hidden($_SERVER['REMOTE_ADDR']));
          $this->endereco->setCriador($usuario[0]['Nome']);
          $this->endereco->setLatitude($dado['Latitude']);
          $this->endereco->setLongitude($dado['Longitude']);
          $localizacaoController= new LocalizacaoController($this->endereco);
          $resultado = $localizacaoController->createLocalizacao($this->endereco);
          $idLocalizacao = $resultado['Lastid'];
          if($resultado['status']){
          $this->db->insert("ong_localizacao",[
              'id_ong' =>$id,
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

    public function updateOng($dadosNovos, $id) {
      foreach($dadosNovos as $campo=>$valor){
        if(is_int($valor) || $valor ='telefone'){}else{
          $dadosNovos[$campo] = $this->crypto->hidden($valor); 
        }
      }
      if($this->db->update('ong', $dadosNovos, ['id_ong'=>$id])) {
        return true;
      } else {
        return false;
      }
    }
    
    public function deleteOng($id) {
      if ($this->db->delete('ong', ['id_ong'=>$id])) {
        return true;
      } else {
        return false;
      }
    }
  }
?>