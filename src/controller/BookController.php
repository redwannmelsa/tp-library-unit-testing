<?php

namespace App\Controller;
use App\Controller\ParentController;
use App\Model\BookModel;
use App\ClassesValidation\BookFormValidation;

class BookController extends ParentController{

    private $model;

    public function __construct(){
        $this->model = new BookModel();
    }

    public function bookListAction(){
        $livres = $this->model->getBooks();

        $this->render('book-list-view', [
            'livres' => $livres
        ]);
    }

    public function formAddBookAction(){
        $this->render('form-add-book-view');
    }

    public function formEditBookAction(){

        $this->render('form-edit-book-view', [
            'livreAModifier' => $this->model->getBookByIsbn($_GET['bookIsbn'])
        ]);
    }

    public function addBookAction(){

        if(BookFormValidation::checkAuthor($_POST['auteur']) && BookFormValidation::checkISBN($_POST['isbn']) && BookFormValidation::checkNbPage($_POST['nombrePages'])){
            $this->model->addBook($_POST['titre'], $_POST['auteur'], $_POST['isbn'], $_POST['nombrePages']);
        }
        
        header("Location: book-list");
    }

    public function editBookAction(){

        if(BookFormValidation::checkAuthor($_POST['auteur']) && BookFormValidation::checkISBN($_POST['isbn']) && BookFormValidation::checkNbPage($_POST['nombrePages'])){
            $this->model->editBook($_POST['titre'], $_POST['auteur'], $_POST['isbn'], $_POST['nombrePages']);
        }
        
        header("Location: book-list");
    }
    
    public function removeBookAction(){
        $this->model->removeBook($_GET['bookIsbn']);
        header("Location: ".host."book-list");
    }
}