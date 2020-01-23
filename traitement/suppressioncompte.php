<?php

    $sql = "DELETE FROM utilisateurs WHERE id=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_SESSION['id']));

    header("Location:index.php?action=deconnexion");

?>