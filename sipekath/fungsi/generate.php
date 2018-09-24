<?php
include 'conn.php';

function gen_id() {

    // Create our random string
    $string = "";
    $strings = "2346789ACEFGHIJKLMNOPQRSTUWXY";

    // $split = str_split($strings,62);
    $characters = str_split($strings);
    // $characters = array('a', 'b', 'c', 'd');

    for ($i = 0; $i <= 8; $i++) {

        $string .= $characters[mt_rand(0, 28)];
    }

    $query = "SELECT COUNT(*)
    FROM keranjang
    WHERE id_pembeli = '$string'";

    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);

    if ($row['COUNT(*)'] > 0) { // if it already exists, do it again
        $string = gen_id();
    }

    return $string;
}

function transaksi() {

    // Create our random string
    $string = "";
    $strings = "A1B2C3D4E5F6G7H8I9JKLMNO0PQRSTUVWXYZ";
    // $split = str_split($strings,62);
    $characters = str_split($strings);
    // $characters = array('a', 'b', 'c', 'd');

    for ($i = 0; $i <= 9; $i++) {

        $string .= $characters[mt_rand(0, 35)];
    }

    $query = "SELECT COUNT(*)
    FROM transaksi
    WHERE id_transaksi = '$string'";

    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);

    if ($row['COUNT(*)'] > 0) { // if it already exists, do it again

        $string = transaksi();
    }

    return $string;
}

function id_member() {

	$select = mysql_query("SELECT id_member FROM member WHERE tgl_daftar = '".date('Y-m-d')."' ORDER BY id_member DESC");
	$count = mysql_num_rows($select);
	$array = mysql_fetch_array($select);

	if($count == 0){
		$string = 'member'.date('dmy')."_0001";
	}else if($count >= 1){
		$no_urut_id = (int) substr($array['id_member'], 13,4);
		$string = 'member'.date('dmy').'_'.sprintf("%04s",$no_urut_id+1);
	}

    return $string;
}

function id_stok($id_member) {

    $select = mysql_query("SELECT id_stok FROM stok_voucher WHERE tgl_permintaan = '".date('Y-m-d')."' AND id_member = '$id_member' ORDER BY id_stok DESC");
    $count = mysql_num_rows($select);
    $array = mysql_fetch_array($select);

    if($count == 0){
        $string = 'stok001_'.date('dmy')."_".$id_member;
    }else if($count >= 1){
        $no_urut_id = (int) substr($array['id_stok'], 4,3);
        $string = 'stok'.sprintf("%03s",$no_urut_id+1)."_".date('dmy').'_'.$id_member;
    }

    return $string;
}

function id_iklan(){
    $select = mysql_query("SELECT id_iklan FROM iklan WHERE tgl_masuk = '".date('Y-m-d')."' ORDER BY id_iklan DESC");
    $count = mysql_num_rows($select);
    $array = mysql_fetch_array($select);

    if($count == 0){
        $string = 'iklan0001_'.date('dmy');
    }else{
        $no_urut_id = (int) substr($array['id_iklan'], 5,4);
        $string = 'iklan'.sprintf("%04s",$no_urut_id+1)."_".date('dmy');
    }

    return $string;
}

function kode_susun($field,$table,$field2,$id,$kode_awal,$star,$jumKar){
        $SELECT = mysql_query("SELECT max($field) as maxKd from $table where $field2 = '$id'");
        $data =  mysql_fetch_array($SELECT);
        $maxKd = $data['maxKd'];
        $substr = (int) substr($maxKd, $star,$jumKar);
        $kode = $substr + 1;
        $newkode = "$kode_awal".sprintf("%0".$jumKar."s", $kode);
        return $newkode;
    }

function kode($field,$table,$kode_awal,$star,$jumKar){
        $SELECT = mysql_query("SELECT max($field) as maxKd from $table");
        $data =  mysql_fetch_array($SELECT);
        $maxKd = $data['maxKd'];
        $substr = (int) substr($maxKd, $star,$jumKar);
        $kode = $substr + 1;
        $newkode = "$kode_awal".sprintf("%0".$jumKar."s", $kode);
        return $newkode;
    }

    function kode_akun($field,$table,$kode_awal,$star,$jumKar,$id_member){
        $SELECT = mysql_query("SELECT max($field) as maxKd from $table WHERE id_member = '".$id_member."'");
        $data =  mysql_fetch_array($SELECT);
        $maxKd = $data['maxKd'];
        $substr = (int) substr($maxKd, $star,$jumKar);
        $kode = $substr + 1;
        $newkode = "$kode_awal".sprintf("%0".$jumKar."s", $kode);
        return $newkode;
    }

