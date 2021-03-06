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
die("This does not log the initial funds");
?>

<?php
if(!empty($_POST)){
$rfid = Input::get('rfid');
$check = $db->query("SELECT * FROM students WHERE rfid = ?",[$rfid])->count();
		if($check < 1){
		processForm();
		$fname = Input::get('fname');
		$lname = Input::get('lname');
		$balance = Input::get('balance');
		$fields = array(
			"student"						=>$id,
			"done_by"						=>$user->data()->id,
			"amount"						=>$balance,
			"date_created"			=>date("Y-m-d H:i:s"),
			"transaction_type"	=>3,
		);
		$db->insert("transactions",	$fields);
		logger($user->data()->id, "Money", "Added new user $fname $lname with a balance of $balance.");
		Redirect::to('new_student.php');
	}else{
		err("STUDENT NOT ADDED - This RFID code is already in use");
	}
}
?>
		<div class="row">
			<div class="col-sm-12">
				<h2>New Student</h2>
				<?php
				displayForm('students');
				 ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h2>Existing Students</h2>
				<?php
				displayTable('students');
				 ?>
			</div>
		</div>

<?php require_once $abs_us_root . $us_url_root . 'users/includes/html_footer.php'; ?>
