<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Subnet Calculator</title>
	<style type="text/css">
	.ip_calculator{
		width:400px;
		margin:20px auto;
	}
	.network_class{
		color:red;
	}
	.net_input{
		width:158px;
		height:18px;
		padding:0 3px;
		margin: 3px 0;
		border: 1px solid #ccc;
		-moz-border-radius: 3px;
		-webkit-border-radius: 3px;
		border-radius: 3px;
	}
	</style>
</head>
<body>
<? 

/*************** Subnet Calculator ****************/

/**
 * Convert hexadecimal number to ip address
 *
 * @param hexadecimal $val a value taken from ip_to_hex()
 * @param integer $len a value taken from ip_to_hex()
 * @param reverse $reverse false by default
 * @return hexadecimal.
 */ 
function fill_zeros($val, $len, $reverse = false){
	while(strlen($val) < $len)
		if($reverse)
			$val .= "0"; 
		else
			$val = "0".$val;
	return $val;
}

/**
 * Convert hexadecimal number to ip address
 *
 * @param hexadecimal $hex a value taken from ip_to_hex()
 * @return ip address.
 */  
function hex_to_ip($hex){
	for($i=0; $i<4; $i++)
		@$ip .= base_convert(substr($hex,$i*2,2),16,10).".";
	$ip = substr($ip,0,-1);
	return $ip;
}

/**
 * Convert integer number to hexadecimal values
 *
 * @param integer $ip a value taken from $_GET associative array
 * @return hexadecimal number.
 */ 
function ip_to_hex($ip){
	$iparr = explode(".",$ip);
	foreach($iparr as $i => $group){
		@$hex .= fill_zeros(base_convert($group,10,16),2);
	}
	return $hex;
}
 
/**
 * Convert hexadecimal number to binary values
 *
 * @param hexadecimal $hex a value taken from ip_to_hex() function
 * @return binary number.
 */ 
function hex_to_bin($hex){
	$bin = fill_zeros(base_convert($hex,16,2),32);
	return $bin;
}
 
/**
 * Convert binary number to hexadecimal 
 *
 * @param binary $bin a value taken from hex_to_bin() function
 * @return hexadecimal number.
 */  
function bin_to_hex($bin) {
	$hex = fill_zeros(base_convert($bin,2,16),8);
	return $hex;
}
  
/**
 * Collects values from functions and puts them into $network array
 *
 * @param integer $ip ip address
 * @param integer $netmask subnet mask
 * @return $network array.
 */ 
function get_network($ip, $netmask){
	$iphex = ip_to_hex($ip);
	$netbin = hex_to_bin($iphex);
	$maskhex = ip_to_hex($netmask);
	$maskbin = hex_to_bin($maskhex);
	
	$hostbits = substr($maskbin,strpos($maskbin,"0"));
	$netbits = substr($maskbin,0,strpos($maskbin,"0"));
	$nethex = bin_to_hex(fill_zeros(substr($netbin,0,strlen($netbits)),32,true));	
	$hosts = pow(2,strlen($hostbits));
	$available_hosts = $hosts-3;  // number of available hosts
	
	$network["ip address"] = $ip;  
	$network["mask value"] = $netmask;
	$network["network"] = hex_to_ip($nethex);
	$network["net mask"] = $network["network"]."/".strlen($netbits);
	$network["hosts number"] = $available_hosts;
	$network["first ip address"] = hex_to_ip(fill_zeros(base_convert(base_convert($nethex,16,10)+1,10,16),8));
	$network["last ip address"] = hex_to_ip(fill_zeros(base_convert(base_convert($nethex,16,10)+$available_hosts+1,10,16),8));
	$network["broadcast address"] = hex_to_ip(fill_zeros(base_convert(base_convert($nethex,16,10)+$available_hosts+2,10,16),8));
	return $network;
}
 
?>
<div class="ip_calculator"> 
<form method="get">
<input type="text" class="net_input" maxlength="15" name="ip" value="<?=@$_GET["ip"]?>" /> IP or network address <br/>
<input type="text" class="net_input" maxlength="15" name="mask" value="<?=@$_GET["mask"]?>" /> Subnet mask value <br/>
<input type="submit" value="Show network information" />
</form>
 
<?
if(!empty($_GET["ip"]) && !empty($_GET["mask"])){
	$network = get_network($_GET["ip"],$_GET["mask"]);
?>
<br/>
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
<?php
}

/*************** End of Subnet Calculator ****************/
?>
</div>	
</body>
</html>

                  