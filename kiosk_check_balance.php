<?php
/*
UserSpice 4
An Open Source PHP User Management System
by the UserSpice Team at http://UserSpice.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}
?>

<?php
if(!empty($_GET['search'])){
	$searchTerm = Input::get('search');
	$query = $db->query("SELECT balance FROM students WHERE rfid = ?",[$searchTerm]);
	$count = $query->count();
	$results = $query->first();
	if($count > 0){
		Redirect::to("kiosk_check_balance.php?err=Your+balance+is+$".$results->balance);
	}else{
		Redirect::to("kiosk_check_balance.php?err=Not+found");
	}
}
?>
<div class="row">
	<div class="col-sm-3">

	</div>
	<div class="col-sm-6">
		<br>
		<form class="" action="" method="get">
			<p align="center">
			<input type="password" name="search" value="" required autofocus="on" placeholder="Scan Your Tag!">
			<input type="submit" name="submit" value="Go!">
			</p>
		</form>
	</div>
</div>
<?php
$message = Input::get("err");
if($message != ""){ ?>
	<script type="text/javascript">
		setTimeout("location.href = 'kiosk_check_balance.php';",5000);
	</script>
<?php }  ?>

<?php require_once $abs_us_root . $us_url_root . 'users/includes/html_footer.php'; ?>
