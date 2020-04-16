<?php
Class DataLayer{
    private $connexion;

    // établit la connexion à la base en utilisant les infos de connexion des constantes DB_DSN, DB_USER, DB_PASSWORD
    // susceptible de déclencher une PDOException
    public function __construct(){
            $this->connexion = new PDO(
                       DB_DSN, DB_USER, DB_PASSWORD,
                       [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,     // déclencher une exception en cas d'erreur
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // chaque ligne du résultat sera une table associative
                       ]
                     );

    }

    /* renvoie le contenu de la base de données */
    function getContent(){
     $sql = <<<EOD
     select *
     from bornes

EOD;
     $stmt = $this->connexion->prepare($sql); // préparation de la requête
     $stmt->execute();                        // exécution de la requête
     return $stmt->fetchAll(); // récupération des données dans bornes
     }

}
?>
