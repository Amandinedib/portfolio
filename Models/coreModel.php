<?php

/**
 * CoreModel permet de créer un objet PDO permettant de communiquer avec la base de données. Puis de faire des requêtes permettant de récuperer des données venant de la BDD, d'en insérer, d'en modifiant ou bien encore d'en supprimer.
 */
class CoreModel{

    /**
     * $pdo Objet PDO instance de connexion à la BDD
     * @var null
     */
    private static $pdo = NULL;

    //La fonction __construct retourne notre objet PDO s'il existe deja , sinon il le crée
    public function __construct(){
        if(self::$pdo == NULL){
            self::$pdo = new PDO ('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
            // Permet de configurer un attribut de PDO : ici le rapport d'erreur avec l'emission d'exception
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;      
    }

    //Permet une requete de type DROP,INSERT,UPDATE 
    protected function makeStatement($sql, $params = array())
    {   
        //Si le tableau $params est vide
        if(count($params) == 0)
        {
            // On retourne un jeu de résultats (d'une requête SELECT) (retourne objet PDOStatement)
            $statement = self::$pdo->query($sql);
        }
        else
        {
            // On prépare la requête à executer, si le serveur de la BDD la prépare avec succès (retourne un objet PDOStatement au final)
            if(($statement = self::$pdo->prepare($sql)) !== false)
            {
                //On parcourt le tableau de données fournies (paramètres et leur valeurs données)
                foreach ($params as $placeholder => $value)
                {
                    // On regarde le type de valeurs de $params pour que PDO sache quoi en faire suivant le type (= performance)
                    switch(gettype($value))
                    {
                        case "integer":
                            $type = PDO::PARAM_INT;
                            break;

                        case "boolean":
                            $type = PDO::PARAM_BOOL;
                            break;

                        case "NULL":
                            $type = PDO::PARAM_NULL;
                            break;

                        default:
                            $type = PDO::PARAM_STR;
                    }
                    // On associe les valeurs, leur type aux paramètres, sauf en cas d'erreurs on retourne false
                    if($statement->bindValue($placeholder, $value, $type) === false)
                        return false;
                }
                // On execute la requête, s'il y a une erreur on retourne false
                if(!$statement->execute())
                {
                    return false;
                }
            }
        }

        return $statement;
    }

    /**
     * @param string $sql la requête SELECT
     * @param array $params un tableau associatif du genre $placeholder => $valeur
     * @param int $fetchStyle tableau ayant le jeu de résultat retourné (indexé par le nom de la colonne)
     * @return array|bool $data talbeau qui contient tous les lignes de résultats ou false s'il y a eu une erreur
     */
    //Permet les requetes de type SELECT
    protected function makeSelect($sql, $params = array(), $fetchStyle = PDO::FETCH_ASSOC)
    {
        $statement = $this->makeStatement($sql, $params);
        // Si la requête n'est pas exécutée (retourne false car erreur) on retourne false
        if($statement === false)
        {
            return false;
        }
        // Sinon on affecte à $data les données stockées dans $fetchStyle
        $data = $statement->fetchAll($fetchStyle);
        // On clot la requête
        $statement->closeCursor();
        //On retourne $data avec les données affectées à cette variable ou false si erreur
        return $data;
    }
}