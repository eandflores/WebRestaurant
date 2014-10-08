<div class='row'>
    <div class='span12'>
        <h3>Listado de clientes</h3>

        <table class='table table-bordered table-striped table-hover'>
            <thead>
                <tr>
                    <th>RUT</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <!--<th>Password</th>-->
                    <th>Operaciones</th>
                </tr>
            </thead>
            <tboby>
                <?php 
                    if(!empty($emp)){
                        foreach ($emp as $key => $value) {
                            echo "<tr>";
                            echo "<td>".$value->cli_rut."</td>";
                            echo "<td>".$value->cli_nombre."</td>";
                            echo "<td>".$value->cli_apellido."</td>";
                            echo "<td>".$value->cli_correo."</td>";
                            echo "<td>".$value->cli_telefono."</td>";
                            echo "<td>".$value->cli_direccion."</td>";
                            //echo "<td>".$value->cli_password."</td>";
                            echo "<td>";
                            echo "<a href='/furaibar/Cliente/view/".$value->cli_rut."'><i class='icon-white icon-search'></i></a>";
                            echo "<a href='/furaibar/Cliente/edit/".$value->cli_rut."'><i class='icon-white icon-pencil'></i></a>";
                            echo "<a href='/furaibar/Cliente/eliminar/".$value->cli_rut."'><i class='icon-white icon-trash'></i></a>";
                            echo "</tr>";
                        }
                    }else{
                        echo "<tr><td colspan='6' style='text-align:center;'>SIN REGISTROS EN LA BASE DE DATOS</td></tr>";
                    }

                ?>
            </tbody>
        </table>
    </div>
</div>





<form class="form-horizontal" action="/furai/Deusuario/cuantopido2">
    <fieldset>
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
    	<h2>Recomendacion: </h2>
        <div class="control-group success" >
        	<h3><?php echo $totalsushi ?> Productos sea en Tradicionales, Snacks, 
            	Delicious o A tu gusto </h4></label>
            
        </div>
    </fieldset>
 </form>
