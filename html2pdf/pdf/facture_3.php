<table class="w100 b0" cellspacing="14mm" cellpadding="0" align="center" rules="cols" style="border: 0px;">
	<tr>
		<td class="myalc" style="width: 50%;border: 0.1mm #969696;">
			<?php  	$som=0;
				include('entete.php');
			?>
			
			<table class="w1 b0" cellspacing="1mm" cellpadding="0">
				<tr>	
					<td></td>
					<td class="myalg cl1 t2">Client:</td>
					<td class="myalg cl1 t2"><?php echo $client?></td>
					<td class="myalg cl1 t2">Facture numero:</td>
					<td class="myalg cl1 t2"><?php echo num_facture($id_fac)?></td>
					<td class="myalg cl1 t2"><?php echo $date_fac?></td>
				</tr>
			</table>
	
			<table class="w90 b0" cellspacing="0mm" cellpadding="0" align="center">
				<tr>
					<td></td>
				</tr>
			</table><br/>


			<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
				<tr>
					<th style="width: 4px"></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>			
				</tr>
		
				echo '<tr>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td><sup>F</sup></td>';
					echo '<td><sup>F</sup></td>';
				echo '</tr>';
	
				<tr>
					<th></th> 
					<th></th>
				</tr>
		
				<tr>
					<th></th> 
					<th></th>
				</tr>
		
				<tr>
					<th></th> 
					<th></th>
				</tr>
		
			</table><br/>
	
	
			<table> 
				<tr>
					<td></td>
				</tr>	
			</table>		
		</td>

		<td class="myalc" style="width: 50%;border: 0.1mm #969696;">
			<?php  	$som=0;
				include('entete.php');
			?>
			
			<table class="w1 b0" cellspacing="1mm" cellpadding="0">
				<tr>
					<td></td>
					<td class="myalg cl1 t2">Client:</td>
					<td class="myalg cl1 t2"><?php echo $client?></td>
					<td class="myalg cl1 t2">Facture numero:</td>
					<td class="myalg cl1 t2"><?php echo num_facture($id_fac)?></td>
					<td class="myalg cl1 t2"><?php echo $date_fac?></td>
				</tr>
			</table>

			<table class="w90 b0" cellspacing="0mm" cellpadding="0" align="center">
				<tr>
					<td></td>
				</tr>
			</table><br/>

			<table id="data" cellspacing="0.2mm" class="bg2 w100" align="center" rules="cols"> 
				<tr>
					<th style="width: 4px"></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>			
				</tr>
		
				echo '<tr>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td><sup>F</sup></td>';
				 	echo '<td><sup>F</sup></td>';
				echo '</tr>';
			
				<tr>
					<th></th> 
					<th></th>
				</tr>

				<tr>
					<th></th> 
					<th></th>
				</tr>

				<tr>
					<th></th> 
					<th></th>
				</tr>
			</table><br/>

			<table> 
				<tr>
					<td></td>
				</tr>
			</table>	
		</td>
	</tr>
</table>


