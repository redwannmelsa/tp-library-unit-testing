<?php

namespace App\Controller;
use App\Controller\ParentController;
use App\Model\AdherentModel;
use App\ClassesValidation\AdherentFormValidation;

class AdherentController extends ParentController {

    private $model;

    public function __construct(){
        $this->model = new AdherentModel();
    }

    public function adherentListAction(){
        $adherents = $this->model->getAdherents();
        $this->render('adherent-list-view', [
            'adherents' => $adherents
        ]);
    }

    public function formAddAdherentAction(){
        $this->render('form-add-adherent-view');
    }

    public function addAdherentAction(){

        if(AdherentFormValidation::checkName($_POST['nom']) && AdherentFormValidation::checkName($_POST['prenom']) && AdherentFormValidation::checkDate($_POST['dateInscription'])){
            $this->model->addAdherent($_POST['nom'], $_POST['prenom'], $_POST['dateInscription']);
        }
        header("Location: adherent-list");
    }

    public function removeAdherentAction(){
        $this->model->removeAdherent($_GET['adherentId']);
        header("Location: ".host."adherent-list");
    }

}