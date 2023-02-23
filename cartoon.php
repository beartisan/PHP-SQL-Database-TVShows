<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>90s Childhood Cartoon List</title>
    <link href="stylesheet.css" type="text/css" rel="stylesheet">
</head>
<body>
    <header id="header">
        <h1 class="title">90s Baby - Childhood Cartoon List</h1>
        <p class="title"> This is my personal rating for my top cartoon that I watched in my childhood. This includes the years late 1980s to early 2000s. </p>
    </header>

    <main id="main">
    <?php

    $connect = mysqli_connect(
        'sql201.epizy.com', // Host
        'epiz_33365969', // Username
        '8Yd7Cia0B1s', // Password
        'epiz_33365969_cartoondb' // Database name
    );

    if(mysqli_connect_errno()) 
    {
        echo "Error: " . mysqli_connect_error();
        exit();
    }

    $query = 'SELECT *
        FROM cartoon
        ORDER BY rating DESC';
    $result = mysqli_query($connect, $query)
        or die(mysqli_error($connect));

    //container for all shows
    echo '<div class="shows-container">';
        while($record = mysqli_fetch_assoc($result))
        {
            // print_r($record);

            echo '<div class="shows">';
                
                //title of show
                echo '<h2 class="show-title">'.$record['title'].'</h2>';

                //year released
                echo '<h4>Year First Released: </h4> <p>' . ($record['year']) . '</p>';

                //rating
                echo '<div class="rating">';

                    // get the rating value from the $record array
                    $rating = $record['rating']; 
                        echo '<h4>Rating: </h4> <p>' . number_format($rating) . '</p>';

                        // calculate the number of yellow stars to display based on the rating
                        $yellow_stars = round(($rating / 10 * 5)*2);

                        // loop through 10 stars and output a yellow or gray star based on the $num_yellow_stars
                        for ($i = 1; $i <= 10; $i++) {
                            if ($i <= $yellow_stars) 
                            { 
                                //yellow stars = rating
                                echo '<p style="display: inline-block; color: RGB(255, 215, 0);">&#9733;</p>';
                            } 
                            else 
                            {
                                //remainder stars are gray
                                echo '<p style="display: inline-block; color: gray;">&#9733;</p>';
                            }
                        }
                echo '</div>';


                // echo '<div class="photo">';
                    echo '<img src="cartoon-imgs/'.$record['photo'].'" width="300">';
                // echo '</div>';
                
                echo '<h4>Summary: </h4> <p>'.($record['summary']).'</p>';

                
                // echo '<div class="channel">';
                    echo '<h4>Network: </h4> <p>'.($record['network']).'</p>';

                        $channel = $record['network'];
                        if($channel === 'Cartoon Network')
                        {
                            echo '<img src="cartoon-imgs/cn.png" width="100">';
                        }
                        else if($channel === 'Nickelodeon')
                        {
                            echo '<img src="cartoon-imgs/nick.png" width="100">';
                        }
                        else if ($channel === 'Disney' || $channel === 'Disney Channel')
                        {
                            echo '<img src="cartoon-imgs/dc.png" width="100">';
                        } else if ($channel === 'Fox Kids' || $channel === 'Fox Kids Channel')
                        {
                            echo '<img src="cartoon-imgs/fox.png" width="100">';
                        } 
                        else if ($channel === 'TBS')
                        {
                            echo '<img src="cartoon-imgs/tbs.png" width="100">';
                        }
                        else 
                        {
                            echo '<img src="cartoon-imgs/unknown.jpeg" width="100">';
                        }
                // echo '</div>';

                //Verdict
                echo '<h4>My Verdict:  </h4> <p>'.($record['verdict']).'</p>';
                

                //Container for watch now
                echo '<div class="watch">';
                    echo '<h3><a href="'.$record['link'].'">Watch Now</a></h3>';
                echo '</div>';

            echo '</div>';
        }
    echo '</div>';

    ?>
    </main>

    <footer id="footer">
        <h5>Copyright 2023. Beartisan. All photos are found on IMDB and Google.</h5>
    </footer>
</body>
</html>