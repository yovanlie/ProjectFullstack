<?php
require_once "class/team.php"; // Ensure you include the Team class

// Check if 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $teamId = $_GET['id'];

    $teamObj = new Team(); // Create an instance of the Team class
    $team = $teamObj->getTeamById($teamId); // Fetch the team details by ID

    // If no team was found, show an error message
    if ($team === null) {
        echo "<p>Team not found!</p>";
        exit;
    }
} else {
    echo "<p>No team ID provided!</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Detail - <?php echo htmlspecialchars($team['name']); ?></title>
    <link rel="stylesheet" href="css/style1.css">
    <style>
        .team-details {
            margin: 20px 0;
            background-color: rgba(58, 5, 105, 0.8);
            /* Transparent background */
            border-radius: 10px;
            padding: 20px;
            color: #ffffff;
        }

        .team-details img {
            max-width: 200px;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .players-list {
            margin-top: 20px;
        }

        .players-list ul {
            list-style: none;
            padding: 0;
        }

        .players-list ul li {
            background-color: rgba(42, 2, 72, 0.9);
            /* Dark transparent background */
            border-radius: 8px;
            margin-bottom: 10px;
            padding: 10px;
        }

        .players-list ul li a {
            color: #ffffff;
            text-decoration: none;
        }

        .players-list ul li a:hover {
            color: #ff007f;
        }
    </style>
</head>

<body>
    <header>
        <h1>Team Details - <?php echo htmlspecialchars($team['name']); ?></h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="myteam.php">My Teams</a></li>
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
            <div class="team-details">
                <h2><?php echo htmlspecialchars($team['name']); ?></h2>
                <?php if (file_exists("uploads/team_images/" . $team['idteam'] . ".jpg")): ?>
                    <img src="uploads/team_images/<?php echo $team['idteam']; ?>.jpg"
                        alt="Team <?php echo htmlspecialchars($team['name']); ?>">
                <?php else: ?>
                    <span>No image available</span>
                <?php endif; ?>

                <p><strong>Game:</strong> <?php echo isset($team['game_name']) ? htmlspecialchars($team['game_name']) : 'N/A'; ?></p>
                <p><strong>Team Description:</strong> <?php echo isset($team['description']) ? nl2br(htmlspecialchars($team['description'])) : 'No description available'; ?></p>

                <div class="players-list">
                    <h3>Players</h3>
                    <ul>
                        <?php
                        // Fetch and display the players associated with the team
                        $players = $teamObj->getTeamMembers($teamId);
                        if ($players) {
                            foreach ($players as $player) {
                                if (isset($player['idplayer']) && isset($player['name'])) {
                                    echo "<li><a href='player_detail.php?id={$player['idplayer']}'>" . htmlspecialchars($player['name']) . "</a></li>";
                                } else {
                                    echo "<li>Player information is incomplete.</li>";
                                }
                            }
                        } else {
                            echo "<li>No players listed for this team.</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </main>
    </div>

    <footer>
        <p>&copy; 2024 Club Informatics Esports</p>
    </footer>
</body>

</html>