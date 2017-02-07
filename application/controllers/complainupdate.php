<?php

$url = 'http://172.16.168.10/complain/csrlistener/listener';

$message = array(
	'no_tiket'  => 'TKT150122019',
	'status_complain'	=> 'on process',
	'keterangan' => 'Sedang dikerjakan bagian Terkait.'
	);

$ch = curl_init();   // inisialisasi CURL
// setting CURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

curl_setopt($ch, CURLOPT_POSTFIELDS, 
                 http_build_query(array('message' => json_encode($message))));

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// menjalankan CURL untuk membaca isi file
$hasil = curl_exec($ch);

if($hasil === false){
	echo curl_error($ch);
} else {
	print_r($hasil);
}
curl_close($ch);
