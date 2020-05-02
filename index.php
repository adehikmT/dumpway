<?php 
include 'fungsi.php';
 $sql_all="select music.id,music.title,music.durasi,music.photo,music.deskripsi,singer.nama as 'penyanyi',genre.nama as 'genre' from music inner join genre on music.id_genre=genre.id_genre inner join singer on music.id_singer=singer.id_singer";
 $show_all=tampil($sql_all);
 $show_g="select * from genre";
 $show_s="select * from singer";
 
 $gn=tampil($show_g);
 $sn=tampil($show_s);

//singer area
 //insert area
if (isset($_POST['sing'])) {
	$p=$_POST['singer'];
	 if(empty($p)){
	 	echo "<script>
	 	alert('data tidak boleh kosong');
	 	document.location.href='';
	 	</script>";
	 }else{
      	$sql="insert into singer values('','$p')";
      	$rss=iud($sql);
       	if($rss>0){
       	echo "<script>
	 	alert('data Berhasil di simpan');
	 	document.location.href='';
	 	</script>";
       	}else{
       	echo "<script>
	 	alert('data gagal di simpan');
	 	document.location.href='';
	 	</script>";
       	}	 	
	 }
}

//genre area
 //insert area
if (isset($_POST['gen'])) {
	 $p=$_POST['genre'];
	 if(empty($p)){
	 	echo "<script>
	 	alert('data tidak boleh kosong');
	 	document.location.href='';
	 	</script>";
	 }else{
      	$sql="insert into genre values('','$p')";
      	$rss=iud($sql);
       	if($rss>0){
       	echo "<script>
	 	alert('data Berhasil di simpan');
	 	document.location.href='';
	 	</script>";
       	}else{
       	echo "<script>
	 	alert('data gagal di simpan');
	 	document.location.href='';
	 	</script>";
       	}	 	
	 }
}

//music area
 //insert
if (isset($_POST['mus'])) {
	 	 $t=$_POST['title'];
	 	 $d=$_POST['durasi'];
	 	 $g=$_POST['genre'];
	 	 $s=$_POST['singer'];
	 	 $ds=$_POST['deskripsi'];
	 	 $img=unggah();
	 	 $au=audio();
	 if($img){
      	$sql="insert into music values('','$t','$d','$g','$s','$img','$ds')";
      	$rss=iud($sql);
       	if($rss>0){
       	echo "<script>
	 	alert('data Berhasil di simpan');
	 	document.location.href='';
	 	</script>";
       	}else{
       	echo "<script>
	 	alert('data gagal di simpan');
	 	document.location.href='';
	 	</script>";
       	}	 	
	 }
}
//delete
if(isset($_GET['id'])){
	$id=$_GET['id'];
	if(empty($id)){
		"<script>
	 	alert('Data tidak di temukan');
	 	document.location.href='';
	 	</script>";
	}else{
		$sql="delete from music where id='$id'";
		$tmp=tampil("select photo from music where id='$id'");
		$gm=$tmp[0]['photo'];
		unlink($gm);
      	$rss=iud($sql);
       	if($rss>0){
       	echo "<script>
	 	alert('data Berhasil di hapus');
	 	document.location.href='index.php';
	 	</script>";
       	}else{
       	echo "<script>
	 	alert('data gagal di hapus');
	 	document.location.href='';
	 	</script>";
       	}	 	
	}
}

