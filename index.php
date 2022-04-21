

<?php
error_reporting(0);
// https://openweathermap.org/current  --> bilib oling
if (array_key_exists('submit',$_GET)){

    if (!$_GET['city']){
        $error = " Shahar nomini kiriting!..";
    }
    else{
        $error = 0;
    }


    if ($_GET['city']){

        $apiData = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&appid=15196be3d5b891630263e080847db8c4");
        $weatherArray = json_decode($apiData, true );

        if ($weatherArray['cod']==200){

            $temp = $weatherArray['main']['temp']-273;
            $tempCelsius = " <b>  Harorat:  </b> ".intval($temp)."&deg;C";

            $weather = " <b>  Holat:  </b>  ".$weatherArray['weather']['0']['description'];

            $country = " <b>  Joy:  </b>  ".$weatherArray['sys']['country']." ".$weatherArray['name'];

            $press = " <b>  Bosim:  </b>  ".$weatherArray['main']['pressure']." hPa";

            $wind = " <b>  Shamol:  </b>  ".$weatherArray['wind']['speed']." metr/sec ";

            $clouds = " <b>  Bulutli:  </b>  ".$weatherArray['clouds']['all']." % ";

            date_default_timezone_set("Asia/Tashkent");
            $sunrise = $weatherArray['sys']['sunrise'];

            $sun = " <b>  Quyosh Chiqishi:  </b>  ".date(" g:i a", $sunrise);
            $current = " <b>  Joriy Vaqt:  </b>  ".date(" F j, Y, g:i a");

        }
        else{
            $error = " Shahar nomi noto‘g‘ri! ";
        }
    }

}



?>


<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <title> Global weather </title>

        <style>
            body{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                background-image: url("1369012.jpg");
                background-repeat: no-repeat;
                background-size: cover;
                font-family: poppin, 'Times New Roman', Times, Serif ;
                font-size: large;
                color: white;
                background-attachment: fixed ;
            }
            form{
                background-color: rgba(77, 76, 76, 0.69);
                border-radius: 10px;
            }
            .container{
                text-align: center;
                justify-content: center;
                align-items: center;
                width: 440px;
            }
            h1{
                font-weight: 700;
                margin-top: 150px;

            }
            input{
                width: 350px;
                padding: 5px;
            }

        </style>

    </head>

    <body>

        <div class="container">

        <form action="" method="get">
            <h1> Global ob-havo  </h1>

            <p><label for="city">Shaxaringiz Nomini kiriting!.. </label></p>
            <p><input type="text" name="city" id="city" placeholder="Shahar nomi.."></p>
            <button type="submit" name="submit" class="btn btn-success"> Kiritish </button>

            <br><br>


            <div class="output mt-3">

                <?php

                if ($weather){
                    echo '<div class="alert alert-success" role="alert" >'
                            .$country.'<br>'
                            .$weather.'<br>'
                            .$tempCelsius.'<br>'
                            .$clouds.'<br>'
                            .$press.'<br>'
                            .$wind.'<br>'
                            .$sun.'<br>'
                            .$current.'<br>'

                        .'</div>';
                }

                if($error)

                    echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                ?>
            </div>

        </form>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </body>

</html>
