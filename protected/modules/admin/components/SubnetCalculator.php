<?php
class SubnetCalculator 
{
	public static function fill_zeros($val, $len, $reverse = false)
	{
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
	public static function hex_to_ip($hex)
	{
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
	public static function ip_to_hex($ip)
	{
		$iparr = explode(".",$ip);
		foreach($iparr as $i => $group){
			@$hex .= self::fill_zeros(base_convert($group,10,16),2);
		}
		return $hex;
	}
	 
	/**
	 * Convert hexadecimal number to binary values
	 *
	 * @param hexadecimal $hex a value taken from ip_to_hex() function
	 * @return binary number.
	 */ 
	public static function hex_to_bin($hex)
	{
		$bin = self::fill_zeros(base_convert($hex,16,2),32);
		return $bin;
	}
	 
	/**
	 * Convert binary number to hexadecimal 
	 *
	 * @param binary $bin a value taken from hex_to_bin() function
	 * @return hexadecimal number.
	 */  
	public static function bin_to_hex($bin) 
	{
		$hex = self::fill_zeros(base_convert($bin,2,16),8);
		return $hex;
	}
	  
	/**
	 * Collects values from functions and puts them into $network array
	 *
	 * @param integer $ip ip address
	 * @param integer $netmask subnet mask
	 * @return $network array.
	 */ 
	public static function get_network($ip, $netmask)
	{

		$iphex = self::ip_to_hex($ip);
		$netbin = self::hex_to_bin($iphex);
		$maskhex = self::ip_to_hex($netmask);
		$maskbin = self::hex_to_bin($maskhex);
		
		$hostbits = substr($maskbin,strpos($maskbin,"0"));
		$netbits = substr($maskbin,0,strpos($maskbin,"0"));
		$nethex = self::bin_to_hex(self::fill_zeros(substr($netbin,0,strlen($netbits)),32,true));	
		$hosts = pow(2,strlen($hostbits));
		$available_hosts = $hosts-3;  // number of available hosts
		
		$network["ip address"] = $ip;  
		$network["mask value"] = $netmask;
		$network["network"] = self::hex_to_ip($nethex);
		$network["net mask"] = $network["network"]."/".strlen($netbits);
		$network["hosts number"] = $available_hosts;
		$network["first ip address"] = self::hex_to_ip(self::fill_zeros(base_convert(base_convert($nethex,16,10)+1,10,16),8));
		$network["last ip address"] = self::hex_to_ip(self::fill_zeros(base_convert(base_convert($nethex,16,10)+$available_hosts+1,10,16),8));
		$network["broadcast address"] = self::hex_to_ip(self::fill_zeros(base_convert(base_convert($nethex,16,10)+$available_hosts+2,10,16),8));
		return $network;
	}

	public static function getHostsCountBySubnetMask($subnet_mask)
	{
		$subnet_byte_mask  = '255';
		$subnet_mask -= 8;
		if ($subnet_mask >= 8)
			$subnet_byte_mask  .= '.255';
		else 
			$subnet_byte_mask .= self::getByteValue($subnet_mask);
		$subnet_mask -= 8;

		if ($subnet_mask >= 8)
			$subnet_byte_mask .= '.255';
		else 
			$subnet_byte_mask .= self::getByteValue($subnet_mask);
		$subnet_mask -= 8;
		if ($subnet_mask >= 8)
			$subnet_byte_mask .= '.255';
		else 
			$subnet_byte_mask .= self::getByteValue($subnet_mask);

		$network = self::get_network('192.168.0.1', $subnet_byte_mask);
		return $network['hosts number'] + 3;
	}
        
	public static function getByteMaskBySubnetMask($subnet_mask)
	{
		$subnet_byte_mask  = '255';
		$subnet_mask -= 8;
		if ($subnet_mask >= 8)
			$subnet_byte_mask  .= '.255';
		else 
			$subnet_byte_mask .= self::getByteValue($subnet_mask);
		$subnet_mask -= 8;

		if ($subnet_mask >= 8)
			$subnet_byte_mask .= '.255';
		else 
			$subnet_byte_mask .= self::getByteValue($subnet_mask);
		$subnet_mask -= 8;
		if ($subnet_mask >= 8)
			$subnet_byte_mask .= '.255';
		else 
			$subnet_byte_mask .= self::getByteValue($subnet_mask);

		return $subnet_byte_mask;
	}
	
	public static function getByteValue($remainder)
	{
		$subnet_byte_mask = 0; 
		for ($i = 8 - $remainder; $i < 8; $i++) {
			$subnet_byte_mask += pow(2, $i); 
		}
		$subnet_byte_mask = '.' . $subnet_byte_mask;
		return $subnet_byte_mask;
	}

    public static function getMaxSubnet($ip)
    {
        $maxSubnet = 30;

        for ( $i = $maxSubnet; $i > 8; $i-- ) {
            $byteMaskSubnet = self::getByteMaskBySubnetMask($i);
            $network = self::get_network($ip, $byteMaskSubnet );
            if ( $ip != $network['network'] )
                break;
            else
                $maxSubnet = $i;
        }
        return $maxSubnet;
    }

}