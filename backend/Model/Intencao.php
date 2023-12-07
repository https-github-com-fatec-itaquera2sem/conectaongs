<?php 

namespace App\Model;

class Intencao {
  private $idIntencao;
  private $descricao;
  private $horarioDisponivel;
  private $diaSemana;
  private $idUsuario;
  private $ip;
  private $criador;


  /**
   * Get the value of idIntencao
   */
  public function getIdIntencao()
  {
    return $this->idIntencao;
  }

  /**
   * Set the value of idIntencao
   */
  public function setIdIntencao($idIntencao): self
  {
    $this->idIntencao = $idIntencao;

    return $this;
  }

  /**
   * Get the value of descricao
   */
  public function getDescricao()
  {
    return $this->descricao;
  }

  /**
   * Set the value of descricao
   */
  public function setDescricao($descricao): self
  {
    $this->descricao = $descricao;

    return $this;
  }

  /**
   * Get the value of horarioDisponivel
   */
  public function getHorarioDisponivel()
  {
    return $this->horarioDisponivel;
  }

  /**
   * Set the value of horarioDisponivel
   */
  public function setHorarioDisponivel($horarioDisponivel): self
  {
    $this->horarioDisponivel = $horarioDisponivel;

    return $this;
  }

  public function getDiaSemana()
  {
    return $this->diaSemana;
  }

  public function setDiaSemana($diaSemana): self
  {
    $this->diaSemana = $diaSemana;

    return $this;
  }
  /**
   * Get the value of idUsuario
   */
  public function getIdUsuario()
  {
    return $this->idUsuario;
  }

  /**
   * Set the value of idUsuario
   */
  public function setIdUsuario($idUsuario): self
  {
    $this->idUsuario = $idUsuario;

    return $this;
  }
  public function getIp()
  {
    return $this->ip;
  }

  public function setIp($ip): self
  {
    $this->ip = $ip;

    return $this;
  }
  public function getCriador()
  {
    return $this->criador;
  }

  public function setCriador($criador): self
  {
    $this->criador = $criador;

    return $this;
  }
}
?>