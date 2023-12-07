<?php
namespace App\Model;

class Permissao {
  private int $idUsuario;
  private string $nome;
  private $ip;
  private $criador;

  public function getIp()
  {
      return $this->ip;
  }

  /**
   * Set the value of ip
   */
  public function setIp($ip): self
  {
      $this->ip = $ip;

      return $this;
  }
  public function getCriador()
  {
      return $this->criador;
  }

  public function setCriador($criador)
  {
      $this->criador = $criador;
  }
  public function getIdUsuario()
  {
      return $this->idUsuario;
  }

  public function setIdUsuario($idUsuario)
  {
      $this->idUsuario = $idUsuario;
  }

  /**
   * Get the value of nome
   */
  public function getNome(): string {
    return $this->nome;
  }

  /**
   * Set the value of nome
   */
  public function setNome(string $nome): self {
    $this->nome = $nome;

    return $this;
  }
}
?>