function no_urut() {

    $select = mysql_query("SELECT no_urut_anggota FROM akun ORDER BY no_urut_anggota DESC");
    $count = mysql_num_rows($select);
    $array = mysql_fetch_array($select);

    if($count == 0){
        $string = 1;
    }else if($count >= 1){
        $no_urut_id = $array['no_urut_anggota'];
        $string = $no_urut_id+1;
    }

    return $string;
}

function no_urut_bh() {

    $select = mysql_query("SELECT urutan FROM urutan_bagi_hasil ORDER BY urutan DESC");
    $count = mysql_num_rows($select);
    $array = mysql_fetch_array($select);

    if($count == 0){
        $string = 1;
    }else if($count >= 1){
        $no_urut_id = $array['urutan'];
        $string = $no_urut_id+1;
    }

    return $string;
}

function username($username){
    $select = mysql_query("SELECT username FROM login WHERE username LIKE '$username%'");
    $count = mysql_num_rows($select);
    $array = mysql_fetch_array($select);

	
    if($count == 0){
        $string = $username;
    }else{
        $pjg_username = strlen($username);
        $no_urut_id = $count + 1;
        $string = $username.$no_urut_id;
    }

    return $string;
}

function set_tanggal($tanggal){
    $pisah = explode("-",$tanggal);

    if($pisah[1]=="01"){
        $bulan = "Januari";
    }else if($pisah[1]=="02"){
        $bulan = "Februari";
    }else if($pisah[1]=="03"){
        $bulan = "Maret";
    }else if($pisah[1]=="04"){
        $bulan = "April";
    }else if($pisah[1]=="05"){
        $bulan = "Mei";
    }else if($pisah[1]=="06"){
        $bulan = "Juni";
    }else if($pisah[1]=="07"){
        $bulan = "Juli";
    }else if($pisah[1]=="08"){
        $bulan = "Agustus";
    }else if($pisah[1]=="09"){
        $bulan = "September";
    }else if($pisah[1]=="10"){
        $bulan = "Oktober";
    }else if($pisah[1]=="11"){
        $bulan = "November";
    }else if($pisah[1]=="12"){
        $bulan = "Desember";
    }

    $tgl = $pisah[2]." ".$bulan." ".$pisah[0];
    return $tgl;
}

function nm_bulan($bulan){
    if($bulan=="01"){
        $tgl = "Januari";
    }else if($bulan=="02"){
        $tgl = "Februari";
    }else if($bulan=="03"){
        $tgl = "Maret";
    }else if($bulan=="04"){
        $tgl = "April";
    }else if($bulan=="05"){
        $tgl = "Mei";
    }else if($bulan=="06"){
        $tgl = "Juni";
    }else if($bulan=="07"){
        $tgl = "Juli";
    }else if($bulan=="08"){
        $tgl = "Agustus";
    }else if($bulan=="09"){
        $tgl = "September";
    }else if($bulan=="10"){
        $tgl = "Oktober";
    }else if($bulan=="11"){
        $tgl = "November";
    }else if($bulan=="12"){
        $tgl = "Desember";
    }
return $tgl;
}

function set_cek_kat($tanggal){
    $pisah = explode("-",$tanggal);

    $tgl = $pisah[1];
    return $tgl;
}

function namahari($tanggal){
    $tgl=substr($tanggal,8,2);
    $bln=substr($tanggal,5,2);
    $thn=substr($tanggal,0,4);

    $info=date('w', mktime(0,0,0,$bln,$tgl,$thn));

    switch($info){
        case '0': return "Minggu"; break;
        case '1': return "Senin"; break;
        case '2': return "Selasa"; break;
        case '3': return "Rabu"; break;
        case '4': return "Kamis"; break;
        case '5': return "Jumat"; break;
        case '6': return "Sabtu"; break;
    };
}

function selengkapnya($isi,$jum_char){
    error_reporting(0);
    $num_char = $jum_char;
    $text = $isi;

    $char = $text{$num_char - 1};
    while($char != ' ') {
        $char = $text{--$num_char};
    }

    $potong = substr($text, 0, $num_char) . " ...";
    return $potong;
}

?>