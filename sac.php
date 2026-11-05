<?php

class SAC
{
    public $ref, $cat, $marque, $prix, $photo;

    private $serveur, $login, $pwd, $BD, $cnx;

    function __construct()
    {
        $this->serveur = 'localhost';
        $this->login = 'root';
        $this->pwd = '';
        $this->BD = 'cartable';

        $this->cnx = new PDO(
            "mysql:host=" . $this->serveur .
            ";dbname=" . $this->BD . ";charset=utf8mb4",
            $this->login,
            $this->pwd
        );
        $this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function insert()
    {
        $req = "INSERT INTO produits
                (ref, cat, marque, prix, photo)
                VALUES (?, ?, ?, ?, ?)";

        $x = $this->cnx->prepare($req);

        $x->execute([
            $this->ref,
            $this->cat,
            $this->marque,
            $this->prix,
            $this->photo
        ]);
    }

    function getAll()
    {
        $req = "SELECT * FROM produits";
        return $this->cnx->query($req);
    }

    function getByRef($ref)
    {
        $req = "SELECT * FROM produits WHERE ref = ?";
        $x = $this->cnx->prepare($req);
        $x->execute([$ref]);
        return $x->fetch(PDO::FETCH_ASSOC);
    }

    function supprimerParRef($ref)
    {
        $req = "DELETE FROM produits WHERE ref = ?";
        $x = $this->cnx->prepare($req);
        return $x->execute([$ref]);
    }

    function getConnexion()
    {
        return $this->cnx;
    }
}
fetch
?>
