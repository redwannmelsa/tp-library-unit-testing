<?php

namespace App\Model;
use App\Model\classes\Livre;
use App\Model\classes\Emprunt;
use App\Model\BookModel;
use App\Model\AdherentModel;

class EmpruntModel {

    private $bookModel;
    private $adherentModel;

    public function __construct(){
        if (!isset($_SESSION['livres'])) {
            $_SESSION['livres'] = [];
        }
        $this->bookModel = new BookModel();
        $this->adherentModel = new AdherentModel();
    }

    public function getEmprunts() {
        $emprunts = [];
        foreach($_SESSION['livres'] as $l){
            
            if(isset($l['adherentId']) && $l['adherentId'] !== null){
                $livre = $this->bookModel->getBookByIsbn($l['isbn']);
                $livre->setDateEmprunt($l['dateEmprunt']);
                $livre->setDateRetourPrevu($l['dateRetourPrevu']);
                $adherent = $this->adherentModel->getAdherentById($l['adherentId']);
                $emprunts[] = new Emprunt($adherent, $livre, $l['dateEmprunt'], $l['dateRetourPrevu']);                
            }
        }
        return $emprunts;
    }

    public function createEmprunt($adherentId, $livreIsbn, $dateEmprunt, $dateRetourPrevu){
        foreach($_SESSION['livres'] as $index => $livre){
            if($livre['isbn'] == $livreIsbn){
                $_SESSION['livres'][$index]['adherentId'] = $adherentId;
                $_SESSION['livres'][$index]['dateEmprunt'] = $dateEmprunt;
                $_SESSION['livres'][$index]['dateRetourPrevu'] = $dateRetourPrevu;
            }
        }
    }

    public function removeEmprunt($isbn){
        foreach($_SESSION['livres'] as $index => $livre){
            if($livre['isbn'] == $isbn){
                $_SESSION['livres'][$index]['adherentId'] = null;
                $_SESSION['livres'][$index]['dateEmprunt'] = null;
                $_SESSION['livres'][$index]['dateRetourPrevu'] = null;
            }
        }
    }

}