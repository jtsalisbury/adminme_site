<?php
  $skipCheck = true;
  include("../steamauth/mysql.php");

  $sql = "SELECT * FROM `bans` ORDER BY id DESC";
  $res = $link->query($sql);

  $bans = array();

  $dto = new DateTime();
  $currentDT = new DateTime();


  while ($row = $res->fetch_assoc()) {
    $bID = $row["banned_steamid"];
    $bNm = $row["banned_name"];
    $bAt = $dto->setTimestamp($row["banned_timestamp"]);
    $bReas = $row["banned_reason"];
    $bLen  = $row["banned_time"];

    $bannerID = $row["banner_steamid"];
    $bannerNam = $row["banner_name"];

    $dio = new DateInterval("PT". $bLen. "S");

    $bannedAt = $dto->format("m/d/Y h:i:s");
    $unbannedAt = $dto->add($dio)->format("m/d/Y h:i:s");

    $active = $currentDT >= $dto ? "No" : "Yes";

    $bans[] = array(
      "bName" => $bNm . " (". $bID .")",
      "bAt" => $bannedAt,
      "bReason" => $bReas,
      "bUnAt" => $unbannedAt,
      "bannerName" => $bannerNam . " (". $bannerID .")",
      "active" => $active,
    );
  }

  echo json_encode($bans);
?>
