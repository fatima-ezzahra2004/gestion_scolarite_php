<?php function uploadFile($field, $folder = 'uploads/etudiants') {
    if (empty($_FILES[$field]['name'])) {
        return null;
    }

    $allowed = ['pdf', 'jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        throw new Exception("Format non autorisé pour $field");
    }

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $filename = uniqid($field . '_') . '.' . $ext;
    $path = $folder . '/' . $filename;

    if (!move_uploaded_file($_FILES[$field]['tmp_name'], $path)) {
        throw new Exception("Erreur upload $field");
    }

    return $path;
}?>