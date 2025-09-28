<?php
    require_once '../core/sql.php';

    $id = 1;
    $nome = 'Camily';
    $email = 'camily123@mail.com';
    $senha = 'mily123';
    $dados = [
        'nome' => $nome,
        'email' => $email,
        'senha' => $senha,
    ];
    $entidade = 'usuario';
    $criterio = [['id', '=', $id]];
    $campos = ['id', 'nome', 'email'];
    print_r($dados);
    echo '<br>';
    print_r($campos);
    echo '<br>';
    print_r($criterio);
    echo '<br>';

    //Teste geracao INSERT:
    $instrucao = insert($entidade, $dados);
    echo $instrucao . '<BR>';

    //Teste geracao UPDATE:
    $instrucao = update($entidade, $dados, $criterio);
    echo $instrucao . '<BR>';
    
    //Teste geracao SELECT:
    $instrucao = select($entidade, $campos, $criterio);
    echo $instrucao . '<BR>';

    //Teste geracao DELETE:
    $instrucao = delete($entidade, $criterio);
    echo $instrucao . '<BR>';
?>