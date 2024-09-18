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
		$valor = str_replace(",", '.', $valor);
		$valor = (float) $valor; // "5.3" -> 5.3
		$this->valor = $valor;
		$this->imagem = $imagem;
    }

    // Método para exibir as informações do produto
    public function exibirInformacoes() {
		$this->valor = number_format($this->valor, 2, ",", '.');
		return "<div class='card' style='width: 18rem;'>
				<img src='{$this->imagem}' class='card-img-top' style='height: 200px;' alt='...'>
				<div class='card-body p-3 text-center'>
					<h5 class='card-title fs-4'>{$this->nome}</h5>
					<p class='card-text'>{$this->descricao}</p>
					<p class='fs-4 card-text text-success'><strong>R$ {$this->valor}</strong></p>
					<a href='#' class='btn btn-success d-flex align-items-center justify-content-center'>Comprar</a>
				</div>
				</div>";
    }
}