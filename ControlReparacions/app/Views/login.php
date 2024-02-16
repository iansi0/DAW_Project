<!DOCTYPE html>
<html lang="en" class=" h-screen">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?=lang('login.login')?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/styles.css">
</head>

<body class=" h-screen flex flex-col justify-center items-center">
    <section class=" bg-gray-300 flex flex-col gap-5 items-center border-2 rounded-md border-black px-20 py-10">
        <h1 class=" text-7xl">KYS</h1>
        <form class="flex flex-col text-center">
            <label class="mb-1 text-xl" for="email"><?=lang('login.email')?></label>
            <input class="mb-5 rounded-md" type="email" id="email" />

            <label class="mb-1 text-xl" for="password"><?=lang('login.password')?></label>
            <input class="mb-5 rounded-md  w-60 h-6" type="password" id="password" />

            <input class="mb-5 text-xl bg-gray-200 rounded-md" type="submit" value="<?=lang('login.login')?>">

            <a href="#"><?=lang('login.forgetPassword')?></a>
        </form>
    </section>
</body>

</html>