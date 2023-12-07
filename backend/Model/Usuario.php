<?php
  namespace App\Model;
  class Usuario {
    private $id;
    private $tipo; // atributo que serve para identificar o tipo de usuário. Por exemplo AdmGeral, Voluntario, etc
    private $nome;
    private $email;
    private $senha;
    private $criador;
    private $ip;
    private $idPerfil;
    private $idIntencao;
    
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
     * Get the value of email
     */
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
    /**
     * Get the value of senha
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     */
    public function setSenha($senha): self
    {
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);

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

    /**
     * Get the value of idPerfil
     */
    public function getIdPerfil()
    {
        return $this->idPerfil;
    }

    /**
     * Set the value of idPerfil
     */
    public function setIdPerfil($idPerfil): self
    {
        $this->idPerfil = $idPerfil;

        return $this;
    }

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
  }
?>