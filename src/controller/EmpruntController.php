<?php

namespace App\Controller;
use App\Controller\ParentController;
use App\Model\EmpruntModel;
use App\Model\AdherentModel;
use App\Model\BookModel;

class EmpruntController extends ParentController{
    private $model;
    private $adherentModel;
    private $livreModel;
    public function __construct(){
        $this->model = new EmpruntModel();
        $this->adherentModel = new AdherentModel();
        $this->livreModel = new BookModel();
    }

    public function empruntListAction(){

        $emprunts = $this->model->getEmprunts();

        $this->render('liste-emprunt-view', [
            'emprunts' => $emprunts
        ]);
    }

    public function formCreateEmpruntAction(){
        $adherents = $this->adherentModel->getAdherents();
        $livres = $this->livreModel->getBooks();

        $this->render('form-create-emprunt-view', [
            'adherents' => $adherents,
            'livres' => $livres
        ]);
    }

    public function createEmpruntAction(){
        $adherentId = $_POST['adherentId'];
        $livreIsbn = $_POST['livreIsbn'];
        $dateEmprunt = date("Y-m-d"); // Date du jour
        $dateRetourPrevu = date("Y-m-d", strtotime("+2 weeks"));
        $this->model->createEmprunt($adherentId, $livreIsbn, $dateEmprunt, $dateRetourPrevu);
        header("Location: emprunt-list");
    }

    public function removeEmpruntAction(){
        $this->model->removeEmprunt($_POST['isbn']);
        header("Location: emprunt-list");
    }

}