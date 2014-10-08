<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <div style="width: 300px; height: 600px">
        	<?php 
			if(!empty($DatosM)){
									$i=0; 
									?>
									<!--<table  cellpadding="0" cellspacing="0">--> 
									<?php
									foreach ($DatosM as $key => $value) {
										if($value->ven_id!=$i && $i!=0 ){?>
												<hr align="LEFT" size="1" width="300" color="Black" noshade> 
												<tr>
												<td>TOTAL</td> 
												<hr align="LEFT" size="1" width="300" color="Black" noshade> 
												<td><?php echo "  ".$total?></td>
												</tr>
											
											<?php $i=0;
										}										

										if($i==0 ){?>
												<hr align="LEFT" size="1" width="300" color="Black" noshade>
												<tr>
												<td><?php echo $value->ven_fecha ?> </td>
												<td>-----VENTA-----</td>
												<td><?php echo $value->ven_id ?></td>
												</tr>
												<hr align="LEFT" size="1" width="300" color="Black" noshade>
												<tr>  
												DETALLE
												<hr align="LEFT" size="1" width="300" color="Black" noshade>  
												</tr>
											
										<?php }

										if($value->ven_id==$i || $i==0){
											if($value->men_id!=null){ ?>
											
												<td><?php echo "pedido".$value->ped_id ?></td>	
												<td><?php echo $value->men_nombre ?></td>
												<td ><?php echo $value->men_total ?></td>
												
												<!--<p align="right"><?php echo $value->men_total ?></p>-->
												<br>
												
											<?php }
											if($value->pro_id!=null){ ?>
												
												<td><?php echo "pedido".$value->ped_id ?></td> 
												<td><?php echo $value->pro_nombre ?></td>
												<td><?php echo $value->pro_precio ?></td>
												<br>
											
											<?php }
										}
										$total=$value->ven_total;
										$i=$value->ven_id;
										
									}
									?>
								
								<hr align="LEFT" size="1" width="300" color="Black" noshade>
								<tr> 	
								<td>TOTAL</td> 
								<p align="right"><?php echo $total ?></p>
								<hr align="LEFT" size="1" width="300" color="Black" noshade> 
								</tr>
									<?php
			}
			?>
        </div>
    </body>
</html>




