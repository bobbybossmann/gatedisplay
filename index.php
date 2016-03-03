<?php
    $base_url = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER["REQUEST_URI"] . '?') . '/' ;
    
    // Die Uhrzeit
    $timestamp = time();
    $uhrzeit = date("H:i",$timestamp);    
    
    // Für die Boarding Anzeige
    $boarding = true;
    
    // XML Lesen
    
    
    //$fluege = $base_url . 'cInc/flights.xml';
    //require $base_url . 'cInc/flights.xml';
    $xmlFile = 'cInc/flights.xml';
    
    if (file_exists($xmlFile)){
        $xml = simplexml_load_file ($xmlFile);
        
        foreach ($xml -> flug as $flug){
            $flugnummer = $flug->IATA . $flug->Flugnummer ;
            $destination = $flug->Destination ;
            $abflugzeit = $flug->Abflugzeit;
        }
        foreach ($xml -> status as $status){
            $statusBoarding = $status -> Boarding;
            $closed = $status -> Closed;
            $lastcall = $status -> Lastcall;
        }
    } else {
        echo 'Die XML Datei kann nicht geladen werden!' ;
    }
    
    
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>Gate Display by Marco Boßmann</title>
        <link rel="stylesheet" href="style.css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script type="text/javascript" src="cInc/core.js"></script>
    </head>

    <body>
    
        <div id="content">
            <div class="header clear">
                <div class="left logo">
                    <img src="img/logo.png" alt="Logo"/>
                </div>
                <div class="center">
                    <h1>Gate 08</h1>
                </div>
                <div class="right">
                <?php  echo $uhrzeit;?>
                </div>    
            </div>
            <div class="content-inner">
                <div class="airline">
                    <p>Operated by:</p>
                    <img src="img/Logo_airberlin.svg.png" alt="Airline Logo"/>    
                </div>
                <div class="flight">
                    <h1><?php echo $flugnummer ; ?></h1>    
                    <h3><?php echo $abflugzeit ; ?></h3>
                    <div class="destination">
                        <h1><?php echo $destination ; ?></h1>
                    </div>
                    <div class="boarding">
                    <?php
                        
                        if ($boarding == true){
                            echo '<img src="img/boarding.gif" alt="Boarding"/>';    
                        }
                        else {
                            echo '<img src="img/blankstatus.png" alt="No Boarding"/>';
                        }
                    ?>
                    </div>
                </div>
                
            </div>
            <div class="footer">
                <marquee>Lorem ipsum dolor sit amet. +++ Lorem ipsum dolor sit amet. +++ Lorem ipsum dolor sit amet. +++ Lorem ipsum dolor sit amet. +++ Lorem ipsum dolor sit amet. +++ Lorem ipsum dolor sit amet. +++ Lorem ipsum dolor sit amet. +++ </marquee>
            </div>
        </div>
        
    </body>

</html>