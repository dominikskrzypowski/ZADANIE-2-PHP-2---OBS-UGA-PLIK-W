<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dziennik Ocen</title>
</head>
<body>

    <form method="POST" action="">
        <h2>Dodaj ocenę</h2>
        
        <label for="imie">Imię i nazwisko ucznia:</label>
        <input type="text" id="imie" name="imie" required>

        <label for="ocena">Ocena:</label>
        <select id="ocena" name="ocena" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>

        <label for="przedmiot">Przedmiot:</label>
        <input type="text" id="przedmiot" name="przedmiot" required>

        <button type="submit" name="zapisz">Zapisz ocenę</button>
    </form>

    <?php
    if (isset($_POST['zapisz'])) {
        $imie = trim($_POST['imie']);
        $ocena = $_POST['ocena'];
        $przedmiot = trim($_POST['przedmiot']);

        if (!empty($imie) && !empty($przedmiot)) {
            $linia = "$imie | $przedmiot | ocena: $ocena\n";

            $plik = fopen("oceny.txt", "a");
            
            if ($plik) {
                fwrite($plik, $linia);
                fclose($plik);
            }
        }
    }
    ?>

    <div class="wyniki">
        <h2>Zapisane oceny</h2>
        <?php
        if (file_exists("oceny.txt")) {
            $plik = fopen("oceny.txt", "r");
            
            if ($plik) {
                while (!feof($plik)) {
                    $linia = fgets($plik);
                    if (trim($linia) !== "") {
                        echo htmlspecialchars($linia) . "<br>";
                    }
                }
                fclose($plik);
            }
        } else {
            echo "Brak zapisanych ocen (plik oceny.txt jeszcze nie istnieje).";
        }
        ?>
    </div>

</body>
</html>