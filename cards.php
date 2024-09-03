<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Magic The Gathering Card Database</h2>

    <?php
$conn_string = "host=localhost port=5432 dbname=magiccards user=postgres";
$dbconn = pg_connect($conn_string);

if (!$dbconn) {
    die("Connection failed: " . pg_last_error());
}
echo "Connected successfully";

$query = "SELECT * FROM public.cards";
$result = pg_query($dbconn, $query);

if (!$result) {
    die("Error in SQL query: " . pg_last_error());
}
?>

    <table>
        <tr>
            <th>ID</th>
            <th>Artist</th>
            <th>Flavor Text</th>
            <th>Name</th>
            <th>Mana Value</th>
            <th>Original Text</th>
        </tr>


        <?php
    while($row = pg_fetch_assoc($result)) {
        echo "<tr>
            <td>" . (isset($row['id']) ? htmlspecialchars($row['id']) : '') . "</td>
            <td>" . (isset($row['artist']) ? htmlspecialchars($row['artist']) : '') . "</td>
            <td>" . (isset($row['flavor_text']) ? htmlspecialchars($row['flavor_text']) : '') . "</td>
            <td>" . (isset($row['name']) ? htmlspecialchars($row['name']) : '') . "</td>
            <td>" . (isset($row['mana_value']) ? htmlspecialchars($row['mana_value']) : '') . "</td>
            <td>" . (isset($row['original_text']) ? htmlspecialchars($row['original_text']) : '') . "</td>
        </tr>";
    }
?>

    </table>
</body>
</html>