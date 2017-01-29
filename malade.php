<?php
$timestamp_debut = microtime(true);

require_once 'DB.php';
$db = DB::getInstance();

$kind = ["Action", "Adventure", "Comedy", "Crime", "Drama", "Fantasy", "Historical", "Horror"];
$gender = ["femme", "homme"];

/*for ($i = 0; $i < 500; $i++) {
    $db->exec("INSERT INTO movynov.actors SET name = ?, gender = ?", ["actor".$i, $gender[mt_rand(0,1)]]);
    echo "actor#".$i." - ".date('h:i:s A')."\n";
}*/

for ($i = 25001; $i <= 27000; $i++) {
    echo "# -------------------- #\n";
    $db->exec("INSERT INTO movynov.films SET name = ?, kind = ?, date = ? ", ["film" . $i, $kind[mt_rand(0, 7)], date("Y-m-d", mt_rand(633398400, 1485475200))]);
    for ($o = 0; $o < mt_rand(10, 50); $o++) {
        echo "film#" . $i . " ---- ";
        try {
            $db->exec("INSERT INTO movynov.castings SET role = ?, id_film = ?, id_actor = ? ", ["role" . $o, $i, mt_rand(0, 500)]);
            echo "role#" . $o . "\n";
        } catch (PDOException $e) {
            echo "error\n";
        }
    }
}

for ($i = 25001; $i <= 27000; $i++) {
    echo "# -------------------- #\n";
    $db->exec("INSERT INTO movynov.series SET name = ?, kind = ?, date = ? ", ["serie" . $i, $kind[mt_rand(0, 7)], date("Y-m-d", mt_rand(633398400, 1485475200))]);
    for ($o = 0; $o < mt_rand(10, 50); $o++) {
        echo "serie#" . $i . " ---- ";
        try {
            $db->exec("INSERT INTO movynov.castings SET role = ?, id_serie = ?, id_actor = ? ", ["role" . $o, $i, mt_rand(0, 500)]);
            echo "role#" . $o . "\n";
        } catch (PDOException $exception) {
            echo "error\n";
        }
    }
}

$timestamp_fin = microtime(true);
$difference_ms = $timestamp_fin - $timestamp_debut;
echo 'Exécution du script : ' . $difference_ms . ' secondes.';