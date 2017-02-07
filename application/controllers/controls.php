<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Controls {
	static $_timestamp;
	static $_key = '/yGNlc3soKmvPq5XVElCg33BCX9tdsbM=T3TA9Q0oe0g98H6h5dADiFiKRf0OsglQlIsZAXpjZ9uCS4VskZ76GTS2amS7EIZ+sVv@';
	static $_tanggal = array('01' => 'January', '02' => 'February', '03' => 'Maret', '04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December', '00'=>'Belum Terisi');
	static $Convert_tanggal = array('January' => '1', 'February' => '2', 'Maret' => '3', 'April' => '4', 'May' => '5', 'June' => '6','July' => '7', 'August' => '8', 'September' => '9', 'October' => '10', 'November' => '11', 'December' => '12', 'Belum Terisi' =>'00');
	static $_tanggal2 = array('01' => 'January', '02' => 'February', '03' => 'Maret', '04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December', '00'=>'Belum Terisi');
	static $Convert_tanggal2 = array('January' => '01', 'February' => '02', 'Maret' => '03', 'April' => '04', 'May' => '05', 'June' => '06','July' => '07', 'August' => '08', 'September' => '09', 'October' => '10', 'November' => '11', 'December' => '12', 'Belum Terisi' =>'00');
	static $_tanggal3 = array('1' => 'January', '2' => 'February', '3' => 'Maret', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December', '00'=>'Belum Terisi');
	static function alphabet($string)
	{
		return preg_replace("/[^A-Za-z\s]/", "", $string);
	}
	static function numerics($string)
	{
		return preg_replace("/[^0-9]/", "", $string);
	}
	static function alphanumeric($string)
	{
		return preg_replace("/[^0-9A-Za-z\s\_\.]/", "", $string);
	}
	static function removespace($string)
	{
		return trim(preg_replace("/\s+/", " ", $string));
	}
	static function gettimestamp()
	{
		self::$_timestamp = date("Y-m-d H:i:s",time());
		return self::$_timestamp;
	}
	static function removewhitespace($string)
	{
		return trim(preg_replace("/\s+/"," ",$string));
	}
	static function validemail($string)
	{
		return filter_var($string, FILTER_VALIDATE_EMAIL) == TRUE ? TRUE : FALSE;
	}
	static function validdate($string)
	{
		return (bool)preg_match('/\d{4}(-)\d{1,2}(-)\d{1,2}/',$string);
	}
	static function remove_special_chars($string)
	{
		return preg_replace('/[\#\<\>\"\'\%\;\(\)\&\:\(+=)\+]/', '', $string);
	}
	static function htmlencode($string)
	{
		return htmlentities($string);
	}
	static function htmldecode($string)
	{
		return html_entity_decode($string);
	}
	static function rupiah($nominal) {
		$prepare = strstr($nominal, '.') != '' ? str_replace('.',',',strstr($nominal, '.')) : ',00';
		return 'Rp.' . strrev(implode('.',str_split(strrev(strval((int)$nominal)),3))) . $prepare;
	}
	static function str_date($string){
		return preg_replace('/^(\d{4})(\d{2})(\d{2})$/i', '$1-$2-$3', $string);
	}
	static function format_date($string,$format='datetime'){
		$datesplit = $string !== NULL ? explode('-', substr($string,0,10)) : '-';
		$convert = $datesplit == '-' ? '-' : $datesplit[2] . " " . self::$_tanggal[$datesplit[1]] . " " . $datesplit[0];
		
		$convert2 = $datesplit == '-' ? '-' : $datesplit[2] . " " . self::$_tanggal[$datesplit[1]] . " " . $datesplit[0] . substr($string, 10, 6);
		echo $convert2;
		echo $convert;
		return $format == 'datetime' ? $convert2 : $convert;
	}
		static function format_date2($string,$format='datetime'){
		$datesplit = $string !== NULL ? explode('-', substr($string,0,10)) : '-';
		$LengString=strlen($string)-10;
		$convert = $datesplit == '-' ? '-' : $datesplit[2] . " " . self::$_tanggal2[$datesplit[1]] . " " . $datesplit[0];
		$convert2 = $datesplit == '-' ? '-' : $datesplit[2] . " " . self::$_tanggal2[$datesplit[1]] . " " . $datesplit[0] . substr($string, 10, $LengString);
		return $format == 'datetime' ? $convert2 : $convert;
	}
	static function ConvertBulanToAngka($string){
		$LengString = strlen($string);
		$arrayDate = explode(" ", $string);
		$converToAngka = $arrayDate[2]."-".self::$Convert_tanggal[$arrayDate[1]]."-".$arrayDate[0];
		return $converToAngka;
	}
	static function ConvertBulanToAngkaKe2($string){
		$LengString = strlen($string);
		$arrayDate = explode(' ', substr($string, 0, $LengString));
		$converToAngka = $arrayDate[2]."-".self::$Convert_tanggal2[$arrayDate[1]]."-".$arrayDate[0]." ".$arrayDate[3];
		return $converToAngka;
	}
	static function format_date3($string,$format='datetime'){
		$datesplit = $string !== NULL ? explode('-', substr($string,0,10)) : '-';
		$convert = $datesplit == '-' ? '-' : $datesplit[2] . " " . self::$_tanggal3[$datesplit[1]] . " " . $datesplit[0];
		
		$convert2 = $datesplit == '-' ? '-' : $datesplit[2] . " " . self::$_tanggal3[$datesplit[1]] . " " . $datesplit[0] . substr($string, 10, 6);
		return $format == 'datetime' ? $convert2 : $convert;
	}
}
