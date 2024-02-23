<?php

namespace App\Model\classes;

use App\Model\classes\Livre;
use App\Model\classes\Adherent;
use App\Model\classes\Emprunt;

class Bibliotheque {
    private $livres = [];
    private $adherents = [];
    private $emprunts = [];

    public function __construct() {

        // Si des livres sont déjà stockés dans la session, les récupérer
        if (isset($_SESSION['livres'])) {
            $this->livres = array_map(function($livre) {
                                return new Livre($livre['titre'], $livre['auteur'], $livre['isbn'], $livre['nombrePages']);
                            }, $_SESSION['livres']);
        }
        if (isset($_SESSION['adherents'])) {
            $this->adherents = array_map(function($adherent) {
                                return new Adherent($adherent['id'], $adherent['nom'], $adherent['prenom'], $adherent['dateInscription']);
                            }, $_SESSION['adherents']);
        }
    }

    // Gestion des livres
    public function ajouterLivre($titre, $auteur, $genre) {
        $id = count($this->livres) + 1;
        $livre = new Livre($id, $titre, $auteur, $genre);
        $this->livres[] = $livre;
    }

    public function getLivres() {
        return $this->livres;
    }

    public function getLivreByIsbn($isbn) {
        foreach ($this->livres as $livre) {
            if ($livre->getIsbn() === $isbn) {
                return $livre;
            }
        }
        return null;
    }

    // Supprimer un livre de la bibliothèque
    public function supprimerLivre($isbn) {
        foreach ($this->livres as $index => $livre) {
            if ($livre->getIsbn() == $isbn) {
                unset($this->livres[$index]);
                unset($_SESSION['livres'][$index]);
                $_SESSION['livres'] = array_values($_SESSION['livres']); // Réindexer le tableau
                break;
            }
        }
    }

    // Modifier un livre existant
    public function modifierLivre($isbn, $nouveauTitre, $nouvelAuteur, $nouveauNombrePages) {
        foreach ($this->livres as $index => $livre) {
            if ($livre->getIsbn() == $isbn) {
                $livre->setTitre($nouveauTitre);
                $livre->setAuteur($nouvelAuteur);
                $livre->setNombrePages($nouveauNombrePages);
                $_SESSION['livres'][$index] = serialize($livre);
                break;
            }
        }
    }

    // Gestion des adhérents
    public function ajouterAdherent($nom, $prenom, $dateInscription) {
        $id = time();
        $adherent = new Adherent($id, $nom, $prenom, $dateInscription);
        $this->adherents[] = $adherent;
        // Ajout de l'adherent à la session
        $_SESSION['adherents'][] = serialize($adherent);
    }

    public function getAdherents() {
        return $this->adherents;
    }

    public function getAdherentById($id) {
        foreach ($this->adherents as $adherent) {
            if ($adherent->getId() == $id) {
                return $adherent;
            }
        }
        return null;
    }

    public function supprimerAdherent($id) {
        foreach ($this->adherents as $index => $adherent) {
            if ($adherent->getId() == $id) {
                unset($this->adherents[$index]);
                break;
            }
        }
    }

    // Gestion des emprunts
    public function emprunterLivre($adherentId, $livreIsbn, $dateEmprunt, $dateRetourPrevu) {

        $livre = $this->getLivreByIsbn($livreIsbn);
        $livre->setIdAdherent($adherentId);
        $livre->setDateEmprunt($dateEmprunt);
        $livre->setDateRetourPrevu($dateRetourPrevu);

        foreach($this->livres as $index => $livre){
            if($livre->getIsbn() === $livreIsbn){
                $this->livres[$index] = $livre;
                $_SESSION['livres'][$index] = serialize($livre);
                break;
            }
        }
    }

    public function getEmprunts() {
        $emprunts = [];

        foreach($this->livres as $index => $livre){
            if($livre->getIdAdherent() !== null){
                $adherent = $this->getAdherentById($livre->getIdAdherent());
                $emprunts[] = new Emprunt(time(), $adherent, $livre, $livre->getDateEmprunt(), $livre->getDateRetourPrevu());
            }
        }

        return $emprunts;
    }

    public function getEmpruntById($id) {
        foreach ($this->emprunts as $emprunt) {
            if ($emprunt->getId() == $id) {
                return $emprunt;
            }
        }
        return null;
    }

    public function retourLivre(Livre $livre) {
        foreach ($this->livres as $index => $l) {
            if ($l->getIsbn() == $livre->getIsbn()) {
                $livre->setIdAdherent(null);
                $_SESSION['livres'][$index] = serialize($livre);
                break;
            }
        }
    }

    public function modifierAdherent($id, $nom, $prenom, $dateInscription) {
        foreach ($this->adherents as $adherent) {
            if ($adherent->getId() == $id) {
                $adherent->setNom($nom);
                $adherent->setPrenom($prenom);
                $adherent->setDateInscription($dateInscription);
                return true; // Retourne true si la modification a été effectuée
            }
        }
        return false; // Retourne false si l'adhérent n'a pas été trouvé
    }
    
}

?>
