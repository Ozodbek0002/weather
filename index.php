
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
            $tempCelsius = " <b>  </b> ".intval($temp)."&deg;C";

            $weather = " <b>   </b>  ".$weatherArray['weather']['0']['description'];

            $country = " <b>   </b>  ".$weatherArray['sys']['country']." ".$weatherArray['name'];

            $press = " <b>   </b>  ".$weatherArray['main']['pressure']." hPa";

            $wind = " <b>   </b>  ".$weatherArray['wind']['speed']." metr/sec ";

            $clouds = " <b>  </b>  ".$weatherArray['clouds']['all']." % ";

            date_default_timezone_set("Asia/Tashkent");
            $sunrise = $weatherArray['sys']['sunrise'];

            $sun = " <b>  </b>  ".date(" g:i a", $sunrise);
            $current = " <b>    </b>  ".date(" F j, Y, g:i a");

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
                /*width: 440px;*/
            }
            h1{
                font-weight: 700;
                margin-top: 150px;

            }
            input{
                width: 300px;
                padding: 5px;
            }


        </style>

    </head>

    <body>

        <div class="container " style="max-width: 450px;">

        <form action="" method="get">
            <h1> Global ob-havo  </h1>

            <p><label for="city">Shaxaringiz Nomini kiriting!.. </label></p>
            <p><input type="text" name="city" id="city" placeholder="Shahar nomi.."></p>
            <button type="submit" name="submit" class="btn btn-success"> Kiritish </button>

            <br><br>


            <div class="output mt-3">


                <?php

                if ($weather){
                    ?>
                    <div class="alert alert-success" role="alert" style="height: 300px;" >
                        <table class="text-center  " style=" ">
                            <tr class="" >
                                <th>Joy:</th>
                                <td><?php
                                    echo $country;
                                    ?></td>
                            </tr>
                            <tr>
                                <th>Holat:</th>
                                <td><?php
                                    echo $weather;
                                    ?></td>
                            </tr>
                            <tr>
                                <th>Harorat:</th>
                                <td><?php
                                    echo $tempCelsius;
                                    ?></td>
                            </tr>
                            <tr>
                                <th>Bulutli:</th>
                                <td><?php
                                    echo $clouds;
                                    ?></td>
                            </tr>
                            <tr>
                                <th>Bosim:</th>
                                <td><?php
                                    echo $press;
                                    ?></td>
                            </tr>
                            <tr>
                                <th>Shamol:</th>
                                <td><?php
                                    echo $wind;
                                    ?></td>
                            </tr>
                            <tr>
                                <th>Quyosh Chiqishi:</th>
                                <td><?php
                                    echo $sun;
                                    ?></td>
                            </tr>
                            <tr>
                                <th>Joriy vaqt:</th>
                                <td><?php
                                    echo $current;
                                    ?></td>
                            </tr>

                        </table>

                    </div
                    <?php
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
