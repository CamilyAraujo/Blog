<?php
function insere (string $entidade, array $dados) : bool
{
$retorno = false;
foreach ($dados as $campo => $dado) {
$coringa [$campo] = '?';
$tipo [] = gettype($dado)[0];
$$campo= $dado;
}
$instrucao = insert ($entidade, $coringa);
$conexao = conecta();
$stmt = mysqli_prepare ($conexao, $instrucao);
eval('mysqli_stmt_bind_param($stmt, \'' .implode('', $tipo). '\',$'
. implode(', $', array_keys ($dados)) . ');');
mysqli_stmt_execute($stmt);
$retorno = (boolean) mysqli_stmt_affected_rows($stmt);
$_SESSION['errors'] = mysqli_stmt_error_list($stmt);
mysqli_stmt_close($stmt);
desconecta ($conexao);
return $retorno;
}

function atualiza(string $entidade, array $campos, array $criterio) : bool {
    $retorno = false;
    $tipos = '';
    $valores = [];

    // Monta campos do SET
    $set = [];
    foreach($campos as $campo => $valor){
        $set[] = $campo . " = ?";
        $tipos .= tipo_parametro($valor);
        $valores[] = $valor;
    }

    // Monta critérios do WHERE
    $where = [];
    foreach($criterio as $campo => $valor){
        $where[] = $campo . " = ?";
        $tipos .= tipo_parametro($valor);
        $valores[] = $valor;
    }

    // Query final
    $sql = "UPDATE " . $entidade . " SET " . implode(', ', $set) . " WHERE " . implode(' AND ', $where);

    $conexao = conecta();
    $stmt = mysqli_prepare($conexao, $sql);

    if($stmt){
        // Usa operador splat (...) para passar parâmetros
        mysqli_stmt_bind_param($stmt, $tipos, ...$valores);
        $retorno = mysqli_stmt_execute($stmt);
        $_SESSION['errors'] = mysqli_stmt_error_list($stmt);
        mysqli_stmt_close($stmt);
    }

    desconecta($conexao);

    return $retorno;
}

function tipo_parametro($valor) {
    switch(gettype($valor)) {
        case "integer": return "i";
        case "double":  return "d";
        case "string":  return "s";
        default:        return "b"; // blob
    }
}


function deleta (string $entidade, array $criterio = []) : bool
{
$retorno = false;
$coringa_criterio = [];
foreach ($criterio as $expressao) {
$dado =$expressao [count ($expressao) -1];
$tipo []= gettype ($dado)[0];
$expressao [count ($expressao)- 1] = '?';
$coringa_criterio [] = $expressao;
}
$nome_campo = (count($xpressao) < 4) ? $expressao [0] : $expressao [1];
 $campos_criterio []= $nome_campo;
$$nome_campo = $dado;
$instrucao =delete ($entidade, $coringa_criterio);
$conexao =conecta();
$stmt_mysqli_prepare($conexao, $instrucao);
if (isset($tipo)) {
$comando = 'mysqli stmt bind param($stmt,';
$comando.= "'" . implode('', $tipo). "'";
 $comando .= ', $'.implode(', $', $campos_criterio); 
$comando .= ');';
eval ($comando);
}
mysqli_stmt_execute($stmt);
$retorno= (boolean) mysqli_stmt_affected_rows($stmt);
$SESSION['errors'] = mysqli_stmt_error_list($stmt);
mysqli_stmt_close($stmt);
desconecta ($conexao);
return $retorno;
}

function buscar(string $entidade, array $campos = ['*'], array $criterio = [], string $ordem = null) : array
{
    $retorno = false;
    $coringa_criterio = [];

    foreach($criterio as $expressao) {
        $dado = $expressao[count($expressao) - 1];
        $tipo[] = gettype($dado)[0];
        $expressao[count($expressao) - 1] = '?';
        $coringa_criterio[] = $expressao;

        $nome_campo = (count($expressao) < 4) ? $expressao[0] : $expressao[1];

        if(isset($$nome_campo)) {
            $nome_campo = $nome_campo . '_' . rand();
        }

        $campos_criterio[] = $nome_campo;
        $$nome_campo = $dado;
    }

    $instrucao = select($entidade, $campos, $coringa_criterio, $ordem);

    $conexao = conecta();

    $stmt = mysqli_prepare($conexao, $instrucao);

    if(isset($tipo)) {
        $comando = 'mysqli_stmt_bind_param($stmt, ';
        $comando .= "'" . implode('', $tipo) . "'";
        $comando .= ', $' . implode(', $', $campos_criterio);
        $comando .= ');';
        eval($comando);
    }

    mysqli_stmt_execute($stmt);

    if($result = mysqli_stmt_get_result($stmt)) {
        $retorno = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
    }

    $_SESSION['errors'] = mysqli_stmt_error_list($stmt);

    mysqli_stmt_close($stmt);

    desconecta($conexao);

    $retorno = $retorno;
    return $retorno;
}

?>