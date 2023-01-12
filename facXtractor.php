<?php

 include 'auth.php';
 include 'fac_database_class.php';
 
?>
<html>
<body>
<h1>Datenexport Facto</h1>
<b>Bitte Exportprofil wählen und ggf. notwendige Parameter ausfüllen:</b>
<br/>
<form action=# method=GET>
	Exportprofil: <select name=profil>
	<option value="--">[bitte wählen]</option>
	 <option value="lparam">Lager Parameter</option>
	 <option value="preispflege">Preispflege</option>
	</select>
    <br/>
	Lieferant:  <input type=text name=linr />
	<br/>
	<input type=submit name=action value=action />

</form>
<?php 
 
 if (isset($_GET['profil'])) { 
	include 'profil_'.preg_replace("[^A-Za-z0-9]","",$_GET['profil']).'.php';
 }
 $lager = new facDatabase();
 $lager->splitQuery($sql, $splitField, $parameter, $outputFilePrefix, $header, $createType);



?>
</body>
</html>