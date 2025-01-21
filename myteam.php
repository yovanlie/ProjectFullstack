<?php
session_start();
require_once "class/team.php";
require_once "class/join_proposal.php";
require_once "class/achievement.php";
require_once "class/event.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'member') {
    header("Location: login.php");
    exit();
}

$teamObj = new Team();
$joinProposalObj = new JoinProposal();
$achievementObj = new Achievement();
$eventObj = new Event();

$memberId = $_SESSION['user_id'];

// Get all teams the member belongs to
$memberTeams = $teamObj->getMemberTeams($memberId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Teams</title>
    <link rel="stylesheet" href="css/styleall.css">
</head>

<body>
    <h1>My Teams</h1>

    <?php if (empty($memberTeams)): ?>
        <p>You are not a member of any team yet.</p>
    <?php else: ?>
        <?php foreach ($memberTeams as $team): ?>
            <div class="team-section">
                <h2><?php echo htmlspecialchars($team['name']); ?> (<?php echo htmlspecialchars($team['game_name']); ?>)</h2>

                <?php if (file_exists("uploads/team_images/" . $team['idteam'] . ".jpg")): ?>
                    <div class="team-image">
                        <img src="uploads/team_images/<?php echo $team['idteam']; ?>.jpg"
                            alt="<?php echo htmlspecialchars($team['name']); ?>"
                            style="max-width: 200px; height: auto; margin: 10px 0;">
                    </div>
                <?php endif; ?>

                <h3>Team Members</h3>
                <?php
                $memberPage = isset($_GET['member_page']) ? (int)$_GET['member_page'] : 1;
                $memberItemsPerPage = 1;
                $teamMembers = $teamObj->getTeamMembers($team['idteam'], $memberPage, $memberItemsPerPage);
                $totalMembers = $teamObj->getTotalTeamMembers($team['idteam']);
                $totalMemberPages = ceil($totalMembers / $memberItemsPerPage);
                ?>
                <table border="1">
                    <tr>
                        <th>Username</th>
                    </tr>
                    <?php foreach ($teamMembers as $member): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($member['username']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <?php if ($totalMemberPages > 1): ?>
                    <div class="pagination">
                        <?php for ($i = 1; $i <= $totalMemberPages; $i++): ?>
                            <a href="?team_id=<?php echo $team['idteam']; ?>&member_page=<?php echo $i; ?>"
                                <?php echo ($i === $memberPage) ? 'class="active"' : ''; ?>>
                                <?php echo $i; ?>
                            </a>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>

                <h3>Team Achievements</h3>
                <?php
                $achievementPage = isset($_GET['achievement_page']) ? (int)$_GET['achievement_page'] : 1;
                $achievementItemsPerPage = 2;
                $achievements = $achievementObj->getTeamAchievements($team['idteam'], $achievementPage, $achievementItemsPerPage);
                $totalAchievements = $achievementObj->getTotalTeamAchievements($team['idteam']);
                $totalAchievementPages = ceil($totalAchievements / $achievementItemsPerPage);

                if (!empty($achievements)): ?>
                    <table border="1">
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Description</th>
                        </tr>
                        <?php foreach ($achievements as $achievement): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($achievement['name']); ?></td>
                                <td><?php echo htmlspecialchars($achievement['date']); ?></td>
                                <td><?php echo htmlspecialchars($achievement['description']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                    <?php if ($totalAchievementPages > 1): ?>
                        <div class="pagination">
                            <?php for ($i = 1; $i <= $totalAchievementPages; $i++): ?>
                                <a href="?team_id=<?php echo $team['idteam']; ?>&achievement_page=<?php echo $i; ?>"
                                    <?php echo ($i === $achievementPage) ? 'class="active"' : ''; ?>>
                                    <?php echo $i; ?>
                                </a>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <p>No achievements yet.</p>
                <?php endif; ?>

                <h3>Team Events</h3>
                <?php
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $itemsPerPage = 2;
                $events = $eventObj->getTeamEvents($team['idteam'], $page, $itemsPerPage);
                $totalEvents = $eventObj->getTotalTeamEvents($team['idteam']);
                $totalPages = ceil($totalEvents / $itemsPerPage);

                if (!empty($events)): ?>
                    <table border="1">
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Description</th>
                        </tr>
                        <?php foreach ($events as $event): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($event['name']); ?></td>
                                <td><?php echo htmlspecialchars($event['date']); ?></td>
                                <td><?php echo htmlspecialchars($event['description']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                    <?php if ($totalPages > 1): ?>
                        <div class="pagination">
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <a href="?team_id=<?php echo $team['idteam']; ?>&page=<?php echo $i; ?>"
                                    <?php echo ($i === $page) ? 'class="active"' : ''; ?>>
                                    <?php echo $i; ?>
                                </a>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <p>No events scheduled.</p>
                <?php endif; ?>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>

    <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>

</html>