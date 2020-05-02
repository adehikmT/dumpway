<?php

$host="localhost";
$user="root";
$pass="";
$db="music";

$con=mysqli_connect($host,$user,$pass,$db);

// fungsi untuk insetr update dan delete
function iud($key)
{
global $con;
$qury=mysqli_query($con,$key);
$rss=mysqli_affected_rows($con);
return $rss;
}
// fungsi untuk tampil data
function tampil($key)
{
  global $con;
  $row=[];
  $query=mysqli_query($con,$key);
   while($rows=mysqli_fetch_assoc($query))
   {
     $row[]=$rows;
   }
 return $row;
}


function uplodau($dir='',$ky='audio'){
  $n=$_FILES[$ky]['name'];
  $t=$_FILES[$ky]['type'];
  $tp=$_FILES[$ky]['tmp_name'];
  $er=$_FILES[$ky]['error'];
  $sz=$_FILES[$ky]['size'];

 //  cek gambar 
 if($er===4){
   return null;
 }
 // yang boleh di upload haya gambar
 $au=['mp3','mp4'];
 $ex=explode('.',$n);
 $ex=strtolower(end($ex));

 if(!in_array($ex,$au)){
   echo "<script>alert('Yang Anda Upload bukan Audio');</script>";
   return false;
 }

 //ukuran

 if($sz>=5000000){
   echo "<script>alert('Ukuran Audio Terlalu Besar');</script>";
   return false;
 }

 // lolos
 // ganer3ete nama file
 move_uploaded_file($tp,$dir.$n);
return $n;
}

function unggah($dir='',$ky='img'){
  $nama=$_FILES[$ky]['name'];
  $type=$_FILES[$ky]['type'];
  $tmp=$_FILES[$ky]['tmp_name'];
  $e=$_FILES[$ky]['error'];
  $size=$_FILES[$ky]['size'];

 //  cek gambar 
 if($e===4){
   return null;
 }
 // yang boleh di upload haya gambar
 $gambarv=['jpg','jpeg','png','img'];
 $extensi=explode('.',$nama);
 $extensi=strtolower(end($extensi));

 if(!in_array($extensi,$gambarv)){
   echo "<script>alert('Yang Anda Upload bukan Gambar');</script>";
   return false;
 }

 //ukuran

 if($size>=5000000){
   echo "<script>alert('Ukuran Gambar Terlalu Besar');</script>";
   return false;
 }

 // lolos
 // ganer3ete nama file
 $namabaru=uniqid();
 $namabaru .=".";
 $namabaru .=$extensi;
 move_uploaded_file($tmp,$dir.$namabaru);
return $namabaru;
}