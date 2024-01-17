<!DOCTYPE html>
<html lang="en" class=" h-screen">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/styles.css">
</head>

<body class=" h-screen flex flex-col justify-center items-center">
    <section class=" bg-gray-300 flex flex-col gap-5 items-center border-2 rounded-md border-black px-20 py-10">
        <h1 class=" text-7xl">KYS</h1>
        <form class="flex flex-col text-center" method="POST" action="<?= base_url() ?>/login">
            <label class="mb-1 text-xl" for="email">Email</label>
            <input class="mb-5 rounded-md" type="email" id="email" name="email" />

            <label class="mb-1 text-xl" for="password">Contrasenya</label>
            <input class="mb-5 rounded-md  w-60 h-6" type="password" id="password" name="password" />

            <input class="mb-5 text-xl bg-gray-200 rounded-md" type="submit" value="Iniciar Sessió">

            <?php if (isset($error) && !empty($error)) : ?>

                <p class=" bg-primario text-white text-xl rounded-md py-3"><?= $error ?></p>
            <?php endif ?>

            <a href="#">Contrasenya olvidada</a>
        </form>
    </section>
</body>

</html>