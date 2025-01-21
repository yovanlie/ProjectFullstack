<?php
require_once "class/team.php"; // Ensure you include the Team class

$teamObj = new Team(); // Create an instance of the Team class
$teams = $teamObj->getAllTeams(); // Fetch all teams

// Check if the teams were fetched successfully
if ($teams === null) {
    $teams = []; // Initialize as an empty array if null
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esports Management System - Home</title>
    <link rel="stylesheet" href="css/style1.css">
    <style>
        body {
            background-image: url('https://portalberita.stekom.ac.id/assets/images/berita/esport-harus-jadi-ukm-kampus.jpg'); /* Replace with the actual link */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #ffffff;
            margin: 0;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Club Informatics Esports</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <aside class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="team.php">Teams</a></li>
                <li><a href="event.php">Events</a></li>
                <li><a href="achievement.php">Achievements</a></li>
                <li><a href="myteam.php">My Team</a></li>
            </ul>
        </aside>

        <main>
            <h2>Teams</h2>
            <ul>
                <?php foreach ($teams as $team): ?>
                    <li>
                        <a href="team_detail.php?id=<?php echo $team['idteam']; ?>">
                            <div>
                                <?php if (file_exists("uploads/team_images/" . $team['idteam'] . ".jpg")): ?>
                                    <img src="uploads/team_images/<?php echo $team['idteam']; ?>.jpg"
                                        alt="Team <?php echo htmlspecialchars($team['name']); ?>"
                                        style="max-width: 100px; height: auto;">
                                <?php else: ?>
                                    <span>No image</span>
                                <?php endif; ?>
                            </div>
                            <div>
                                <?php echo htmlspecialchars($team['name']); ?> - Game: <?php echo isset($team['game_name']) ? htmlspecialchars($team['game_name']) : 'N/A'; ?>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </main>
    </div>

    <footer>
        <p>&copy; 2024 Club Informatics Esports</p>
    </footer>
</body>
</html>
