<?php

$server = 'localhost';
$user = 'root';
$pwd = '';
$db = 'ma_liste';

try {
    $connect = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pwd);

    $eleve = $connect->prepare("
            SELECT eleve.id, eleve.prenom, eleve.nom, eleve.login, eleve.password, eleve_information.rue, eleve_information.cp, eleve_information.ville, eleve_information.pays
            FROM eleve
            INNER JOIN eleve_information ON eleve_information.id = eleve.information_id
    ");

    $liste = $eleve->execute();

    if($liste) {
        foreach ($eleve->fetchAll() as $value) {
            echo "<div>";
            print_r($value);
            echo "</div>";
        }
    }

    $competence = $connect->prepare("
            SELECT eleve_compétence.id, eleve_compétence.niveau ,eleve.prenom, eleve.nom, eleve.login, eleve.password, competence.titre, competence.description
            FROM eleve_compétence
            INNER JOIN eleve ON eleve.id = eleve_compétence.eleve_id
            INNER JOIN competence ON competence.id = eleve_compétence.competence_id
    ");

    $liste = $competence->execute();

    if($liste) {
        foreach ($competence->fetchAll() as $value) {
            echo "<div>";
            print_r($value);
            echo "</div>";
        }
    }
}
catch (PDOException $exception) {
    echo "Erreur de connexion: " . $exception->getMessage();
}
?>
