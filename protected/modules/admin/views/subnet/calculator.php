<div class="ip_calculator"> 
<form method="get">
	<input type="text" class="net_input" maxlength="15" name="ip" value="<?=@$_GET["ip"]?>" /> IP or network address <br/>
	<input type="text" class="net_input" maxlength="15" name="mask" value="<?=@$_GET["mask"]?>" /> Subnet mask value <br/>
	<input type="submit" value="Show network information" />
</form>
<?php if ( $network ): ?>
	<table border="0">
	<?php	
		foreach($network as $key => $field){
	?>		
		<tr>
			<td><?php echo $key;?></td><td><?php echo $field; ?></td>
				<?php 
				$net_class = substr($field, 0, 2);
					if($key == "network" && $net_class == "10") 
						echo "<td><span class='network_class'>Class A</span></td>"; 
					elseif($key == "network" && $net_class == "17")	
						echo "<td><span class='network_class'>Class B</span></td>"; 
					elseif($key == "network" && $net_class == "19")	
						echo "<td><span class='network_class'>Class C</span></td>"; 
				?>
		</tr>
	<?php
		}
	?>
	</table>
<?php endif; ?>
</div>	