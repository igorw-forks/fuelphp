<!doctype html>

<html>

<head>
	<title>Welcome to FuelPHP <?php echo $version; ?></title>
</head>

<body>

<h1><?php echo isset($presenter) ? 'Presenter demonstration' : 'View demonstration'; ?></h1>

<p>
	<strong>Method: </strong> <?php echo $input->method(); ?><br />
	<strong>URI: </strong> <?php echo $input->uri(); ?><br />
	<strong>Query string: </strong> <?php echo json_encode($input->query_string()); ?><br />
</p>

<p>
	<strong>Time elapsed:</strong> {exec_time}s<br />
	<strong>Memory usage:</strong> {mem_usage} MB<br />
	<strong>Peak memory usage:</strong> {mem_peak_usage} MB
</p>

<h3>Events</h3>

{events}

</body>

</html>