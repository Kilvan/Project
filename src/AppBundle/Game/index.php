<!DOCTYPE html>
<html>
    <head>
        <link href="Style.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="script.js"></script>
    </head>
    <body>
        <header></header>
        <div class="main">
            <div id="content" class="content">
            </div>
        </div>

        <div class="console">
            <pre>
                <?php
                require_once 'Player.php';
                require_once 'Game.php';

                $players[] = "Kamil";
                $players[] = "Daniel";
                $games[] = new Game($players, 1);

                $players[] = "Marcin";
                $games[] = new Game($players, 2);
                $running = true;

                while($running)
                {
                    $running = false;
                    foreach($games as $game)
                    {
                        if($game->IsRunning())
                        {
                            $game->NextMove();
                            $running = true;
                        }
                    }
                }
                ?>
            </pre>
        </div>
    </body>
</html>