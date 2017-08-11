<?php
    if(!isset($_SESSION)){
        session_start();
    }
    if (!isset($_GET['acao'])){
        $_GET['acao'] = null;
    }
    function login($login, $senha){
        $lista_usuarios =json_decode(file_get_contents("db/usuarios.json"), true);
        foreach ($lista_usuarios as $user){
            if($login == $user['login'] and $senha == $user['senha']){
                $_SESSION['login']       = $user['login'];
                $_SESSION['nome']        = $user['nome'];
                $_SESSION['esta_logado'] = true;
                header("Location: index.php");
            }
        }
        if (!$_SESSION['esta_logado']) {
            $_SESSION['login'] = $login;
            header("Location: login.php");
        }
    } 
    function logout(){
        session_destroy();
        header("Location: login.php");
    } 
    function cadastrarUser($nome, $login, $senha){
        $lista_usuarios =json_decode(file_get_contents("db/usuarios.json"), true);
        $lista_usuarios[] = array(
            'nome'     => $nome,
            'login'    => $login,
            'senha'    => $senha
        );
        $_SESSION['login'] = $login;
        file_put_contents('db/usuarios.json', json_encode($lista_usuarios, JSON_PRETTY_PRINT));
        header("Location: login.php");
    } 
    function cadastrarContatos ($user, $nome, $email, $telefone){
        $contatos = json_decode(file_get_contents("db/contatos.json"), true);
        $contatos[] = [
            'nome'     => $nome,
            'email'    => $email,
            'telefone' => $telefone,
            'id'       => uniqid(),
            'user'     => $user
        ];
        file_put_contents('db/contatos.json', json_encode($contatos, JSON_PRETTY_PRINT));
        header("Location: index.php");
    } 
    function exclui ($id, $user){
        $contatos = json_decode(file_get_contents("db/contatos.json"), true);
        $contatosExclui = [];
        foreach ($contatos as $cont){
            if ($cont['id'] != $id){
                $contatosExclui[] = $cont;
            }
        }
        $contatoJson = json_encode($contatosExclui, JSON_PRETTY_PRINT);
        file_put_contents('db/contatos.json', $contatoJson);
        header("Location: index.php");
    } //Checked ***
    function editar ($id, $user, $nome, $email, $telefone){
        $contatosEditar = [];
        $contatos = json_decode(file_get_contents("db/contatos.json"), true);
        foreach ($contatos as $contato){
            if ($contato['id'] != $id){
                $contatosEditar[] = $contato;
            } else {
                $contatosEditar[] = array(
                    'nome'     => $nome,
                    'email'    => $email,
                    'telefone' => $telefone,
                    'id'       => $id,
                    'user'     => $user
                );
            }
        }
        $contatoJson = json_encode($contatosEditar, JSON_PRETTY_PRINT);
        file_put_contents('db/contatos.json', $contatoJson);
        header("Location: index.php");
    } 
    function buscar ($user, $busca){
        $meusContatos = pegarcontatos($user);
        $contatos = [];
        /*foreach ($meusContatos as $contato) {
            foreach (str_split($contato["nome"], 3) as $cont){
                foreach (str_split($busca, 3) as $letra){
                    if (strtolower(str_replace(" ", "", $letra)) == strtolower(str_replace(" ", "", $cont))){
                        foreach ($contatos as $contatosBuscados){
                            if ($contatosBuscados["id"] == $contato["id"]){
                                $i = 1;
                                break;
                            }
                        }
                        if ($i < 1){
                            $contatos[] = $contato;
                        }
                    }
                }
            }
        }*/
        $countBusca = strlen($busca);
        foreach ($meusContatos as $contato) {
            $countContato = strlen($contato["nome"]);
            $j = $countContato;
            $verificaId = true;
            for ($i = $countBusca; $i > 1; $i--){
                $cont = str_split($contato["nome"], $j)[0];
                $letra = str_split($busca, $i)[0];
                if (strtolower(str_replace(" ", "", $letra)) == strtolower(str_replace(" ", "", $cont))){
                    foreach ($contatos as $contatosBuscados){
                        if ($contatosBuscados["id"] == $contato["id"]){
                            $verificaId = false;
                            break;
                        }
                    }
                    if ($verificaId){
                        $contatos[] = $contato;
                        break;
                    }
                }
                if ($countBusca >= $countContato){
                    if ($i <= $j and $j > 1){
                        $j--;
                    }
                } elseif ($countBusca < $countContato and $i < $j){
                    $i = $countBusca;
                    $j--;
                }
            }
        }
        return $contatos;
    } 
    function pegarcontatos($user){
        $contatos = json_decode(file_get_contents("db/contatos.json"), true);
        $contatosUser = [];
        foreach ($contatos as $contato){
            if ($contato['user'] == $user){
                $contatosUser[] = $contato;
            }
        }
        return $contatosUser;
    } 
    switch ($_GET['acao']){
        case 'login':
            login($_POST['login'], $_POST['senha']);
            break;
        case 'logout':
            logout();
            break;
        case 'cadastrarContatos':
            cadastrarContatos($_SESSION['login'], $_POST['nome'], $_POST['email'], $_POST['telefone']);
            break;
        case 'cadastraUser':
            cadastrarUser($_POST['nome'], $_POST['login'], $_POST['senha']);
            break;
        case 'editar1':
            editar($_GET['id'], $_SESSION['login'], $_POST['nome'], $_POST['email'], $_POST['telefone']);
            break;
        case 'exclui':
            exclui($_GET['id'], $_SESSION['login']);
            break;
        case 'buscar':
            $contatos = buscar($_SESSION['login'],$_POST['busca']);
            break;
    }
    //ROTAS