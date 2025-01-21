<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

require_once "class/team.php";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $game = $_POST['game'];

    // Handle image upload
    $uploadOk = true;
    $imageError = "";

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

        // Check if image file is a JPG
        if ($imageFileType != "jpg") {
            $uploadOk = false;
            $imageError = "Only JPG files are allowed.";
        }

        // Check file size (max 5MB)
        if ($_FILES["image"]["size"] > 5000000) {
            $uploadOk = false;
            $imageError = "File is too large. Max size is 5MB.";
        }
    } else {
        $uploadOk = false;
        $imageError = "Image is required.";
    }

    if ($uploadOk) {
        $team = new Team();
        $affectedRows = $team->insertTeam($name, $game);
        if ($affectedRows > 0) {
            $newTeamId = $team->getLastInsertId();
            if ($newTeamId) {
                $targetFile = "uploads/team_images/" . $newTeamId . ".jpg";
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    header("Location: team.php?hasil=1");
                    exit();
                } else {
                    // Delete the team if image upload fails
                    $team->deleteTeam($newTeamId);
                    header("Location: team.php?hasil=0");
                    exit();
                }
            }
        }

        header("Location: team.php?hasil=0");
        exit();
    }

    header("Location: team.php");
    exit();
}
?>