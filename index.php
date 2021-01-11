<?php
// Define o Path para não haver erros em includes em hosts linux e windows
define("DIR_ROOT_PATH", __DIR__ . "/");

// Define contadores
$hostatual = 0;
$banlistatual = 0;

// Define o maximo de hosts por banlist
$num_max_hots_banlist = 3000;

// Define a Banlist Geral
$banlist_geral = DIR_ROOT_PATH . "banlist.txt";

// Define o Diretorio Onde irão ficar as BanLists Criadas
$banlist_dir = DIR_ROOT_PATH . "banlists/";

// Armazena o conteudo da Banlist Geral
$resultado = file($banlist_geral);

// Ordena o Array em Ordem Crecente
asort($resultado);

$quantidade_hosts_obtidos = count($resultado);

// Divide a array de resultado em blocos de array que serão criadas
$resultado = array_chunk($resultado, $num_max_hots_banlist);

// Define a quantidade de indices
$quantidade_indices_array = count($resultado);

// Percorre os Indices de Array da banlist que contem a disão por blocos
for ($i = 0; $i < $quantidade_indices_array; $i++)
{
    // Abre o novo arquivo de banlists
    $nome_nova_banlist = DIR_ROOT_PATH . 'banlists/'.$i.'.banlist.txt';
    $nova_banlist = fopen($nome_nova_banlist, 'w');

    // verifica se foi possivel criar o arquivo
    if($nova_banlist == false) die ("Erro ao criar a banlist: ".$nome_nova_banlist);

    // Converte bloco de array para string
    $escrita = implode('',$resultado[$i]);

    // Escreve bloco de array na banlist
    fwrite($nova_banlist, $escrita);

    // Fecha o Arquivo de Nova Banlist
    fclose($nova_banlist);
}