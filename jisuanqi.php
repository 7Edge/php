<html>
	<head>
		<title>PHP计算器</title>
	</head>
	<body>
		<?php
			$mess = "";		//错误消息放入此变量
			if(isset($_POST["sub"])){
				if( $_POST["num1"] == ""){
					$mess .= "第一个数不能为空!<br>";
				}else{
					if(!is_numeric($_POST["num1"])){
						$mess .= "第一个数必须是数字！<br>";
					}
				}
				if( $_POST["num2"] ==""){
					$mess .="第二个数不能为空！<br>";
				}else{
					if(!is_numeric($_POST["num2"])){	
						$mess .= "第二个数必须是数字！<br>";
					}else{	
						if($_POST["opt"] == "/" && $_POST["num2"] == 0){
							$mess .= "除数不能为0";
						}
					}
				}
			}
		?>
		<table border = "1" align = "center" width = "400">
			<form action = "" method = "post">
				<caption><h1>计算器</h1></caption>
				<tr>
					<td>
						<input type = "text" size = "4" name = "num1" value = "<?php echo $_POST["num1"] ?>" />
					</td>
					
					<td>
						<select name = "opt">
							<option value="+" <?php echo $_POST["opt"]=="+" ? "selected":"" ?>>+</option>
							<option value="-" <?php echo $_POST["opt"]=="-" ? "selected":"" ?>>-</option>
							<option value="x" <?php echo $_POST["opt"]=="x" ? "selected":"" ?>>x</option>
							<option value="%" <?php echo $_POST["opt"]=="%" ? "selected":"" ?>>%</option>
							<option value="/" <?php echo $_POST["opt"]=="/" ? "selected":"" ?>>/</option>
						</select>
					</td>
					
					<td>
						<input type="text" size="4" name="num2" value = "<?php echo $_POST["num2"] ?>" />
					</td>
					
					<td>
						<input type="submit" name="sub" value="计算结果" />
					</td>
					
				</tr>
			</form>
		<?php
			if(isset($_POST["sub"])){
				echo '<tr><td colspan="4">';
				if(!$mess){
					$sum=0;
					switch($_POST["opt"]){
						case "+":
							$sum = $_POST["num1"] + $_POST["num2"];break;
						case "-":
							$sum = $_POST["num1"] - $_POST["num2"];break;
						case "x":
							$sum = $_POST["num1"] * $_POST["num2"];break;
						case "/":
							$sum = $_POST["num1"] / $_POST["num2"];break;
						case "%":
							$sum = $_POST["num1"] % $_POST["num2"];break;
					}
				echo "计算结果是：{$_POST['num1']}{$_POST['opt']}{$_POST['num2']}={$sum}  {$_POST['sub']}";
				}else{
					echo $mess;
				}
				echo '</td></tr>';
			}
		?>
		</table>
	</body>
</html>