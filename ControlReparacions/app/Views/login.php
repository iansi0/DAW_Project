<!DOCTYPE html>
<html lang="en" class=" h-screen">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?=lang('login.login')?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/styles.css">
</head>

<style>
    body {
        font-family: monospace;
        /* font-family: system-ui; */
    }
</style>

<body class="h-screen flex flex-col justify-center items-center bg-segundario">

    <section class="bg-terciario-1 text-segundario flex flex-col gap-5 items-center border-2 rounded-md px-20 py-10">
        <img src="/assets/img/logo.png" alt="Logo">
        <form class=" flex flex-col   w-60 " method="POST" action="<?= base_url() ?>/login">
            <label class="mb-1 text-xl" for="email">Email</label>
            <input class="mb-5 rounded-md border-2 text-terciario-1 pl-1 focus:outline-none" type="email" id="email" name="email" />
<body class=" h-screen flex flex-col justify-center items-center">
    <section class=" bg-gray-300 flex flex-col gap-5 items-center border-2 rounded-md border-black px-20 py-10">
        <h1 class=" text-7xl">KYS</h1>
        <form class="flex flex-col text-center">
            <label class="mb-1 text-xl" for="email"><?=lang('login.email')?></label>
            <input class="mb-5 rounded-md" type="email" id="email" />

            <label class="mb-1 text-xl" for="password">Contrasenya</label>
            <input class="mb-10 rounded-md border-2 text-terciario-1 pl-1 focus:outline-none" type="password" id="password" name="password" />

            <input class="mb-5 text-lg py-2 rounded-sm bg-primario   hover:bg-terciario-2 hover:text-terciario-1" type="submit" value="INICIAR SESSIÓ">

            <?php if (isset($error) && !empty($error)) : ?>

                <p class="  text-primario text-center  text-lg r py-2"> <strong><?= $error ?></strong></p>
            <?php endif ?>

            <a class=" text-center" href="#">Has oblidat la contrasenya?</a>
        </form>
    </section>
</body>

</html>