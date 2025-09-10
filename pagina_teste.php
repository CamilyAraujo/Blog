<!DOCTYPE html>
<html>
    <head>
        <title>Post 1 Projeto para Web com PHP</title>
        <link rel="stylesheet"
        href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
</head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    include 'include/topo.php';
                    ?>
                        </div>
                            </div>
                            <div class="row" style="min-height: 500px;">
                            <div class="col-md-12">
                            <?php include 'include/menu.php'; ?>
                            </div>
                            <div class="col-md-10" style="padding-top: 50px;">
                            <h2>Pagina teste includes</h2>
                            </div>
                            </div>
                            <div class="row">
                        <div class="col-md-12">
                    <?php
                    include 'include/rodape.php';
                    ?>
                </div>
            </div>
        </div>
    <script src="lib/bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
    </body>
</html>