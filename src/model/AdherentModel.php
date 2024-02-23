<?php

namespace App\Model;
use App\Model\classes\Adherent;

class AdherentModel {

    public function __construct(){
        if (!isset($_SESSION['adherents'])) {
            $_SESSION['adherents'] = [];
        }
    }

    public function getAdherents() {
        $adherents = array_map(function($adherent) {
            return new Adherent($adherent['id'], $adherent['nom'], $adherent['prenom'], $adherent['dateInscription']);
        }, $_SESSION['adherents']);
        return $adherents;
    }

    public function getAdherentById($id){
        $adherent = null;
        foreach($_SESSION['adherents'] as $key => $ad){
            if($ad['id'] == $id){
                $adherent = $ad;
                break;
            }
        }
        if($adherent){
            return new Adherent($adherent['id'], $adherent['nom'], $adherent['prenom'], $adherent['dateInscription']);
        }
        return null;
    }

    public function addAdherent($nom, $prenom, $dateInscription){
        $_SESSION['adherents'][] = [
            'id' => time(),
            'nom' => $nom,
            'prenom' => $prenom,
            'dateInscription' => $dateInscription
        ];
    }

    public function removeAdherent($id){
        foreach ($_SESSION['adherents'] as $index => $adherent) {
            if ($adherent['id'] == $id) {
                unset($_SESSION['adherents'][$index]);
                $_SESSION['adherents'] = array_values($_SESSION['adherents']); // Réindexer le tableau
                break;
            }
        }
    }

}