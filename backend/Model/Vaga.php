<?php

namespace App\Model;

class Vaga{

    private $ip;
    private $criador;
    private $idUsuario;
    private $servico;
    private $detalhes;
    private $quantidadeDeVagas;

    public function getIp(){

        return $this->ip;

    }
    public function setIp($ip){

        $this->ip = $ip;

    }
    public function getCriador(){

        return $this->criador;

    }
    public function setCriador($criador){

        $this->criador = $criador;

    }
    public function getIdUsuario(){

        return $this->idUsuario;

    }
    public function setIdUsuario($idUsuario){

        $this->idUsuario = $idUsuario;

    }
    public function getServico(){

        return $this->servico;

    }
    public function setServico($servico){

        $this->servico = $servico;

    }
    public function getDetalhes(){

        return $this->detalhes;

    }
    public function setDetalhes($detalhes){

        $this->detalhes = $detalhes;

    }
    public function getQtdVagas(){

        return $this->quantidadeDeVagas;

    }
    public function setQtdVagas($quantidadeDeVagas){

        $this->quantidadeDeVagas = $quantidadeDeVagas;

    }

}
