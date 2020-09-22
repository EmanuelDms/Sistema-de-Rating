 <!--
    *Créditos (pelo rating): Steve Griffith -> https://youtu.be/dPCj6Qkq13Y 
    * alternate codepen version https://codepen.io/mad-d/pen/aJMPWr?editors=0010
    Alterações: Emanuel D. Maia;
    
-->
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
    <header>
        <h1 class="titleHeader">
            Rats are stars!
        <p>Aqui você pode avaliar ou verificar as avaliações dos lugares que deseja!</p>
        <p class="obs">Observação: para avaliar, você deve acessar o estabelecimento desejado!</p>
        </h1>
        
        <h2 class="exibir">&#9755; Exibir</h2>
        <h3 class="categorias">
            <ul class="cate">
                <li>
                Categorias
                <select name="opCat" id="opCat">
                    <option value='0'>Todos</option>
                    <?php
                    $query = mysqli_query($conn, "SELECT * from categorias;");
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo "<option value='".$row['idcategoria']."'>".$row["nome_categoria"]."</option>";
                    }
                    ?>
                </select>
                </li>
            </ul>
        </h3>
    </header>    
    <main>
        <article>
            <form action='trade.php' method='POST'>
            <?php
            $categorias = mysqli_query($conn, "SELECT * from categorias;");
            $i = 0;
            while ($linha = mysqli_fetch_assoc($categorias)) {
                $trades = mysqli_query($conn, "SELECT AVG(a.nota_limpeza) as limpeza, AVG(a.nota_atendimento) as atender, AVG(a.nota_localizacao) as lugar, AVG(nota_qualidade) as qualidade, t.* from categorias as c, avaliacao as a, trades as t WHERE c.idcategoria = ".$linha['idcategoria']." AND a.idcategoriaFK = c.idcategoria;") or die(mysqli_error($conn));
                $trade = mysqli_fetch_assoc($trades);
                $limpeza = number_format($trade['limpeza'],0 ,".",".");
                $atender = number_format($trade['atender'],0 ,".",".");
                $lugar = number_format($trade['lugar'],0 ,".",".");
                $qualidade = number_format($trade['qualidade'],0 ,".",".");
                $media = ($limpeza + $atender + $lugar + $qualidade)/4;
                echo "<div class='item".$linha['idcategoria']."'>";
                echo "Categoria: <strong>".$linha['nome_categoria']."</strong><ul class='uls'>";
                echo "<li>Limpeza/Higiene:&nbsp;".$limpeza;
                echo "</li>".estrela($i.'1',round($limpeza/2,0))."<li>Atendimento: ".$atender;
                echo "</li>".estrela($i.'2',round($atender/2,0))."<li>Localização: ".$lugar;
                echo "</li>".estrela($i.'3',round($lugar/2,0))."<li>Qualidade do produto/serviço: ".$qualidade;
                echo "</li>".estrela($i.'4',round($qualidade/2,0))."<p>Média Global: ".number_format($media, 1, ',', '.')."</p>";
                echo estrela($i.'5',round($media/2,0))."<br><select name='sel".$linha['idcategoria']."'>";
                $trade = mysqli_query($conn, "SELECT * from trades as t WHERE idcategoriaFK = ".$linha['idcategoria'].";");
                while ($row = mysqli_fetch_assoc($trade)){
                    echo "<option value='".$row['idtrade']."'>".$row['nome_trade']."</option>";
                }
                echo "</select><button name='ok' value='".$linha['idcategoria']."'>Ir para a página</button></div>";
                $i++;
                
            }
            $categorias = mysqli_query($conn, "SELECT count(idcategoria) as c from categorias;");
            $co = mysqli_fetch_assoc($categorias);
            $cont = $co["c"];
            ?>
            <input type="hidden" id="qtdCat" name='qtdCat' value="<?= $cont ?>">
            </form>
        </article>
    </main>
</body>
</html>