<?php
echo 'docker exec -it php7_web_1 php /var/www/html/local.dev/movynov/malade.php';
require_once './DB.php';
require_once "./api-allocine-helper.php";
$db = DB::getInstance();

// Créer un objet AlloHelper.
$allohelper = new AlloHelper;

for ($i = 8; $i <= 8; $i++) {
    $ligne = sprintf("%04d", $i);
    echo '<br>';
    try {
        $data = null;
        // Request sending
        //$movie = $allohelper->movie($i, $profile);
        $filmo = $allohelper->filmography($i);
        //var_dump($filmo->getObject());
        $dataperson = trim((isset($filmo->getObject()->name['given']) ? $filmo->getObject()->name['given'] : null) . ' ' . (isset($filmo->getObject()->name['family']) ? $filmo->getObject()->name['family'] : null));
        echo $ligne,' : NAME : '.$dataperson;
        echo '<br>';
        foreach ($filmo->getArray()['participation'] as $filmos){

            if(isset($filmos['tvseries'])){
                var_dump($filmos['tvseries']);
                $tv = $allohelper->tvserie($filmos['tvseries']['code']);
                if (isset($tv->getObject()->originalBroadcast['dateStart'])) {
                    $date = $newDate = date("Y-m-d", strtotime($tv->getObject()->originalBroadcast['dateStart']));
                }else{
                    $date = null;
                }
               echo '------ TV : '.$filmos['tvseries']['title'].' : '.$date;
               //var_dump($movie->getObject());
            }elseif (isset($filmos['movie'])){
                var_dump($filmos['movie']);
                $movie = $allohelper->movie($filmos['movie']['code']);
                if (isset($movie->getObject()->release['releaseDate'])) {
                    $date = $newDate = date("Y-m-d", strtotime($movie->getObject()->release['releaseDate']));
                }else{
                    $date = null;
                }
                echo '------ Film : '.$filmos['movie']['title'].' : '.$date;
            }

            echo ' : '.$filmos['activity']['$'].' '.(isset($filmos['role']) ? $filmos['role'] : '');
            echo '<br>';
        }

        // Print the title
//        $data = $movie->getObject();
//        var_dump($movie->getObject());
//        echo $ligne, " : Title: ", $movie->getObject()->title, PHP_EOL, ' ';
//        if (isset($data->release['releaseDate'])) {
//            $date = $newDate = date("Y-m-d", strtotime($data->release['releaseDate']));
//        }else{
//            $date = null;
//        }
//        echo $date , "<br>";
        //$db->exec("INSERT INTO movynov.films SET name = ?, kind = ?, date = ? ", [$movie->getObject()->title, $data->genre[0]['$'], $date]);
        //$db->exec("INSERT INTO movynov.actors SET name = ?, kind = ?, date = ? ", [$movie->getObject()->title, $data->genre[0]['$'], $date]);

    } catch (ErrorException $e) {
        // Affichage des informations sur la requête
        //echo "<pre>", print_r($allohelper->getRequestInfos(), 1), "</pre>";
        // Afficher un message d'erreur.
        echo $ligne, " : Erreur " . $e->getCode() . ": " . $e->getMessage(), "<br>";
    }
}