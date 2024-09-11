<?php
date_default_timezone_set('America/Sao_Paulo');

class Aluno {
    protected $nome;
    protected $dataNascimento;
    protected $matricula;
    protected $curso;

    /**
     * SETTERS
     */
    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }
    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }
    public function setCurso($curso) {
        $this->curso = $curso;
    }

    /**
     * GETTERS
     */
    public function getNome() {
        return ucfirst($this->nome);
    }
    public function getDataNascimento() {
        return $this->dataNascimento;
    }
    public function getMatricula() {
        return $this->matricula;
    }
    public function getCurso() {
        return $this->curso;
    }

    /**
     * UTILS
     */
    public static function formatDateBR($data) {
        return date_format(date_create($data), 'd/m/Y');
    }

    public static function formatDateUS($data) {
        return date_format(date_create($data), 'Y-m-d');
    }

    public function idade() {
        $dataAtual = new DateTime();
        $idade = $dataAtual->diff(new DateTime($this->dataNascimento));
        return $idade->y;
    }
}