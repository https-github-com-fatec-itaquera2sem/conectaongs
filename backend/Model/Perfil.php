<?php
namespace App\Model;

class Perfil {
  private int $id;
  private $tipo;
  private $ip;
  private $criador;
  private $idUsuario;

  /**
   * Get the value of id
   */
  public function getId(): int {
    return $this->id;
  }

  /**
   * Set the value of id
   */
  public function setId(int $id): self {
    $this->id = $id;

    return $this;
  }
  public function getTipo(): string {
    return $this->tipo;
  }

  /**
   * Set the value of Tipo
   */
  public function setTipo( $Tipo) {
    $this->tipo = $Tipo;

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

  /**
   * Set the value of idUsuario
   */
  public function setIdUsuario( $idUsuario) {
    $this->idUsuario = $idUsuario;

    return $this;
  }
}
?>