<?php

require_once __DIR__ . '/../SessionManager.php';

(new SessionManager())->validate_session();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>arrietty.homepage</title>
  <link href="home.css" rel="stylesheet" type="text/css" />
  <script src="script.js" defer></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&display=swap" rel="stylesheet">

</head>

<body>
  <div class="border-one">
    <h1> ARRIETTY </h1>
    <h4 class="est"> EST. 2024 </h4>
    <div class="line"></div>
    <h4 class="contents"> <span>ABOUT</span> </h4>
    <h4 class="contents"> <span>EMBEDS</span> </h4>
    <h4 class="contents"> <span>COMMANDS</span> </h4>
    <h4 class="contents"> <span>WELCOME</span> </h4>
    <h4 class="contents"> <span>ROLES</span> </h4>
    <h4 class="contents"> <span>AUTO</span> </h4>
  </div>
  <div class="border-two">

  </div>
</body>

</html>
