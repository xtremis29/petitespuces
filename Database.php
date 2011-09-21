<?php
/**
 * Classe regroupant toutes les méthodes ayant accès à la base de données.
 */
final class Database
{
    # PARAMETRES DE CONNEXION
    const PARAM_hote = '127.0.0.1'; // le chemin vers le serveur
    const PARAM_nom_bd = 'petitepuce'; // le nom de votre base de donn�es
    const PARAM_utilisateur = 'root'; // nom d'utilisateur pour se connecter
    const PARAM_mot_passe = ''; // mot de passe de l'utilisateur pour se connecter
    const PARAM_character_set = "UTF-8";

    static $connexion = null;
    
    /**
     * Retourne une connexion à la base de donées.
     * 
     * @return PDO mysql connection
     */
    public static function getConnexion()
    {  
        if (self::$connexion == null)
        {
            try
            {
                self::$connexion = new PDO('mysql:host=' . self::PARAM_hote . ';dbname=' . self::PARAM_nom_bd . ';charset=' . self::PARAM_character_set, self::PARAM_utilisateur, self::PARAM_mot_passe, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            } catch (Exception $e)
            {
                echo 'Erreur No : ' . $e->getCode() . ": Une erreur s'est produite. Veuillez contacter le support technique ou réessayer un peu plus tard.";
            }
        }
        return self::$connexion;
    }  
       
    /**
     * Effectue une recherche dans la table produits afin de trouver les produits de 
     * l'abonné passé en paramètres.
     * 
     * @param int $abonne_id L'ID de l'abonné duquel on veut les produits.
     * @return array Les produits de l'abonné.
     */
    public static function getProduits($abonne_id)
    {  
        $query = "SELECT `produit_id`, `description_abregee`, `prix_demande`, `photo` "
                ."FROM `produits` " 
                ."WHERE `nb_items` > 0 AND `disponibilite` = 1 AND abonne_id = :abonne_id;";
        
        $connexion = self::getConnexion();
        $result_set = $connexion->prepare($query);
        $result_set->bindParam(':abonne_id', $abonne_id, PDO::PARAM_INT);
        $result_set->execute();
        $array = Database::resultSetToArray($result_set);
        $result_set->closeCursor();
        return $array;
    }  
       
    /**
     * Prend le result set passé en paramètres et le retourne en array
     * 
     * @param result_set $result_set Le result set à transformer en array
     * @return array Le result set transformé en array
     */
    public static function resultSetToArray($result_set)
    {  
        $array = array();
        while ($row = mysql_fetch_row($result_set))
        {
            $array[] = $row;
        }
        return $array;
    }  
       
}      
       
?>     