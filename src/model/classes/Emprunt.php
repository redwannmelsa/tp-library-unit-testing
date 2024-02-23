<?php

namespace App\Model\classes;

use App\Model\classes\Livre;

class Emprunt {
    private $id; 
    private $adherent; // Objet de type Adherent
    private $livre;    // Objet de type Livre
    private $dateEmprunt;
    private $dateRetourPrevu;

    public function __construct($adherent, $livre, $dateEmprunt, $dateRetourPrevu) {
        $this->adherent = $adherent;
        $this->livre = $livre;
        $this->dateEmprunt = $dateEmprunt;
        $this->dateRetourPrevu = $dateRetourPrevu;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getAdherent() {
        return $this->adherent;
    }

    public function getLivre() {
        return $this->livre;
    }

    public function getDateEmprunt() {
        return $this->dateEmprunt;
    }

    public function getDateRetourPrevu() {
        return $this->dateRetourPrevu;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setAdherent($adherent) {
        $this->adherent = $adherent;
    }

    public function setLivre($livre) {
        $this->livre = $livre;
    }

    public function setDateEmprunt($dateEmprunt) {
        $this->dateEmprunt = $dateEmprunt;
    }

    public function setDateRetourPrevu($dateRetourPrevu) {
        $this->dateRetourPrevu = $dateRetourPrevu;
    }
}

?>
