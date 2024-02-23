<?php
namespace App\Controller;

use App\Controller\ParentController;

class AccueilController extends ParentController{

    public function accueilAction(){
        $this->render('accueil-view');
    }

}