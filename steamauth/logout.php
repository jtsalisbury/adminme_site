<?php

header("Location: ../");
session_start();
unset($_SESSION['steamid']);
unset($_SESSION['steam_uptodate']);
?>