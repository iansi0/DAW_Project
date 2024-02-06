
<!DOCTYPE html>
<html lang="ca" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/styles.css">
    <title>IKS</title>
</head>

<body class=" flex h-full">

    <nav id="Sidebar" class="bg-terciario-3 flex flex-col gap-10 py-20 w-20  text-5xl h-full ">
        <a href="#" class=" w-20 overflow-hidden  transition-all ease-in duration-500   hover:w-60  hover:bg-primario hover:text-white hover:z-10"><?=strtoupper(lang('master.students'))?></a>


        <a href="#" class=" w-20   h-20 overflow-hidden flex items-center  transition-all ease-in duration-500   hover:w-60  hover:bg-primario hover:text-white hover:z-10">
            <!-- Imagen ticket
            <img src="/assets/img/navbar/ticketRojo.png" alt="ticket" class="w-20 h-20">-->
            <?=strtoupper(lang('master.tickets'))?></a>


        <a href="#" class=" w-20 overflow-hidden  transition-all ease-in duration-500   hover:w-60  hover:bg-primario hover:text-white hover:z-10"><?=strtoupper(lang('master.assign'))?></a>
    </nav>


    <main id="tickets" class="w-full  text-center  justify-items-center items-center">

        <header class=" bg-primario text-white h-16 flex items-center relative justify-center   ">
            <img src="/assets/img/logo.png" alt="Logo">
            <h1 class=" absolute right-0 mr-5">Nom Exemple</h1>
        </header>

        <article class="p-5">
            <?= $this->renderSection('content') ?>
        </article>
    </main>
</body>

</html>