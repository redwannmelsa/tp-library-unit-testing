<?php

namespace App\ClassesValidation;

class BookFormValidation {
    public static function checkAuthor(string $author): bool {
        // Vérifie si l'auteur contient uniquement des lettres, des espaces ou des tirets
        return preg_match('/^[a-zA-Z\s-]+$/', $author) === 1;
    }

    public static function checkISBN(string $isbn): bool {
        // Vérifie si l'ISBN a 10 ou 13 chiffres et peut contenir des tirets
        return preg_match('/^(?:ISBN(?:-13)?:? )?(?=[0-9X]{10}$|(?=(?:[0-9]+[- ]){3})[- 0-9X]{13}$|97[89][0-9]{10}$|(?=(?:[0-9]+[- ]){4})[- 0-9]{17}$)(?:97[89][- ]?)?[0-9]{1,5}[- ]?[0-9]+[- ]?[0-9]+[- ]?[0-9X]$/', $isbn) === 1;
    }

    public static function checkNbPage($nbPages): bool {
        // Vérifie si le nombre de pages est un entier entre 10 et 10000
        return is_numeric($nbPages) && $nbPages >= 10 && $nbPages <= 10000;
    }
}