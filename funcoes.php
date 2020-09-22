<link rel="stylesheet" type="text/css" href="style.css">
<script src="jquery.js"></script>
<script src="script.js"></script>
<?php
$conn = mysqli_connect("localhost", "root", "", "avaliar")or die(mysqli_connect_error());
session_start();
//echo ( $sexo == "Masculino" ? "Você é homem" : "Você é mulher" );


function estrela_op($i){?>
<style>
    <?= '.stars'.$i ?>{
    color: goldenrod;
    font-size: 2.0rem;
    padding: 0 1rem; /* space out the stars */
  }
  <?= '.star'.$i ?>::before{
    content: '\2606';    /* star outline */
    cursor: pointer;
  }
  <?= '.star'.$i ?>.rated::before{
    /* the style for a selected star */
    content: '\2605';  /* filled star */
  }
  
  <?= '.stars'.$i ?>{
      /* rateme é um nome para o contador do css */
      counter-reset: rateme 0;   
      font-size: 2.0rem;
      font-weight: 900;
  }
  <?= '.star'.$i ?>.rated{
      /* todo elemento que tiver a class 'star rated', somará mais um no contador 'rateme' */
      counter-increment: rateme 1;
  }
  <?= '.stars'.$i ?>::after{
      /* vai printar o contador 'rateme' colocando o texto '/5' */
      content: counter(rateme) '/5';
  }
</style>
    <input type="hidden" name="cont<?= $i ?>" id="cont<?= $i ?>" value="0">
    <div class="stars<?= $i ?>" data-rating="0">
        <span class="<?= 'star'.$i ?>">&nbsp;</span>
        <span class="<?= 'star'.$i ?>">&nbsp;</span>
        <span class="<?= 'star'.$i ?>">&nbsp;</span>
        <span class="<?= 'star'.$i ?>">&nbsp;</span>
        <span class="<?= 'star'.$i ?>">&nbsp;</span>
    </div>
    <script>
        //initial setup
        document.addEventListener('DOMContentLoaded', function(){
            let stars = document.querySelectorAll('.star<?= $i ?>');
            stars.forEach(function(star){
                star.addEventListener('click', setRating<?= $i ?>);
            });
        });

        function setRating<?= $i ?>(ev){
            let cont = document.getElementById("cont<?= $i ?>"), cont_aux = cont.value;
            let span = ev.currentTarget;
            let stars = document.querySelectorAll('.star<?= $i ?>');
 
            /*Essa variáves 'match' vai servir para localização da estrela clicada dentro do array*/
            let match = false;
            let num = 0;
            //Laço de repetição no array Stars
            stars.forEach(function(star, index){
                if(match){
                    star.classList.remove('rated');
                }else{
                    star.classList.add('rated');
                }
                //Aqui, estamos olhando para a span clicado
                if(star === span){
                    match = true;
                    num = index + 1;
                    cont.value = num;
                }
            });
            /* Fiz essa modificação, de modo que quando o usuário clique numa mesma estrela 2 vezes ele 'resete' para zero*/
            if (cont.value == cont_aux) {
                stars.forEach(function(star, index){
                    star.classList.remove('rated');
                });
                num = 0;
                cont.value = num;
            }
            document.querySelector('.stars<?= $i ?>').setAttribute('data-rating', num);
        }
    </script>    
<?php
}

function estrela($i, $j){
    $cor = 'goldenrod';
    if ($j >= 1 && $j <= 2){
        $cor = 'red';
    }else if($j >= 3 && $j <= 4){
        $cor = 'goldenrod';
    }else if ($j == 5){
        $cor = 'green';
    }
    ?>
<style>
    <?= '.stars'.$i ?>{
    color: <?= $cor ?>;
    font-size: 2.0rem;
    padding: 0 1rem; /* space out the stars */
  }
  <?= '.star'.$i ?>::before{
    content: '\2606';    /* star outline */
  }
  <?= '.star'.$i ?>.rated::before{
    /* the style for a selected star */
    content: '\2605';  /* filled star */
  }
  
  <?= '.stars'.$i ?>{
      /* rateme é um nome para o contador do css */
      font-size: 2.0rem;
      font-weight: 900;
  }
</style>
    <input type="hidden" id="cont<?= $i ?>" name="cont<?= $i ?>" value="0">
    <div class="stars<?= $i ?>" data-rating="<?= $j ?>">
        <span class="star<?= $i ?>">&nbsp;</span>
        <span class="star<?= $i ?>">&nbsp;</span>
        <span class="star<?= $i ?>">&nbsp;</span>
        <span class="star<?= $i ?>">&nbsp;</span>
        <span class="star<?= $i ?>">&nbsp;</span>
    </div>
    <script>
        //initial setup
        document.addEventListener('DOMContentLoaded', function(){
            let cont = document.getElementById("cont<?= $i ?>"), cont_aux = cont.value;
            let rating = parseInt(document.querySelector('.stars<?= $i ?>').getAttribute('data-rating'));
            let match = false;
            let num = 0;
            let stars = document.querySelectorAll('.star<?= $i ?>');
            stars.forEach(function(star, index){
                if(match){
                    star.classList.remove('rated');
                }else{
                    star.classList.add('rated');
                }
                //Aqui, estamos olhando para a span clicado
                if(index === (rating-1)){
                    match = true;
                    num = index + 1;
                    cont.value = num;
                }
            });
            if (cont.value == cont_aux) {
                stars.forEach(function(star, index){
                    star.classList.remove('rated');
                });
                num = 0;
                cont.value = num;
            }
        });
    </script>   
    <?php
    }
?>