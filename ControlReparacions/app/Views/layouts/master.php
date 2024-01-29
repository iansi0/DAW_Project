<!DOCTYPE html>
<html lang="ca" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/styles.css">
    <title>IKS</title>
</head>

<body class=" flex h-full">

    <nav id="Sidebar" class="bg-terciario-2 flex flex-col gap-10 py-20 w-20  text-5xl h-full ">

        <a href="<?= base_url('alumnes') ?>" class=" w-20  h-16 overflow-hidden flex items-center text-2xl text-primario  transition-all ease-in duration-300  hover:w-56  hover:bg-primario hover:text-white hover:z-10">
            <!-- Imagen ticket-->
            <p class=" "><svg xmlns="http://www.w3.org/2000/svg" width="80" height="100" fill="currentColor" class="bi bi-ticket" viewBox="-3 0 24 16">
                    <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z" />
                </svg>
            </p>
            <b>ALUMNES</b>
        </a>

        <!--TODO cuando haga click cambiar estilos con JS para marcar la view activa -->
        <button class="hover:z-10">
            <a href="<?= base_url('tickets') ?>" class=" w-20 h-16 overflow-hidden flex items-center text-2xl  transition-all ease-in duration-300   hover:w-56  hover:bg-primario hover:text-white ">
                <!-- Imagen ticket-->
                <p class=" "><svg xmlns="http://www.w3.org/2000/svg" width="80" height="100" fill="currentColor" class="bi bi-ticket" viewBox="-3 0 24 16">
                        <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z" />
                    </svg>
                </p>
                <b>TICKETS</b>
            </a>
        </button>

        <a href="<?= base_url('assignar') ?>" class=" w-20 h-16 overflow-hidden flex items-center text-2xl  transition-all ease-in duration-300   hover:w-56  hover:bg-primario hover:text-white hover:z-10">
            <!-- Imagen ticket-->
            <p class=" "><svg xmlns="http://www.w3.org/2000/svg" width="80" height="100" fill="currentColor" class="bi bi-ticket" viewBox="-3 0 24 16">
                    <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z" />
                </svg>
            </p>
            <b>ASSIGNAR</b>
        </a>
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