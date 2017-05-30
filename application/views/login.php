<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
</head>
<body>

<div id="container">
	<h1>Welcome!</h1>

	<?php
		if(!empty($this->session->userdata('error'))) {
			echo $this->session->userdata('error');
			$this->session->unset_userdata('error');
		}
	?>

	<form action="<?php echo base_url('welcome/login'); ?>" method="POST">
		Username: <input type="text" name="username"> <br> <br>
		Password: <input type="password" name="password"> <br> <br>
		<input type="submit" value="Login">
		<input type="reset" value="Clear">
	</form>
</div>

</body>
</html>