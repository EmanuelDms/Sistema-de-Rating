<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php
        require_once("funcoes.php");       
        ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Rats are stars!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<body>
<div class="dados">
    <button class="index">Voltar a página principal</button>
<?php 
    // ID Categoria
    $ok = filter_input(INPUT_POST, "ok", FILTER_SANITIZE_STRING);
    $_SESSION["idCategoria"] = $ok;
    if ($ok) {
        $idTrade = filter_input(INPUT_POST, "sel".$ok, FILTER_SANITIZE_STRING);
        $_SESSION["idTrade"] = $idTrade;
        $query = mysqli_query($conn, "SELECT AVG(a.nota_limpeza) as limp, AVG(a.nota_atendimento) as atender, AVG(a.nota_localizacao) as lugar ,AVG(a.nota_qualidade) as quali , t.*, c.* from avaliacao as a, trades as t, categorias as c WHERE t.idtrade = ".$_SESSION["idTrade"]." AND c.idcategoria = ".$_SESSION["idCategoria"]." AND t.idtrade = a.idtradeFK AND a.idcategoriaFK = c.idcategoria;")or die(mysqli_error($conn));
        $row = mysqli_fetch_assoc($query);
        echo "<br><ul type='square'><li>Nome do Comércio: <strong>".$row["nome_trade"]."</strong><br>Categoria: <strong>".$row["nome_categoria"]."</strong>";?>
        <button class="opinar">Dê sua opinião</button>
        <?php
        $limpeza = round($row['limp'],0);
        $atender = round($row['atender'],0);
        $lugar = round($row['lugar'],0);
        $qualidade = round($row['quali'],0);
    
        echo "<br>Critérios: <br>- Limpeza/Higiene: ".$limpeza;
        echo "<br>".estrela('1',round($limpeza/2,0))."- Atendimento: ".$atender;
        echo "<br>".estrela('2',round($atender/2,0))."- Localização: ".$lugar;
        echo "<br>".estrela('3',round($lugar/2,0))."- Qualidade do produto/serviço: ".$qualidade;
        echo "<br>".estrela('4',round($qualidade/2,0));

        $media = ($limpeza + $atender + $lugar + $qualidade)/4;
        echo "<br><p>Média: ".number_format($media, 1, ',', '.')."</p></div>";
    }
    $query1 = mysqli_query($conn, "SELECT * from avaliacao WHERE idtradeFK = ".$_SESSION["idTrade"].";");
    while ($row = mysqli_fetch_assoc($query1)) {
        echo "<div class='opiniao'>";
        $nome = $row['nome_usuario'];
        if (!($row['pros'] == "" || $row['contra'] == '' || $row['sugestao'] == '')) {
            if ($nome == '') {
                $nome = 'Anônimo';
            }
            echo "<p>Nome do Usuário: ".$nome."<br>Prós: ".$row['pros']."<br>Contra: ".$row["contra"]."<br>Sugestão: ".$row["sugestao"]."</p>";
        }
        echo "</div>";
    }
?>

</body>
</html>