<?php

namespace App\Model;

class Solicitacao{

    private $tipo;    
    private $detalhes;
    private $nivel;
    private $idUsuario;
    private $idLocalizacao;
    private $ip;
    private $criador;

    public function getTipo()
    {
        return $this->tipo;
    }


    public function setTipo($tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }
    public function getDetalhes()
    {
        return $this->detalhes;
    }

    public function setDetalhes($detalhes): self
    {
        $this->detalhes = $detalhes;

        return $this;
    }
    public function getNivel()
    {
        return $this->nivel;
    }


    public function setNivel($nivel): self
    {
        $this->nivel = $nivel;

        return $this;
    }
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }


    public function setIdUsuario($idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }
    public function getIdLocalizacao()
    {
        return $this->idLocalizacao;
    }


    public function setIdLocalizacao($idLocalizacao): self
    {
        $this->idLocalizacao = $idLocalizacao;

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