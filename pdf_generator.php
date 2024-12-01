<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PDF Generator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="content">
        <h2>Generate PDF</h2>
        <form action="generate_pdf.php" method="post">
            <label for="username">Username:</label>
            <select name="username" id="username">
                <?php
                // Fetch usernames from `accounts`
                $con = new mysqli('localhost', 'root', '', 'nb1');
                $result = $con->query("SELECT username FROM accounts");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['username']}'>{$row['username']}</option>";
                }
                ?>
            </select><br><br>

            <label for="club">Club:</label>
            <select name="club" id="club">
                <?php
                // Fetch club names from `klub`
                $result = $con->query("SELECT csapatnev FROM klub");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['csapatnev']}'>{$row['csapatnev']}</option>";
                }
                ?>
            </select><br><br>

            <label for="position">Position:</label>
            <select name="position" id="position">
                <?php
                // Fetch positions from `poszt`
                $result = $con->query("SELECT nev FROM poszt");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['nev']}'>{$row['nev']}</option>";
                }
                ?>
            </select><br><br>

            <button type="submit">Generate PDF</button>
        </form>
    </div>
</body>
</html>
