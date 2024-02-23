<?php

namespace App\Model;
use App\Model\classes\Livre;

class BookModel {

    public function __construct(){
        if (!isset($_SESSION['livres'])) {
            $_SESSION['livres'] = [];
        }
    }

    public function getBooks() {
        $livres = array_map(function($livre) {
            return new Livre($livre['titre'], $livre['auteur'], $livre['isbn'], $livre['nombrePages'], $livre['adherentId'] ?? null, $livre['dateEmprunt'] ?? null, $livre['dateRetourPrevu'] ?? null);
        }, $_SESSION['livres']);
        return $livres;
    }

    public function getBookByIsbn($isbn){
        $livre = null;
        foreach($_SESSION['livres'] as $key => $l){
            if($l['isbn'] == $isbn){
                $livre = $l;
            }
        }
        if($livre){
            return new Livre($livre['titre'], $livre['auteur'], $isbn, $livre['nombrePages'], $livre['adherentId'] ?? null, $livre['dateEmprunt'] ?? null, $livre['dateRetourPrevu'] ?? null);
        }
        return [];
    }

    public function addBook($titre, $auteur, $isbn, $nombrePages){
        $_SESSION['livres'][] = [
            'titre' => $titre,
            'auteur' => $auteur,
            'isbn' => $isbn,
            'nombrePages' => $nombrePages
        ];
    }
    
    public function editBook($titre, $auteur, $isbn, $nombrePages){

        foreach($_SESSION['livres'] as $key => $livre){
            if($isbn == $livre['isbn']){
                $_SESSION['livres'][$key] = [
                    'titre' => $titre,
                    'auteur' => $auteur,
                    'isbn' => $isbn,
                    'nombrePages' => $nombrePages
                ];
            }
        }
         
    }

    public function removeBook($isbn){
        foreach ($_SESSION['livres'] as $index => $livre) {
            if ($livre['isbn'] == $isbn) {
                unset($_SESSION['livres'][$index]);
                $_SESSION['livres'] = array_values($_SESSION['livres']); // Réindexer le tableau
                break;
            }
        }
    }

}