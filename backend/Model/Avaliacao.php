<?php

namespace App\Model;

class Avaliacao
{
    private $ip;
    private $idUsuario;
    private $comentario;
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
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    public function getCriador()
    {
        return $this->criador;
    }

    public function setCriador($criador)
    {
        $this->criador = $criador;
    }
}
