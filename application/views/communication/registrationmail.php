<html>
<head>
<style>
body {font-family: sans-serif;
    font-size: 12pt;
     line-height: 120%;
    
}
p {    margin: 10pt;
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
<p>Dear <?php echo $fullname; ?>

<p>
Welcome to Utsav- A celebration! </p>
<p>An event which will witness the HYM international and the National Agm of India in 2016. Congratulations for successfully logging in to begin your registration process.</p>

<p>The id given to your registration will be a reference is for our records and help tracking your payments.</p>
 <p>Please note this and mention it in any communication with regard to your registration.
</p>

<p>Once you login with your username and password you will find a menu on the dash board, 
this will enable you to fill details of partner registration, event registration, accommodation 
and so on. Please select the required options.</p>

<p>For any assistance please get in touch with the committee at <a href="mailto:hym@hymindia.org">hym@hymindia.org</a> or <a href="mailto:gopal@npl.in">gopal@npl.in</a></p>


<table width="800" border="1" cellpadding="0" cellspacing="0" class="outertable">
<tr>
<td class="logo" colspan="2" style="background-color:#000000"><img src="http://hymindia.gubbachi.org/images/hym_inida_logo.png" alt="HYM2016 Logo" title="HYM2012 logo" /> <?php echo date("d/m/Y");?></td>

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
	<th class="lefta"> HYM Event Code</th>
	<td class="lefta"><?php echo $hymindiaid; ?></td>
</tr>
<tr>
<td colspan="2" class="logo footer">
Best regards<br/>
The Utsav team<br/>
HYM and NAGM India<br/>
</td>
</tr>
</table>
</body>
</html>