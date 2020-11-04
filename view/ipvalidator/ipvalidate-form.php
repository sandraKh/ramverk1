<?php
namespace Anax\View;

?>
<h1>IP Koll</h1>
<h4>Vanlig</h4>
<form method="get">
<p>Ange en ip-address och se ifall den validerar.</p>
        <label for="ipaddress">IP Address: </label>
        <input type="text" name="ipaddress" placeholder="Ange IP Address" >
        <input type="submit" value="Validera">
</form>

<h4>Json</h4>
<form action="./ip-json" method="get">
<p>Validera en IP Address och visa information i JSON-format. </p>
        <label for="ipaddress">IP Address: </label>
        <input type="text" name="ip" placeholder="Ange IP Address" >
        <input type="submit" value="Validera">
</form>

<h3>Testa Routes</h3>
<form action="./ip-json" method="get">
        <p>Validerar</p>
        <input class="testroute" type="submit" name="ip" value="158.174.92.90"><br>
        <input class="testroute" type="submit" name="ip" value="123.123.12.1"><br>
        <p>Validerar inte</p>
        <input class="testroute" type="submit" name="ip" value="37.424.205.237"><br>
        <input class="testroute" type="submit" name="ip" value="55:55.23"><br>
</form>

<h3>Hur mitt API fungerar</h3>
<p>Mitt API tar emot <strong>GET</strong> request till <strong>ip-json</strong> med parametrar <strong>?ip={ipadress}</strong></p>
<p>Sedan valideras ip-addressen och kollar om det är en fungerande ip-address och svaret skickas sedan son en JSON-address.</p>
<h4>Exempel på svar</h4>

<img src="img/apiquery.PNG" alt="api query exempel" width="200"><br>
<img src="img/apiexempel.PNG" alt="api Exempel" width="400">
