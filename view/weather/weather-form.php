<?php
namespace Anax\View;

?>
<h1>Väderlek</h1>
<form method="get">
<p>Ange en ip-address och se ifall den validerar.</p>
        <label for="ipaddress"> Stad: </label>
        <input type="text" name="ipaddress" placeholder="Ange Stad. T.ex: Paris" >
        <input type="submit" value="Validera">
</form>

<h1>Json</h1>
<form action="./weather-json" method="get">
<p>Validera en IP Address och visa information i JSON-format. </p>
        <label for="city" > Stad: </label>
        <input type="text" name="city" placeholder="Ange Stad. T.ex: Paris" >
        <label for="cnt" > Optional: </label>
        <input type="text" name="cnt" placeholder="Antal dagar. Mellan 1-50" >
        <input type="submit" value="Submit">
</form>

<h3>Hur mitt API fungerar</h3>
<p>Mitt API returnerar en historik på vädret från valfri stad med valifritt antal dagar (1 - 50)</p>
<p>Mitt API tar emot <strong>GET</strong> request till <strong>weather-json</strong> med parametrar <strong>?city={stad}</strong></p>
<p>Man kan också välja att skicka med en optionell parameter <strong>?cnt={antal dagar}</strong>. Man kan välja att få resultatet mellan 1 - 50 dagar.</p>
<p>Svaret skickas senare tillbaka med relevant information i JSON-format.</p>

<h4>Exempel på svar</h4>

<img src="img/weatherquery.PNG" alt="weather exempel" width="200"><br>
<img src="img/weatherexample.PNG" alt="weather Exempel" width="400">
