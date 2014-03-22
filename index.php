<?php
class ShortestPath{
	//                __  _                 
	//   ____  ____  / /_(_)___  ____  _____
	//  / __ \/ __ \/ __/ / __ \/ __ \/ ___/
	// / /_/ / /_/ / /_/ / /_/ / / / (__  ) 
	// \____/ .___/\__/_/\____/_/ /_/____/  
	//     /_/                              
	private $x;
	private $y;
	private $map;
	private $position;
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct($x = 20, $y = 20)
	{
		$this->x        = $x;
		$this->y        = $y;
		$this->map      = $this->generateMap($x, $y);		
		$this->position = $this->generateStartPosition();
	}	

	/**
	 * Generate map
	 * @param  integer $x 
	 * @param  integer $y 
	 * @return array - map
	 */
	private function generateMap($x, $y)
	{
		for ($_y = 0; $_y < $y; $_y++) 
		{ 
			for ($_x = 0; $_x < $x; $_x++) 
			{ 
				$arr[$_x][$_y] = mt_rand(0, 1);
			}
		}
		return $arr;
	}      

	/**
	 * Impassable field class
	 * @param  boolean $bool 
	 * @return string
	 */
	private function impassable($bool = true)
	{
		if($bool) return 'success';
		return '';
	}    

	/**
	 * Generate start position
	 */
	private function generateStartPosition()
	{
		$x = mt_rand(1, $this->x-2);
		$y = mt_rand(1, $this->y-2);
		if($this->map[$x][$y]) return $this->generateStartPosition();
		return array('x' => $x, 'y' => $y);
	}  

	/**
	 * Display Map
	 */
	public function displayMap()
	{
		?>
		<table class="table">
			<tbody>
				<?php
				for ($_x = $this->x-1; $_x >= 0; $_x--) 
				{ 
					echo "<tr>";
					for ($_y = 0; $_y < $this->y; $_y++) 
					{ 
						if($this->position['x'] == $_x AND $this->position['y'] == $_y)
						{
							echo '<td class="info '.$this->impassable($this->map[$_x][$_y]).'">'.$_x.'/'.$_y.'['.$this->map[$_x][$_y].']</td>';
						}
						else echo '<td class="'.$this->impassable($this->map[$_x][$_y]).'">'.$_x.'/'.$_y.'['.$this->map[$_x][$_y].']</td>';
					}
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
		<?php
	}  

} 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Нахождение кратчайшего пути</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/docs.css">
</head>
<body>	
	<div class="row">
		<div class="col-md-4 col-lg-4">
			<div class="logo-block">
				<img alt="gurievcreative" src="img/mylogo.png">
				<h1>Guriev Creative</h1>				
				<span>МИР МЕНЯЮТ СМЕЛЫЕ</span>
			</div>
		</div>
		<div class="col-md-8 col-lg-8">
			<?php
				$shortest_path = new ShortestPath();
				$shortest_path->displayMap();
			?>
		</div>
	</div>
</body>
</html>