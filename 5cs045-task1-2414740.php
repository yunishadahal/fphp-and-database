
<?php
$host = "mi-Linux.wlv.ac.uk";
$username = "2414740";
$password = "University2001";
$database = "db2414740";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed.");
}

$sql = "SELECT Book_name, Genre, Price, Date_of_release FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #e8e8e8;
        }

        tr:nth-child(even) {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>

<h1>Books List</h1>

<table>
    <thead>
        <tr>
            <th>Book name</th>
            <th>Genre</th>
            <th>Price</th>
            <th>Date of release</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" .
                    htmlspecialchars($row['Book_name']) . "</td>";
                echo "<td>" .
                    htmlspecialchars($row['Genre']) . "</td>";
                echo "<td>&pound;" .
                    number_format((float)$row['Price'], 2) . "</td>";
                echo "<td>" .
                    date('d/m/Y', strtotime($row['Date_of_release'])) .
                    "</td>";
                echo "</tr>";
            }
        } else {
            echo '<tr><td colspan="4">No books found.</td></tr>';
        }

        $conn->close();
        ?>
    </tbody>
</table>

</body>
</html>
