<style type="text/css">
    a{
        width:100px;
    }
</style>
<?php
    $totalhombres=$_POST['hombres'];
    $totalmujeres=$_POST['mujeres'];
    $totalninios=$_POST['ninios'];
    $totalhambre=$_POST['hambre'];
    $total=$totalhombres+$totalninios+$totalmujeres;
    if ($totalhambre == 0) { $totalsushi=$total*8; }
    if ($totalhambre == 1) { $totalsushi=$total*10; }
    if ($totalhambre == 2) { $totalsushi=$total*14; }
    if ($totalhambre == 3) { $totalsushi=$total*16; }
?>
<h3>Recomendacion: </h3>
<h4>
    <?php echo $totalsushi ?> Productos, ya sea Tradicionales, Snacks, 
        Delicious o a tu gusto 
</h4>
<a style="margin-top:20px" class="btn btn-success" href="/furaibar/Deusuario/comprar">
    Comprar
</a>
<a style="margin-top:20px" class="btn btn-warning" href="/furaibar/Deusuario/cuantopido">
    Atras
</a>
