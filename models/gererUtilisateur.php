<?php

function getRole($conn, $id_utilisateur)
{
    $sql = "SELECT role.Nom_role
            FROM utilisateur
            INNER JOIN role
            	ON utilisateur.Id_role=role.Id_role
            WHERE Id_utilisateur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_utilisateur);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['Nom_role'];
}

function isTeacher($conn, $id_utilisateur)
{
    $role = getRole($conn, $id_utilisateur);
    return $role === 'Enseignant';
}
