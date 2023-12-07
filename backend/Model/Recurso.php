<?php 

namespace App\Model;

  class Recurso  {

    private $idOng;
    private $nomeRecursos;
    private $situacaoRecursos;
    private $quantidadeRecursos;
    private $descricaoRecursos;
    private $criador;
    private $ip;

    public function getIdOng(){
      return $this->idOng;
    }

    public function setIdOng($idOng){
      $this->idOng = $idOng;
    }
    public function getNomeRecursos(){
      return $this->nomeRecursos;
    }

    public function setNomeRecursos($nomeRecursos){
      $this->nomeRecursos = $nomeRecursos;
    }
    public function getSituacaoRecursos(){
      return $this->situacaoRecursos;
    }

    public function setSituacaoRecursos($situacaoRecursos){
      $this->situacaoRecursos = $situacaoRecursos;
    }
    public function getQuantidadeRecursos(){
      return $this->quantidadeRecursos;
    }

    public function setQuantidadeRecursos($quantidadeRecursos){
      $this->quantidadeRecursos = $quantidadeRecursos;
    }
    public function getDescricao(){
      return $this->descricaoRecursos;
    }
    public function setDescricao($descricaoRecursos){
      $this->descricaoRecursos = $descricaoRecursos;
    }
    public function getCriador(){
      return $this->criador;
    }

    public function setCriador($criador){
      $this->criador = $criador;
    }
    public function getIp(){
      return $this->ip;
    }

    public function setIp($ip){
      $this->ip = $ip;
    }
    }