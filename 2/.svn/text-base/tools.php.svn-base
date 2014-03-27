<html>
    <head>
        <title>TOOLS</title>
    </head>
	<body>
		<form name="input" action="tools.php" method="post">
			Time:<input type="text" name="time" />
			<input type="submit" value="Submit" />
		</form>
        <?php
			$time = $_POST['time'];
			$t = getdate($time);
			echo $t['year'];
			echo " ".$t['month'];
			echo " ".$t['mday'];
			echo "   ".$t['hours'].":".$t['minutes'].":".$t['seconds'];
		?>
        <form name="first" action="tools.php" method="post">
        	Check out who is the first today:<input type="submit" name="checkfirst" value="submit">
        </form>
        <?php
        	 
        ?>
	</body>
</html>
