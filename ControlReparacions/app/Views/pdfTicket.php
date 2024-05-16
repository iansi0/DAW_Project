<!DOCTYPE html>
<html>
<head>
    <title>Ticket: <?=$ticket['id']?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">

    <style>
        body {
            /* font-family: monospace; */
            font-family: system-ui;
            /*montserrat para titulos con bold
            lato y popins para textos medium */
        }
    </style>
    <!-- <?php 
        if (session('user')['user']=="admin") {
            $theme ='dark';
        }else{
            $theme ='light';
            
        }
    ?>
    <script>
        ='<?= $theme?>';
        console.log( );
    </script> -->
</head>
<body>
    
<div class="flex gap-16 items-center  text-primario p-3 rounded-lg pl-5 w-full mb-3">
    <h1 class=" text-left text-5xl ml-48"><?= mb_strtoupper(lang('titles.id_ticket'), 'utf-8'); ?>: <?= explode("-", $ticket['id'])[4] ?></h1>
</div>

<main style="view-transition-name: info<?= $ticket['id'] ?>;" class="flex gap-7 py-1 ">

<section class="flex flex-col gap-2">


    

    <div class=" text-secundario min-w-72 max-w-80 rounded-t-lg overflow-hidden">
        <h3 class="bg-primario text-lg p-3"> <?= lang('forms.info'); ?> </h3>
        <p class="bg-terciario-2 p-2 text-terciario-1 overflow-auto"><i class="fa-solid fa-hashtag"></i> : <span class="text-sm"><?= $ticket['id'] ?></span></p>
        <p class="bg-terciario-2 p-2 text-terciario-1 overflow-auto"><i class="fa-solid fa-envelope"></i> : <span class="text-sm"><?= $ticket['correu_contacte'] ?></span></p>
    </div>


    <div class=" text-secundario min-w-64 max-w-72  rounded-t-lg overflow-hidden">
        <h3 class="bg-primario text-lg p-3"><?= lang('forms.description'); ?></h3>
        <p class="bg-terciario-2 p-3 text-terciario-1  min-h-auto max-h-32 overflow-y-auto break-words"><?= $ticket['descripcio'] ?></p>
    </div>

</section>

<article class="flex flex-col gap-2 w-full">

    <div class="flex justify-between gap-4">
   

    </div>

    <div>
        <div class="flex justify-between bg-primario text-secundario text-left p-3 pr-8 text-3xl rounded-t-2xl">
            <h1><?= lang('titles.int'); ?></h1>
            

        </div>

        <?php
        echo $table->generate();
        ?>
    </div>

</article>
</main>
</body>
</html>
