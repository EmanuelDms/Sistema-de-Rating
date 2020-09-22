$(function(){
    var qtdCategoria = $("#qtdCat").val(), opCat = $("#opCat"), opinar = $(".opinar");
    var butIndex = $(".index");
    opCat.bind('change', function () {
        for (let i = 0; i <= qtdCategoria; i++) {
            if (opCat.val() == 0){
                $('.item'+i).show();        
            }else if (i == opCat.val()) {
                $('.item'+i).show(); 
            }else{
                $('.item'+i).hide();        
            }
        }    
    });

    opinar.bind('click', function () {
        window.location.href = "opinar.php";
    });

    butIndex.bind('click', function () {
        window.location.href = "index.php";
    });

});