if (isset($_POST['src'])) {
	$id=$_POST['genre'];
	 $sql_all="select music.id,music.title,music.durasi,music.photo,music.deskripsi,singer.nama as 'penyanyi',genre.nama as 'genre',genre.id_genre from music inner join genre on music.id_genre=genre.id_genre inner join singer on music.id_singer=singer.id_singer where genre.id_genre='$id'";
    $show_all=tampil($sql_all);
    $s_genre="select * from genre where id_genre='$id'";
    $rss=tampil($s_genre);
    $select=$rss[0]['nama'];
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>My Music</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<!-- section -->
<section class="mt-2">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
			<h1>My Music</h1>	
			</div>
			<div class="col-lg-4 mt-3">
				 <a href=""  data-toggle="modal" data-target="#add" class="btn btn-primary btn-sm">Add singer</a>
			
				 <a href=""  data-toggle="modal" data-target="#addg" class="btn btn-primary btn-sm">Add Genre</a>
			
				 <a href=""  data-toggle="modal" data-target="#addm" class="btn btn-primary btn-sm">Add Music</a>
			</div>
		</div>
	</div>
</section>
	<!-- akhir section -->
	<hr>
	<!-- section -->
<section>
	<div class="container mt-3">
<form method="post" action="">
		<div class="row mb-3">
			<div class="col-lg-4">
				 Select Gendre: 
				 <select name="genre" class="form-control mt-3" required>
	                <option value="">-Pilih-</option>
	            	<?php foreach($gn as $gg):?>
	            		<option value="<?=$gg['id_genre'];?>"><?=$gg['nama'];?></option>
	            	<?php endforeach?>
	             </select>
			</div>
			<div class="col-lg-3 mt-4">
				<button type="submit" class="btn btn-primary mt-3" name="src">Cari</button>
			</div>		
		</div>
</form>
    <?php if(isset($select)):?><small class="mb-2">Select Genre : <?=$select?></small><?php endif?>
		<div class="row">
			<?php foreach ($show_all as $all): ?>
			<div class="col-lg-3">
				<div class="card shadow text-center p-2">
					<div class="row">
						<div class="col-lg-12"><img src="<?=$all['photo']?>" class="img-fluid"></div>
					</div>
					<h5 class="mt-1"><?=$all['title']?></h5>
					<small><?=$all['penyanyi']?></small>
					<audio controls class="audio-control mt-2" style="max-width: 235px">
					<source src="audio.ogg" type="audio/ogg">
					<source src="audio.mp3">	
					</audio>
				</div>
				 <a href=""  data-toggle="modal" data-target="#dat<?=$all['id']?>" class="btn btn-primary ml-1 btn-block mt-3 mb-3">Detail</a>
			</div>
			<?php endforeach;?>
		</div>
	</div>
</section>
	<!-- akhir scrtion -->


<!-- Modal Detail-->
<?php foreach ($show_all as $one): ?>
<div class="modal fade bg-dark" id="dat<?=$one['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Music</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="row justify-content-center mt-3 form-group"> 
          	<div class="col-lg-10">
	            <div class="row">
				<div class="col-lg-12"><img src="default.png" class="img-fluid"></div>
				</div>
				<h5 class="mt-1"><?=$one['title']?></h5>
				<small>penyanyi : <?=$one['penyanyi']?></small><br>
				<small>durasi : <?=$one['durasi']?></small><br>
				<small>durasi : <?=$one['genre']?></small>
				<p>
					<?=$one['deskripsi']?>
				</p>
			</div>	
      	  </div>  
      <div class="modal-footer mt-2">
        <a href="?id=<?=$one['id']?>" onclick="return confirm('apakah anda ingin menghapus?');" class="btn btn-warning" >Hapus</a>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>
<!-- akhir modal -->

<!-- Modal Singer-->
<div class="modal fade bg-dark" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="post" action="">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Singer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="row justify-content-center mt-3 form-group"> 
          	<div class="col-lg-10">
	            <input type="text" name="singer" placeholder="Masukan Nama Penyanyi" class="form-control" required>
			</div>	
      	  </div>  
      <div class="modal-footer mt-2">
        <button type="submit" name="sing" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
  </form>
</div>
<!-- akhir modal -->

<!-- Modal Genre-->
<div class="modal fade bg-dark" id="addg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="post" action="">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Genre</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="row justify-content-center mt-3 form-group"> 
          	<div class="col-lg-10">
	            <input type="text" name="genre" placeholder="Masukan Nama Genre" class="form-control" required>
			</div>	
      	  </div>  
      <div class="modal-footer mt-2">
        <button type="submit" name="gen" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
  </form>
</div>
<!-- akhir modal -->

<!-- Modal Music-->
<div class="modal fade bg-dark" id="addm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="post" action="" enctype="multipart/form-data">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Music</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="row justify-content-center mt-3 form-group"> 
          	<div class="col-lg-10">
	            <input type="text" name="title" placeholder="Masukan title" class="form-control" required>
	            <input type="text" name="durasi" placeholder="Masukan durasi" class="form-control mt-3" required>
	            <input type="file" name="img" placeholder="Masukan Nama Genre" class="form-control mt-3" required>
	            <label>Masukan Photo</label>
	            <select name="genre" class="form-control mt-3" required>
	            	<option value="">-Pilih-</option>
	            	<?php foreach($gn as $g):?>
	            		<option value="<?=$g['id_genre'];?>"><?=$g['nama'];?></option>
	            	<?php endforeach?>
	            </select>
				<select name="singer" class="form-control mt-3" required>
	            	<option value="">-Pilih-</option>
	            	<?php foreach($sn as $n):?>
	            		<option value="<?=$n['id_singer'];?>"><?=$n['nama'];?></option>
	            	<?php endforeach?>
	            </select>
				<textarea name="deskripsi" placeholder="Masukan deskripsi" class="form-control mt-3" required></textarea>
			</div>	
      	  </div>  
      <div class="modal-footer mt-2">
        <button type="submit" name="mus" class="btn btn-primary" >Simpan</button>
      </div>
    </div>
  </div>
  </form>
</div>
<!-- akhir modal -->


</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>