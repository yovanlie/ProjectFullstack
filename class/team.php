<?php
require_once("parent.php");

class Team extends ParentClass
{
    public function displayTeams($page = 1, $itemsPerPage = 5)
    {
        $offset = ($page - 1) * $itemsPerPage;
        $sql = "SELECT t.*, g.name as game_name FROM team t JOIN game g ON t.idgame = g.idgame LIMIT ? OFFSET ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('ii', $itemsPerPage, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        $output = "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Game</th>
                        <th>Actions</th>
                    </tr>";

        while ($row = $result->fetch_assoc()) {
            $output .= "<tr>
                            <td>{$row['idteam']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['game_name']}</td>
                            <td>
                                <a href='editteam.php?id={$row['idteam']}'>Edit</a> |
                                <a href='deleteteam.php?id={$row['idteam']}'>Delete</a>
                            </td>
                        </tr>";
        }

        $output .= "</table>";

        // Add pagination links
        $totalTeams = $this->getTotalTeams();
        $totalPages = ceil($totalTeams / $itemsPerPage);
        $output .= "<div class='pagination'>";
        for ($i = 1; $i <= $totalPages; $i++) {
            $output .= "<a href='?page=$i'>$i</a> ";
        }
        $output .= "</div>";

        return $output;
    }
    public function insertTeam($name, $game)
    {
        $sql = "INSERT INTO team (idgame, name) VALUES (?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('is', $game, $name);
        $stmt->execute();

        $affectedRows = $stmt->affected_rows;
        $stmt->close();

        return $affectedRows;
    }
    public function getGames()
    {
        $sql = "SELECT * FROM game";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();

        $games = [];
        while ($game = $res->fetch_assoc()) {
            $games[] = $game;
        }
        $stmt->close();

        return $games;
    }
    public function deleteTeam($idteam)
    {
        $this->mysqli->begin_transaction();

        try {
            // Delete related records in join_proposal table
            $sql = "DELETE FROM join_proposal WHERE idteam = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param('i', $idteam);
            $stmt->execute();

            // Delete related records in team_members table
            $sql = "DELETE FROM team_members WHERE idteam = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param('i', $idteam);
            $stmt->execute();

            // Delete the team
            $sql = "DELETE FROM team WHERE idteam = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param('i', $idteam);
            $stmt->execute();

            $affectedRows = $stmt->affected_rows;

            // Reset AUTO_INCREMENT
            $this->resetAutoIncrement();

            $this->mysqli->commit();
            return $affectedRows;
        } catch (Exception $e) {
            $this->mysqli->rollback();
            return 0;
        }
    }
    public function updateTeam($idteam, $idgame, $name)
    {
        $sql = "UPDATE team SET idgame = ?, name = ? WHERE idteam = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('isi', $idgame, $name, $idteam);
        $stmt->execute();

        $affectedRows = $stmt->affected_rows;
        $stmt->close();

        return $affectedRows;
    }
    public function getAllTeams() {
        $sql = "SELECT t.*, g.name as game_name FROM team t JOIN game g ON t.idgame = g.idgame";
        $result = $this->mysqli->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getTotalTeams()
    {
        $sql = "SELECT COUNT(*) as total FROM team";
        $result = $this->mysqli->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    public function getTeams($page, $itemsPerPage)
    {
        $offset = ($page - 1) * $itemsPerPage;
        $sql = "SELECT t.*, g.name AS game_name 
                FROM team t
                JOIN game g ON t.idgame = g.idgame
                ORDER BY t.name
                LIMIT ? OFFSET ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('ii', $itemsPerPage, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getTeamById($teamId) {
        $sql = "SELECT * FROM team WHERE idteam = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('i', $teamId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Ensure this returns an associative array
    }
    
    private function resetAutoIncrement()
    {
        $tables = ['team', 'join_proposal', 'team_members'];

        foreach ($tables as $table) {
            $sql = "ALTER TABLE $table AUTO_INCREMENT = 1";
            $this->mysqli->query($sql);
        }
    }
    public function getTeamMembers($teamId, $page = 1, $itemsPerPage = 5)
    {
        $offset = ($page - 1) * $itemsPerPage;
        $sql = "SELECT m.username 
                FROM member m 
                JOIN team_members tm ON m.idmember = tm.idmember 
                WHERE tm.idteam = ? 
                LIMIT ? OFFSET ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('iii', $teamId, $itemsPerPage, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getTotalTeamMembers($teamId)
    {
        $sql = "SELECT COUNT(*) as count 
                FROM team_members 
                WHERE idteam = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('i', $teamId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    public function getMemberTeams($memberId)
    {
        $sql = "SELECT t.*, g.name as game_name 
                FROM team t 
                JOIN team_members tm ON t.idteam = tm.idteam 
                JOIN game g ON t.idgame = g.idgame 
                WHERE tm.idmember = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('i', $memberId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getLastInsertId()
    {
        return $this->mysqli->insert_id;
    }
    
}
