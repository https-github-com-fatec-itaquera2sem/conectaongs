<?php

namespace App\Model;

 class Endereco{

  private $pais;
  private $cidade;
  private $estado;
  private $cep;
  private $bairro;
  private $rua;
  private $ip;
  private $criador;
  private $idUsuario;
  private $latitude = NULL;
  private $longitude = NULL;

  
  public function getPais()
  {
    return $this->pais;
  }

  public function setPais($pais): self
  {
    $this->pais = $pais;

    return $this;
  }


  public function getCep()
  {
    return $this->cep;
  }

  public function setCep($cep): self
  {
    $this->cep = $cep;

    return $this;
  }


  
  public function getRua()
  {
    return $this->rua;
  }

  public function setRua($rua): self
  {
    $this->rua = $rua;

    return $this;
  }



  function getBairro()
  {
    return $this->bairro;
  }

  public function setBairro($bairro): self
  {
    $this->bairro = $bairro;

    return $this;
  }



  public function getCidade()
  {
    return $this->cidade;
  }

  public function setCidade($cidade): self
  {
    $this->cidade = $cidade;

    return $this;
  }



  public function getEstado()
  {
    return $this->estado;
  }

  public function setEstado($estado): self
  {
    $this->estado = $estado;

    return $this;
  }
  public function getIp() {
    return $this->ip;
  }

  /**
   * Set the value of ip
   */
  public function setIp( $ip) {
    $this->ip = $ip;

    return $this;
  }
  public function getCriador(){
    return $this->criador;
  }

  /**
   * Set the value of Criador
   */
  public function setCriador( $Criador) {
    $this->criador = $Criador;

    return $this;
  }
  public function getIdUsuario(): string {
    return $this->idUsuario;
  }

  public function setIdUsuario( $idUsuario) {
    $this->idUsuario = $idUsuario;

    return $this;
  }
  public function getLatitude() {
    return $this->latitude;
  }

  public function setLatitude( $latitude) {
    $this->latitude = $latitude;

    return $this;
  }
  public function getLongitude() {
    return $this->longitude;
  }

  public function setLongitude( $longitude) {
    $this->longitude = $longitude;

    return $this;
  }
}