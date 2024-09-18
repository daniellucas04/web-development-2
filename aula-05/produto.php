<?php 

class Produto {
    public $nome;
    public $descricao;
    public $valor;
    public $imagem;

    // Construtor para inicializar os atributos
    public function __construct($nome, $descricao, $valor, $imagem) {
	$this->nome = $nome;
	$this->descricao = $descricao;
	$valor = (float) $valor; // "5.3" -> 5.3
	$this->valor = $valor;
	$this->imagem = $imagem;
    }

    // Método para exibir as informações do produto
    public function exibirInformacoes() {
	echo "Nome: " . $this->nome . "<br>";
	echo "Descrição: " . $this->descricao . "<br>";
	echo "Valor: R$" . number_format($this->valor, 2, ',', '.') . "<br>";
	echo "Imagem: " . $this->imagem . "<br>";
    }
}