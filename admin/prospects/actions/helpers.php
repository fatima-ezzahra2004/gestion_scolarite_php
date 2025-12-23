<?php
/* Couleurs des états */
function filtreColor($etat)
{
    return match ($etat) {
        'Nouveau'     => 'border-blue-300 text-blue-600 bg-blue-50',
        'Intéressé'   => 'border-green-300 text-green-600 bg-green-50',
        'Converti'    => 'border-emerald-300 text-emerald-600 bg-emerald-50',
        'Perdu'       => 'border-red-300 text-red-600 bg-red-50',
        default       => 'border-gray-300 text-gray-600 bg-gray-50',
    };
}

/* Initiales (robuste) */
function initiales($nom)
{
    $mots = preg_split('/\s+/', trim($nom));
    $initiales = '';

    foreach ($mots as $mot) {
        $initiales .= strtoupper($mot[0]);
        if (strlen($initiales) === 2) break;
    }

    return $initiales;
}
?>