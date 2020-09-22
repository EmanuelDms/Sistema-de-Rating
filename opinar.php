<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php
        require_once("funcoes.php");       
        ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Rats are stars! - Página de Exibição</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<body>
    <div class="dados">
    <button class="index">Voltar a página principal</button>
<hr>
    <form action='opinar.php' method='POST'>
    <?php
        $query = mysqli_query($conn, "SELECT t.*, c.* from trades as t, categorias as c WHERE t.idtrade = ".$_SESSION["idTrade"]." AND c.idcategoria = ".$_SESSION["idCategoria"]." AND t.idcategoriaFK = c.idcategoria;");
        $row = mysqli_fetch_assoc($query);
        echo "<ul type='none'>";
            echo "<li>Nome do Comércio: <strong>".$row["nome_trade"]."</strong></li>";
            echo "<li>Categoria: <strong>".$row["nome_categoria"]."</strong></li>";?>
        <p>
            <label>Nome:</label>&nbsp;<input type="text" name="nome" placeholder="(opcional)"/>
        </p>
        <ul>
            <li>Critérios</li>
        </ul>
        <p>
            <ul class='uls'>
                <li>Limpeza: <?php estrela_op(1); ?></li>
                <li>Atendimento: <?php estrela_op(2); ?></li>
                <li>Localização: <?php estrela_op(3); ?></li>
                <li>Qualidade do produto/serviço: <?php estrela_op(4); ?></li>
            </ul>
        </p>
        <li><p>Prós</p>
        <textarea name="pros" placeholder='Pró(s) do estabelecimento...'></textarea>
        </li>
        <li><p>Contra</p>
        <textarea name="contra" placeholder='Contra(s) do estabelecimento...'></textarea>
        </li>
        <li><p>Sugestão</p>
        <textarea name="sug" placeholder='Sugestão do estabelecimento...'></textarea>
        </li>
        </ul>
        <p><input type="submit" name="oks" value="Avaliar"></p>
    </form>
    
<hr>
</div>
    <?php
    if(@$_POST["oks"]){
        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
        $pro = filter_input(INPUT_POST, "pros", FILTER_SANITIZE_STRING);
        $contra = filter_input(INPUT_POST, "contra", FILTER_SANITIZE_STRING);
        $sugestao = filter_input(INPUT_POST, "sug", FILTER_SANITIZE_STRING);
        $cont1 = filter_input(INPUT_POST, "cont1", FILTER_SANITIZE_STRING);
        $cont2 = filter_input(INPUT_POST, "cont2", FILTER_SANITIZE_STRING);
        $cont3 = filter_input(INPUT_POST, "cont3", FILTER_SANITIZE_STRING);
        $cont4 = filter_input(INPUT_POST, "cont4", FILTER_SANITIZE_STRING);
        $avaliar = array($cont1,$cont2,$cont3,$cont4);

        foreach ($avaliar as $key => $value) {
            if ($value != 0) {
                $value *= 2;
                $avaliar[$key] = $value;
            }
        }

        $sql = "INSERT INTO avaliacao VALUES (null, '$nome', ".$_SESSION['idTrade'].", ".$_SESSION['idCategoria'].", ".$avaliar[0].", ".$avaliar[1].", ".$avaliar[2].", ".$avaliar[3].", '$pro', '$contra', '$sugestao');";
        $q = mysqli_query($conn, $sql);

        if ($q) {?>
        <script>alert("Avaliação efetuada!"); window.location.href="index.php";</script>
        <?php
        }else{
            die(mysqli_error($conn));
        }


    }
    ?>
</body>
</html>