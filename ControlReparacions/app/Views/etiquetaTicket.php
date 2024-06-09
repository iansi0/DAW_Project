<!DOCTYPE html>
<html>
<head>
    <title>Etiquetes</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">

    <style>
        body {
            /* font-family: monospace; */
            font-family: system-ui, Arial, Helvetica;
            /*montserrat para titulos con bold
            lato y popins para textos medium */
        }

        .bold{
            font-weight: 700;
        }
    </style>
</head>
<body>
<?php
// dd($tickets);
?>
<div style="padding: 10px 30px 10px 30px;">
<?php for ($i=0; $i < count($tickets['id']); $i++) { 
        echo '<div style="position: relative; margin-top: 50px; width: 393.7px; height: 280.6px;">';
        echo '<h2 style="position: absolute; padding: 2px 8px;">'.$tickets['id'][$i].'</h2>';
        echo '<img src="data:image/png;base64,'. $tickets['qr'][$i] .'"/>';
        echo '</div>';
        echo '';
    }?>
    
</div>
</body>
</html>
