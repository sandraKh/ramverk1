<?php
namespace Anax\View;

?>
<h1>Senaste Uppmätta Dagar</h1>

<?php if ($data[0]["count"] == 0) :?>
    <p>Var vänlig skriv in en giltil stad.</p>
<?php endif; ?>
<?php if ($data[0]["count"] != 0) :
    echo "<table id='weather-table'>

    <tr>

    <th>Days Since</th>

    <th>Main Weather</th>

    <th>Temperature</th>

    <th>What it felt like</th>

    <th>Icon</th>

    </tr>";

    ?>

    <?php for ($x = 0; $x < count($data[0]["list"]); $x++) {
        echo "<tr>";
        echo "<td>" .json_encode($x + 1). "</td>";
        echo "<td>" . trim(json_encode($data[0]["list"][$x]["weather"][0]["main"]), '"') . "</td>";
        echo "<td>" . round(json_encode($data[0]["list"][$x]["main"]["temp"]-273.15), 1). " C°" . "</td>";
        echo "<td>" . round(json_encode($data[0]["list"][$x]["main"]["feels_like"]-273.15), 1) . "</td>";
        echo "<td><img src=\"http://openweathermap.org/img/wn/" . trim(json_encode($data[0]["list"][$x]["weather"][0]["icon"]), '"') . "@2x.png\"></td>";
    }
    echo "</tr>";
    echo "</table>";
    ?>



    <h1>Karta</h1>
    <?php

    $long = 0;
    $lat = 0;

    foreach ($data as $key => $row) :
        $long = trim(json_encode($data[0]["list"][0]["coord"]["lon"]), '"');
        $lat = trim(json_encode($data[0]["list"][0]["coord"]["lat"]), '"');
    endforeach;?>

    <p style="display: none;" id="longitude"><?= $long ?></p>
    <p style="display: none;" id="latitude"><?= $lat ?></p>

    <p style="display: none;" id="longitude"><?= $long ?></p>
    <p style="display: none;" id="latitude"><?= $lat ?></p>

    <div style="height: 400px;" id="map"></div>

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css">
    <script src='https://unpkg.com/leaflet@1.3.3/dist/leaflet.js'></script>
    <script type="text/javascript">

    var longitude = document.getElementById('longitude').innerText;
    var latitude = document.getElementById('latitude').innerText;

    var map = L.map('map').setView([latitude, longitude], 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([latitude, longitude]).addTo(map)
    .openPopup();
</script>
</div>

<?php endif; ?>
