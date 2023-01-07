<?php
if (!isset($access_php)) {
    require './access.php';
}
if (Access::student()) {
    Access::setupEmailPassword();
    $email = Access::$email;
    $g_rs = Database::search("SELECT * FROM student WHERE email = '".$email."'");
    $g_d = $g_rs->fetch_assoc();
    $grade = $g_d['grade_g_id'];
    $rs = Database::search("SELECT * FROM s_fees WHERE student_email = '".$email."' AND grade_g_id = '".$grade."'");
    $d = $rs -> fetch_assoc();

    if ($d['isPay'] == "0"){
        ?>

        


    <div class="container">
        <h1 id="headline">Your Trial pereod is End in</h1>
        <div id="countdown">
            <ul>
                <li><span id="days"></span>days</li>
                <li><span id="hours"></span>Hours</li>
                <li><span id="minutes"></span>Minutes</li>
                <li><span id="seconds"></span>Seconds</li>
            </ul>
        </div>
        <div id="content" class="emoji">
            <span>🥳</span>
            <span>🎉</span>
            <span>🎂</span>
        </div>

        <div class="row">
            <div class="col-12">
            <button type="submit" id="payhere-payment" onclick="PayNow()" class="btn btn-success">Pay Now</button>

            </div>
        </div>
    </div>

    <style>
        /* general styling */
        :root {
            --smaller: .75;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            align-items: center;
            background-color: #ffd54f;
            display: flex;
            font-family: -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Oxygen-Sans,
                Ubuntu,
                Cantarell,
                "Helvetica Neue",
                sans-serif;
        }

        .container {
            color: #333;
            margin: 0 auto;
            text-align: center;
        }

        h1 {
            font-weight: normal;
            letter-spacing: .125rem;
            text-transform: uppercase;
        }

        li {
            display: inline-block;
            font-size: 1.5em;
            list-style-type: none;
            padding: 1em;
            text-transform: uppercase;
        }

        li span {
            display: block;
            font-size: 4.5rem;
        }

        .emoji {
            display: none;
            padding: 1rem;
        }

        .emoji span {
            font-size: 4rem;
            padding: 0 .5rem;
        }

        @media all and (max-width: 768px) {
            h1 {
                font-size: calc(1.5rem * var(--smaller));
            }

            li {
                font-size: calc(1.125rem * var(--smaller));
            }

            li span {
                font-size: calc(3.375rem * var(--smaller));
            }
        }
    </style>

    <?php 
    
    ?>

    <script>
        (function() {
            const second = 1000,
                minute = second * 60,
                hour = minute * 60,
                day = hour * 24;

            //I'm adding this section so I don't have to keep updating this pen every year :-)
            //remove this if you don't need it
            let today = new Date(),
                dd = String(today.getDate()).padStart(2, "0"),
                mm = String(today.getMonth() + 1).padStart(2, "0"),
                yyyy = today.getFullYear(),

                nextYear = yyyy + 1,
                dayMonth = "01/31/",
                birthday = dayMonth + yyyy;

            today = mm + "/" + dd + "/" + yyyy;

            if (today > birthday) {
                birthday = dayMonth + nextYear;
            }
            //end

            const countDown = new Date(birthday).getTime(),
                x = setInterval(function() {

                    const now = new Date().getTime(),
                        distance = countDown - now;

                    document.getElementById("days").innerText = Math.floor(distance / (day)),
                        document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
                        document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
                        document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

                    //do something later when date is reached
                    if (distance < 0) {
                        document.getElementById("headline").innerText = "It's my birthday!";
                        document.getElementById("countdown").style.display = "none";
                        document.getElementById("content").style.display = "block";
                        clearInterval(x);
                    }
                    //seconds
                }, 0)
        }());
    </script>

<?php


    }else{
        ?>
        <div class="col-12" class="img-thumbnail" style="height:250vh; background-image: url(./src/wallpaper.webp);">


        </div>
        <?php
    }


} else {
?>
    <div class="col-12">
        No Access!
    </div>
<?php

}

?>