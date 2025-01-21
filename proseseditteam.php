<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

require_once "class/team.php";

if (isset($_POST['submit'])) {
    $idteam = $_POST['idteam'];
    $name = $_POST['name'];
    $idgame = $_POST['idgame'];

    $team = new Team();
    $affectedRows = $team->updateTeam($idteam, $idgame, $name);

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        
        if ($imageFileType == "jpg" && $_FILES["image"]["size"] <= 5000000) {
            $targetFile = "uploads/team_images/" . $idteam . ".jpg";
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
        }
    }

    header("Location: team.php?edit=" . $affectedRows);
    exit();
}

header("Location: team.php");
exit();
