<?php
$session = \Config\Services::session();
// $name = $_SESSION['username'];
$name = 'HOLA';

?>

<!DOCTYPE html>
<html lang="ca" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/styles.css">
    <title>KeepYourSoftware</title>
</head>

<style>
    body {
        font-family: monospace;
        /* font-family: system-ui; */
    }
</style>

<body class=" flex h-full bg-secundario">

    <nav id="Sidebar" class=" bg-terciario-1 flex flex-col gap-9 py-16 w-20 text-primario text-lg  h-full overflow-hidden transition-all ease-in duration-300 hover:w-60">


        <div class=" w-20 h-16  flex items-center text-sm text-secundario ">
            <!-- Imagen ticket-->
            <img src="/assets/img/logo.png" alt="Logo">
            <b>KeepYourSoftware</b>
        </div>

        <a href="<?= base_url('tickets') ?>" class=" w-20 h-16  flex items-center   transition-all ease-in duration-300   hover:w-56  hover:bg-primario hover:text-white hover:z-10">
            <!-- Imagen ticket-->
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="75" height="100" fill="currentColor" class="bi bi-ticket" viewBox="-3 0 24 16">
                    <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z" />
                </svg>
            </p>
            <b>TICKETS</b>
        </a>

        <a href="<?= base_url('students') ?>" class=" w-20  h-16 flex items-center   transition-all ease-in duration-300  hover:w-56  hover:bg-primario hover:text-white">
            <!-- Imagen ticket-->
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="75" height="100" fill="currentColor" viewBox="-160 0 798 512">
                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                </svg>
            </p>
            <b>STUDENTS</b>
        </a>

        <a href="<?= base_url('institutes') ?>" class=" w-20 h-16 flex items-center   transition-all ease-in duration-300   hover:w-56  hover:bg-primario hover:text-white hover:z-10">
            <!-- Imagen ticket-->
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="75" height="100" fill="currentColor" class="bi bi-ticket" viewBox="-3 0 24 16">
                    <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z" />
                </svg>
            </p>
            <b>INSTITUTES</b>
        </a>

        <a href="<?= base_url('assign') ?>" class=" w-20  h-16 flex items-center   transition-all ease-in duration-300  hover:w-56  hover:bg-primario hover:text-white">
            <!-- Imagen ticket-->
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="75" height="100" fill="currentColor" viewBox="-160 0 798 512">
                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                </svg>
            </p>
            <b>ASSIGN</b>
        </a>

        <a href="<?= base_url('Inventari') ?>" class=" w-20  h-16 flex items-center  transition-all ease-in duration-300  hover:w-56  hover:bg-primario hover:text-white">
            <!-- Imagen ticket-->
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="75" height="100" fill="currentColor" viewBox="-160 0 798 512">
                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                </svg>
            </p>
            <b>Inventari</b>
        </a>

        <a href="<?= base_url('logout') ?>" class=" w-20  h-16 flex items-center   transition-all ease-in duration-300  hover:w-56  hover:bg-primario hover:text-white">
            <!-- Imagen ticket-->
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="75" height="100" fill="currentColor" viewBox="-160 0 798 512">
                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                </svg>
            </p>
            <b>LogOut</b>
        </a>
    </nav>


    <main id="tickets" class="w-full  text-center  justify-items-center items-center">

        <header class=" bg-terciario-1 text-secundario h-16 flex items-center relative justify-center   ">
            <img src="/assets/img/logo.png" alt="Logo">
            <h1 class=" absolute right-0 mr-5"><?= $name ?></h1>

        </header>

        <article class="p-5">
            <?= $this->renderSection('content') ?>
        </article>
    </main>
</body>

</html>