<?php

namespace App\Model\classes;

class Adherent {
    private $id;
    private $nom;
    private $prenom;
    private $dateInscription;

    public function __construct($id, $nom, $prenom, $dateInscription) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateInscription = $dateInscription;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getDateInscription() {
        return $this->dateInscription;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setDateInscription($dateInscription) {
        $this->dateInscription = $dateInscription;
    }
}

?>
