<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<style type="text/css">
		table {
			border: 1px solid #000;
		}

		td, th {
			border: 1px solid #000;
			padding: 5px;
		}

		#update-div {
			display: none;
		}
	</style>
</head>
<body>
	<h1>Your dashboard</h1>

	<a href="<?php echo base_url('welcome/logout'); ?>">Logout</a>

	<br> <br>

	<?php if(empty($product)) { ?>
		<div style="float: left; margin-right: 200px;">
			<form method="POST" action="<?php echo base_url('welcome/create') ?>">
				Product name: <input type="text" name="name"> <br> <br>
				Price: <input type="number" name="price"> <br> <br>
				<input type="submit" name="Create">
				<input type="reset" name="Clear">
			</form>
		</div>
	<?php } else { ?>
		<div style="float: left; margin-right: 200px;">
			<?php foreach($product as $value) {$id = $value->id; $name = $value->name; $price = $value->price;} ?>
			<form method="POST" action="<?php echo base_url('welcome/update') ?>">
				Product name: <input type="text" name="name_update" value="<?php echo $name; ?>"> <br> <br>
				Price: <input type="number" name="price_update" value="<?php echo $price; ?>"> <br> <br>
				<input type="hidden" value="<?php echo $id; ?>" name="hidden_id">
				<input type="submit" name="Update">
				<input type="reset" name="Clear">
			</form>
		</div>
	<?php } ?>

	<table style="float: left;">
		<tr>
			<th>Product Name</th>
			<th>Price</th>
			<th>Action</th>
		</tr>
		<?php
			if(!empty($products)) {
				foreach($products as $value) {
		?>
					<tr>
						<td><?php echo $value->name; ?></td>
						<td><?php echo $value->price; ?></td>
						<td><a href="<?php echo base_url('welcome/edit'); ?>/<?php echo $value->id; ?>">Edit</a> | <a href="<?php echo base_url('welcome/delete'); ?>/<?php echo $value->id; ?>">Delete</a></td>
					</tr>
		<?php
				}
			}
		?>
	</table>
</body>
</html>