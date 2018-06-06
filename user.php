<?php
if( empty( $_SESSION['id_user'] ) ){
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} 
else {
	if(isset( $_REQUEST['aksi'])){
		$aksi = $_REQUEST['aksi'];
		switch($aksi){
			case 'add':
				include 'userAdd.php';
				break;
			case 'edit':
				include 'userEdit.php';
				break;
			case 'delete':
				include 'userDelete.php';
				break;
		}
	} 
	else {
		echo '
			<div class="container">
				<h3">Daftar User</h3><br/>
					<a href="./admin.php?hlm=user&aksi=add" class="btn btn-success btn-s pull-right">Tambah User</a>
				<br/><hr/>

				<table class="table table-bordered">
				 <thead>
				   <tr class="info">
					 <th>No</th>
					 <th>Username</th>
					 <th>Nama</th>
					 <th>Level</th>
					 <th>Aksi</th>
				   </tr>
				 </thead>
				 <tbody>';

		 	$sql = mysqli_query($koneksi, "SELECT * FROM user");
		 	if(mysqli_num_rows($sql) > 0){
		 		$no = 0;

				 while($row = mysqli_fetch_array($sql)){
	 				$no++;
	 			echo '

				   <tr>
					 <td>'.$no.'</td>
					 <td>'.$row['username'].'</td>
					 <td>'.$row['nama'].'</td>
					 <td>';

					 if($row['level'] == 1){
						 echo 'Admin';
					 } else {
						 echo 'User';
					 }

					 echo'</td>
					 <td>

					<script type="text/javascript" language="JavaScript">
					  	function konfirmasi(){
						  	tanya = confirm("Anda yakin akan menghapus user ini?");
						  	if (tanya == true) return true;
						  	else return false;
						}
					</script>

					 <a href="?hlm=user&aksi=edit&id_user='.$row['id_user'].'" class="btn btn-warning btn-s">Edit</a>
					 <a href="?hlm=user&aksi=delete&submit=yes&id_user='.$row['id_user'].'" onclick="return konfirmasi()" class="btn btn-danger btn-s">Hapus</a>
					 </td>';
				}
			} else {
				 echo '<td colspan="8"><center><p class="add">Tidak ada data untuk ditampilkan. <u><a href="?hlm=user&aksi=add">Tambah user baru</a></u> </p></center></td></tr>';
			}
			echo '
			 	</tbody>
			</table>
			</div>
		</div>';
	}
}
?>
