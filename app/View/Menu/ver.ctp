<div class='hero-unit'>
    <h2>Menu</h2>
    <strong>Nombre:                 </strong><?php echo $Elemento[0]->men_nombre; ?> <br>
    <strong>Precio:                 </strong><?php echo $Elemento[0]->men_total; ?> <br>
    <strong>Tiempo de Preparación:  </strong><?php echo $Elemento[0]->men_cantidad; ?> <br>
    <strong>Estado:                 </strong>
    <?php if($Elemento[0]->men_estado=="t"){ ?>
    Habilitado
    <?php }else{ ?>
    Deshabilitado
    <?php } ?>
    <br>
    <br>

    <h2>Productos</h2>
    <table class="TablaPromos">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(isset($Productos) && $Productos!=null){
                $contador=0;
                foreach ($Productos as $key => $value) {
                    $idProductos[$contador] = $value->pro_id;
            ?>
                    <tr>
                        <input type="hidden" name="ides[]" value="<?php echo $value->pro_id ?>">
                        <td ><center><?php echo $value->pro_nombre ?></center></td>
                        <td ><center><?php echo $value->pos_cantidad ?></center></td>
                    </tr>
            <?php
                $contador=$contador+1;
                }
            }
            else{
                    $idProductos=null;
            ?>
                    <tr>
                        <td colspan='6'>No hay Productos en el Menu</td>
                    </tr>
      <?php } ?>
        </tbody>
    </table>