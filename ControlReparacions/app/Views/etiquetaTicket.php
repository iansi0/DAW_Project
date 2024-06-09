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
            padding: 10px 30px 10px 30px;
        }

        .bold {
            font-weight: 100;
        }

        div {
            /* position: absolute; */
            margin-top: 50px;
            width: 393.7px;
            height: 280.6px;
        }

        h2 {
            /* position: absolute; */
            padding: 2px 8px;
        }

        img {}
    </style>
</head>

<body>

<table>
    <?php
    // Assuming you have an array of tickets named $tickets
    // Each ticket has an 'id' and 'qr' property

    for ($i = 0; $i < count($tickets['id']); $i++) { // Loop for 3 rows
        echo " <tr>"; // Start a row

        for ($j = 0; $j < 2; $j++) { // Loop for 2 columns
            $ticketIndex = $i * 2 + $j; // Calculate ticket index
            if (isset($tickets['id'][$ticketIndex])) { // Check if ticket exists
                echo "<td >"; // Start a column
                echo  $tickets['id'][$ticketIndex]; // Display ticket ID
                echo "<img style='width: 280px;' src='data:image/png;base64," . $tickets['qr'][$ticketIndex] . "' alt='Ticket QR Code'>"; // Display ticket QR code
                echo "</td>"; // End a column
            }
        }

        echo "</tr>"; // End a row
    }
    ?>
    </table>

</body>

</html>