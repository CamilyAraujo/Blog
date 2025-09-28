<?php
    session_start();
?>

<div class="card">
    <div class="card-header">
<<<<<<< HEAD
        <h1>Projeto Blog em PHP + MySQL IFSP - Camily</h1>
    </div>
    <?php if(isset($_SESSION['login'])): ?>
    <div class="card-body text-right">
        Olá <?php echo $_SESSION['login']['usuario']['nome'] ?>!
        <a href="core/usuario_repositorio.php?acao=logout"
           class="btn btn-link btn-sm" role="button">Sair</a>
    </div>
    <?php endif ?>
</div>
=======
        <h1> Projeto Blog em PHP + MySql IFSP - KaueBalani </h1>
    </div>
    <?php
        if (isset($_SESSION['login'])):
    ?>
    <div class="card-body text-right">
            Olá <?php echo $_SESSION['login']['usuario']['nome'] ?>!
    </div>
    <a href="core/usuario_repositorio.php?acao=logout"
        class="btn btn-link btn-sm" role="button">Sair</a>
</div>
<?php
    endif
?>
>>>>>>> 6b6ac728b88abb5a3e2626c85bf7e6d8581b4ba6
