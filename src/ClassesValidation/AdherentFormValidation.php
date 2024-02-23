<?php

namespace App\ClassesValidation;

class AdherentFormValidation {
    public static function checkName(string $name): bool {
        // Vérifie si le nom contient uniquement des lettres, des espaces ou des tirets
        return preg_match('/^[a-zA-Z\s-]+$/', $name) === 1;
    }

    public static function checkDate(string $date): bool {
        // Vérifie si la date est au format YYYY-MM-DD
        return preg_match('/^\d{4}-\d{2}-\d{2}$/', $date) === 1 && date_create_from_format('Y-m-d', $date) !== false;
    }
}