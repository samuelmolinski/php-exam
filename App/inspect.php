<?php
	
	require_once 'config.php';

    function inspect($var){
				
		//		
		if (!defined('DEBUG') || DEBUG) {
			
			$bt = debug_backtrace();
			$src = file($bt[0]["file"]);
			$line = $src[ $bt[0]['line'] - 1 ];

			//striping the inspect() from the sting
			$strip = explode('inspect(', $line);
			$matches = preg_match('#\(#', $strip[0]);
			$strip = explode(')', $strip[1]);
			for ($i=0;$i<count($matches-1);$i++) {
				array_pop($strip);
			}
			$label = implode(')', $strip);

			$colorVar = 'Blue';

			if (is_bool($var)) {
				$colorType = 'Green';
				$type = 'bool';
			} elseif (is_string($var)) {
				$colorType = 'DarkOrange';
				$type = 'string';
			} elseif (is_array($var)) {
				$colorType = 'DarkOrchid';	
				$type = 'array';		
			} elseif (is_object($var)) {
				$colorType = 'BlueViolet';	
				$type = 'object';		
			} elseif (is_numeric($var)) {
				$colorType = 'Red';	
				$type = 'numeric';
			} else {
				$type = 'unknown';		
				$colorType = 'Tomato';	
			}

			echo "<div style='background-color:#FFF; overflow:visible;'><pre><span style='color:$colorVar'>";
			echo $label;
			echo "</span> = <span style='color:$colorType'>";
			if ($type == 'string') {
				print_r(htmlspecialchars($var));
			} else {
				print_r($var);
			}
			echo "</span></pre></div>";
		}

	}

?>