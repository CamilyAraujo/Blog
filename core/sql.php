<?php
function insert (string $entidade, array $dados): string
{
    $instrucao ="INSERT INTO {$entidade}";
    $campos =implode(', ', array_keys ($dados));
    $valores= implode(', ', array_values ($dados));
    $instrucao .= " ({$campos})";
    $instrucao .= " VALUES ({$valores})";
    return $instrucao;
}

function update (string $entidade, array $dados, array $criterio = []) : string
{
    $instrucao = "UPDATE {$entidade}";
    foreach ($dados as $campo => $dado)
    {
        $set[] = "{$campo} = {$dado}";
        $instrucao .= 'SET' . implode(', ', $set);
        if(!empty($criterio)) 
            {
        $instrucao .= ' WHERE ';
        foreach ($criterio as $expressao) {
        $instrucao.= ' '. implode(' ', $expressao);
            }
        }
    }   
    return $instrucao;
}

function delete (string $entidade, array $criterio = []) : string
{
    $instrucao = "DELETE {$entidade}";
    if(!empty($criterio)) {
        $instrucao .= ' WHERE ';
        foreach ($criterio as $expressao) {
            $instrucao .= ' '. implode(' ', $expressao);
        }
    }
    return $instrucao;
}

function select(string $entidade, array $campos = ['*'], array $criterio = [], string $ordem = null) : string {
    $sql = "SELECT " . implode(', ', $campos) . " FROM " . $entidade;

    if(!empty($criterio)) {
        $sql .= " WHERE ";
        $condicoes = [];
        foreach($criterio as $expressao) {
            $condicoes[] = implode(' ', $expressao);
        }
        $sql .= implode(' AND ', $condicoes);
    }

    if(!empty($ordem)) {
        $sql .= " ORDER BY " . $ordem;
    }

    return $sql;
}


?>
