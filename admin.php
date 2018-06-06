<?php
session_start();
if( empty( $_SESSION['id_user'] ) ){
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>::Data Mahasiswa::</title>

  </head>
  <body>
    <?php include "menu.php"; ?>
    <div class="container">
	<?php
	if( isset($_REQUEST['hlm'] )){
		$hlm = $_REQUEST['hlm'];
		switch( $hlm ){
			case 'user':
				include "user.php";
				break;
			case 'jurusan':
				include "jurusan.php";
				break;
			case 'mahasiswa':
				include "mahasiswa.php";
				break;
			case 'matakuliah':
				include "matakuliah.php";
				break;
		}
	} else {
	?>
    
      <div class="jumbotron">
        <h2>Selamat Datang di Aplikasi Data Mahasiswa USM</h2>

        <p>Halo <strong><?php echo $_SESSION['nama']; ?></strong>, Anda login sebagai
			<strong>
			<?php
				if($_SESSION['level'] == 1){
					echo 'Admin.';
				} else {
						echo 'User.';
				}
			?>
			</strong>
		</p>
      </div>
	<?php
	}
	?>
    </div>
  </body>

</html>
<?php
}
?>
