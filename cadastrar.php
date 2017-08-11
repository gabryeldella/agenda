<!DOCTYPE html>
<html>
<head>
    <title>Pagina Cadastro</title>

    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/css.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/js.js"></script> 
    </head>
</head>
<body>

<div class="row">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="#" class="active" id="login-form-link">Cadastro</a>
                            </div>
                           

                        </div>
                    </div>
                    </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" action="controlador_agenda.php?acao=cadastraUser" method="post">
                                <fieldset>

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="nome">Nome</label>
                                        <div class="col-md-4">
                                            <input id="nome" name="nome" type="text" class="form-control input-md">

                                        </div>
                                    </div>

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="login">Login</label>
                                        <div class="col-md-4">
                                            <input id="login" name="login" type="text" class="form-control input-md">

                                        </div>
                                    </div>

                                    <!-- Password input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="senha">Senha</label>
                                        <div class="col-md-4">
                                            <input id="senha" name="senha" type="password" class="form-control input-md">

                                        </div>
                                    </div>

                                    <!-- Button -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="cadastrar"></label>
                                        <div class="col-md-4">
                                            <button id="cadastrar" name="cadastrar" class="btn btn-warning">CADASTRAR</button>
                                        </div>
                                    </div>

                                </fieldset>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default" href="index.php">Close</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>



    