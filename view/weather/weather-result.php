<?php
namespace Anax\View;

?>


<h1>Kommande 7 Dagar</h1>
<?php if ($list) :
    echo "<table id='weather-table'>

    <tr>

    <th>Day</th>

    <th>Main Weather</th>

    <th>Temperature</th>

    <th>What it feels like</th>

    <th>Icon</th>

    </tr>";

    ?>

    <?php foreach ($list as $key => $row) :
        ?>
        <?php
        echo "<tr>";
        echo "<td>" .json_encode($key + 1). "</td>";
        echo "<td>" . trim(json_encode($row["weather"][0]["main"]), '"') . "</td>";
        echo "<td>" . round(json_encode($row["main"]["temp"]-273.15), 1). " C°" . "</td>";
        echo "<td>" . round(json_encode($row["main"]["feels_like"]-273.15), 1) . "</td>";
        echo "<td><img src=\"http://openweathermap.org/img/wn/" . trim(json_encode($row["weather"][0]["icon"]), '"') . "@2x.png\"></td>";
    endforeach;
    echo "</tr>";
    echo "</table>";
    ?>
<?php endif; ?>
