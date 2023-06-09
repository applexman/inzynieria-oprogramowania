<?php

session_start();

if ((!isset($_POST['email'])) || (!isset($_POST['password']))) {
	header('Location: login_page.php');
	exit();
}

require_once "database_connect.php";

if ($connection->connect_errno != 0) {
	echo "Error: " . $connection->connect_errno;
} else {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$email = htmlentities($email, ENT_QUOTES, "UTF-8");

	if ($results = @$connection->query(
		sprintf(
			"SELECT * FROM users WHERE email='%s'",
			mysqli_real_escape_string($connection, $email)
		)
	)) {
		$found_users = $results->num_rows;
		if ($found_users > 0) {
			$user_data = $results->fetch_assoc();

			if (password_verify($password, $user_data['password'])) {
				$_SESSION['logged_flag'] = true;
				$_SESSION['id'] = $user_data['id'];
				$_SESSION['email'] = $user_data['email'];
				$_SESSION['permissions'] = $user_data['permissions'];
				$_SESSION['alert_type'] = 'success';

				unset($_SESSION['alert_msg']);
				$results->free_result();
				header('Location: login_page.php');
			} else {
				$_SESSION['alert_msg'] = 'Nieprawidłowy email lub hasło!';
				$_SESSION['alert_type'] = 'danger';
				header('Location: login_page.php');
			}
		} else {

			$_SESSION['alert_msg'] = 'Nieprawidłowy email lub hasło!';
			$_SESSION['alert_type'] = 'danger';
			header('Location: login_page.php');
		}
	}

	$connection->close();
}
