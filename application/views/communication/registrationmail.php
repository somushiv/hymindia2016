<html>
<head>
<style>
body {font-family: sans-serif;
    font-size: 10pt;
    
}
p {    margin: 0pt;
}
td.logo{background-color:#000000}
.outertable{border:2px solid #FE9800;}
.lefta{text-align:left}
td,th{padding:10px 10px;border-bottom:1px dotted #cccccc}
th{width:20%}
.footer{font-size:.8em;padding:3px;color:#cccccc}
.color1{color:#FE9800;font-weight:bold}
</style>
</head>
<body>
<table width="800" border="0" cellpadding="0" cellspacing="0" class="outertable">
<tr>
<td class="logo" colspan="2"><img src="/images/hym_inida_logo.png" alt="HYM2016 Logo" title="HYM2012 logo" /> <?php echo date("d/m/Y");?></td>

</tr>
<tr>
	<th class="lefta"> Full Name</th>
	<td class="lefta"><?php echo $fullname; ?></td>
</tr>
<tr>
	<th class="lefta">Login ID</th>
	<td class="lefta"><?php echo $loginid; ?></td>
</tr>
<tr>
	<th class="lefta">Password</th>
	<td class="lefta"><?php echo $password; ?></td>
</tr>
<tr>
	<td colspan="2">
		<h4>Notes:</h4>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas lacinia tempor mi, eleifend bibendum nisl bibendum non. Etiam eu facilisis ligula, vel condimentum magna. Sed lobortis est quis urna commodo vulputate. Pellentesque sed nisl sit amet sapien hendrerit mollis vulputate a orci. Proin non dui risus. Donec bibendum ut massa sit amet congue. Donec porta non enim et fringilla. Proin sollicitudin consectetur urna eget sodales. Maecenas mattis tortor ut ante aliquam consectetur. Nam ac justo ut nisl bibendum consequat. Etiam eleifend lobortis leo sit amet blandit. Donec posuere tellus nunc. Pellentesque lacinia sit amet urna quis facilisis. </p>
	</td>
	
</tr>
<tr>
<td colspan="2" class="logo footer">
<span class="color1">More Details :</span> <strong>(T)</strong> +91.9845188706, <strong>(E)</strong> contact@hymindia2016.org
</td>
</tr>
</table>
</body>
</html>