<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access denided!</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.js"></script> -->
    <style>
        body {
            background-color: #111116;
        }

        .center {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translateX(-50%) translateY(-50%);
        }

        .circle {
            display: inline-block;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin: 0 4px;
        }

        .circle-1 {
            border: 4px solid #fc1460;
        }

        .circle-2 {
            border: 4px solid #5a87ff;
        }

        .circle-3 {
            border: 4px solid #18fd91;
        }

        .circle-4 {
            border: 4px solid #fbf38c;
        }
        .text{
            color: #fc1460;
            font-size: x-large;
            font-weight: bold;
            margin-bottom: 250px;
        }
    </style>

   
</head>

<body>

    <div class='center'>
        <div class='loader'>
        <div class="text">Acess Denided!</div>
            <div class='circle circle-1'></div>
            <div class='circle circle-2'></div>
            <div class='circle circle-3'></div>
            <div class='circle circle-4'></div>
          
        </div>
    </div>

    <script>
        var circle1 = anime({
            targets: ['.circle-1'],
            translateY: -24,
            translateX: 52,
            direction: 'alternate',
            loop: true,
            elasticity: 400,
            easing: 'easeInOutElastic',
            duration: 1600,
            delay: 800,
        });

        var circle2 = anime({
            targets: ['.circle-2'],
            translateY: 24,
            direction: 'alternate',
            loop: true,
            elasticity: 400,
            easing: 'easeInOutElastic',
            duration: 1600,
            delay: 800,
        });

        var circle3 = anime({
            targets: ['.circle-3'],
            translateY: -24,
            direction: 'alternate',
            loop: true,
            elasticity: 400,
            easing: 'easeInOutElastic',
            duration: 1600,
            delay: 800,
        });

        var circle4 = anime({
            targets: ['.circle-4'],
            translateY: 24,
            translateX: -52,
            direction: 'alternate',
            loop: true,
            elasticity: 400,
            easing: 'easeInOutElastic',
            duration: 1600,
            delay: 800,
        });


        setTimeout(function (){
            window.location = "login.php"
        },3000)
    </script>




</body>

</html>