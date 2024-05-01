<?php
include "connect.php";
header('Content-Type: application/json; charset=utf-8');

$stm = $connect->prepare("SELECT team_players.team_id,teams.name FROM team_players,teams WHERE team_players.team_id = teams.id and team_players.player_id = ?");
$stm->execute(array(13));
$playerTeams = $stm->fetchAll(PDO::FETCH_ASSOC); //[0]=>['id']['name']
$isValed = $stm->rowCount();
$teamsResrvationsData = array();
if ($isValed > 0) {
    //echo json_encode(array("teams" => $playerTeams));
    for ($i = 0; $i < $isValed; $i++) {
        $teamID = $playerTeams[$i]['team_id'];
        $stm = $connect->prepare("SELECT reservation_team.reservation_id,reservations.start_datetime,reservations.end_datetime FROM reservation_team,reservations WHERE reservation_team.reservation_id = reservations.id AND reservation_team.team_id = ?");
        $stm->execute(array($teamID));
        $teamResrvations = $stm->fetchAll(PDO::FETCH_ASSOC);
        $resrvationsCount = $stm->rowCount();
        if ($resrvationsCount > 0) {
            for ($j = 0; $j < $resrvationsCount; $j++) {
                $resrvationID = $teamResrvations[$j]['reservation_id'];
                $stm = $connect->prepare("SELECT reservation_stadium.stadium_id,stadium.name,stadium.stadium_type,sport_types.sport_type FROM `reservation_stadium`,stadium,sport_types WHERE reservation_stadium.stadium_id = stadium.id and stadium.sport_type_id = sport_types.id AND reservation_stadium.reservation_id = ?");
                $stm->execute(array($resrvationID));
                $reservationStadium = $stm->fetch(PDO::FETCH_ASSOC);
                $stadiumID = $reservationStadium['stadium_id'];
                $teamResrvations[$j]['sport'] = $reservationStadium['sport_type'];
                $teamResrvations[$j]['stadium_id'] = $reservationStadium['stadium_id'];
                $teamResrvations[$j]['stadium_name'] = $reservationStadium['name'];
                $teamResrvations[$j]['stadium_type'] = $reservationStadium['stadium_type'];
                //get clube info
                $stm = $connect->prepare("SELECT club_stadium.club_id,clubs.name FROM clubs,club_stadium WHERE club_stadium.club_id = clubs.id and club_stadium.stadium_id = ?");
                $stm->execute(array($stadiumID));
                $reservationClube = $stm->fetch(PDO::FETCH_ASSOC);
                $teamResrvations[$j]['club_id'] = $reservationClube['club_id'];
                $teamResrvations[$j]['club_name'] = $reservationClube['name'];
                $teamResrvations[$j]['from'] = "my_teams";
                $teamResrvations[$j]['team_name'] = $playerTeams[$i]['name'];
            }
            $teamsResrvationsData = array_merge($teamsResrvationsData,$teamResrvations);
        }
    }
    //echo json_encode(array("data" => $teamsResrvationsData));
}
