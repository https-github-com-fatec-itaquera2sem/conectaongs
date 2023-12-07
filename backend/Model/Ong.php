<?php 
namespace App\Model;

class Ong {
  private $id;
  private $nome;
  private $tipo;
  private $telefone;
  private $avaliacao;
  private $idRecursos;
  private $idVagas;
  private $idEndereco;
  private $ip;
  private $criador;
  private $email;
  

  /**
   * Get the value of id
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   */
  public function setId($id): self
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of nome
   */
  public function getNome()
  {
    return $this->nome;
  }

  /**
   * Set the value of nome
   */
  public function setNome($nome): self
  {
    $this->nome = $nome;

    return $this;
  }

  /**
   * Get the value of tipo
   */
  public function getTipo()
  {
    return $this->tipo;
  }

  /**
   * Set the value of tipo
   */
  public function setTipo($tipo): self
  {
    $this->tipo = $tipo;

    return $this;
  }

  /**
   * Get the value of telefone;   */
  public function getTelefone()
  {
    return $this->telefone;
  }

  /**
   * Set the value of telefone;   */
  public function setTelefone($telefone): self
  {
    $this->telefone = $telefone;

    return $this;
  }

  /**
   * Get the value of avaliacao
   */
  public function getAvaliacao()
  {
    return $this->avaliacao;
  }

  /**
   * Set the value of avaliacao
   */
  public function setAvaliacao($avaliacao): self
  {
    $this->avaliacao = $avaliacao;

    return $this;
  }

  /**
   * Get the value of idRecursos
   */
  public function getIdRecursos()
  {
    return $this->idRecursos;
  }

  /**
   * Set the value of idRecursos
   */
  public function setIdRecursos($idRecursos): self
  {
    $this->idRecursos = $idRecursos;

    return $this;
  }

  /**
   * Get the value of idVagas
   */
  public function getIdVagas()
  {
    return $this->idVagas;
  }

  /**
   * Set the value of idVagas
   */
  public function setIdVagas($idVagas): self
  {
    $this->idVagas = $idVagas;

    return $this;
  }

  /**
   * Get the value of idEndereco
   */
  public function getIdEndereco()
  {
    return $this->idEndereco;
  }

  /**
   * Set the value of idEndereco
   */
  public function setIdEndereco($idEndereco): self
  {
    $this->idEndereco = $idEndereco;

    return $this;
  }
  public function getCriador()
  {
      return $this->criador;
  }

  /**
   * Set the value of criador
   */
  public function setCriador($criador): self
  {
      $this->criador = $criador;

      return $this;
  }
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
  public function getEmail()
  {
      return $this->email;
  }

  /**
   * Set the value of email
   */
  public function setEmail($email): self
  {
      $this->email = $email;

      return $this;
  }
}

?>