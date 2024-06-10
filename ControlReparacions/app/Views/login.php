<?php helper('cookie'); ?>
<!DOCTYPE html>
<html lang="en" class=" h-screen">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KeepYourSoftware</title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/styles.css">
</head>

<style>
    body {
        font-family: system-ui;   
    }
</style>

<body class="h-screen flex flex-col justify-center items-center" style="background-image: url('<?=base_url()?>/assets/img/login.jpg') ; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">

    <section class="bg-[#ffffff] text-terciario-4 flex flex-col gap-5 items-center border-2 border-secundario rounded-md px-20 py-10">
        <div class="flex items-center" style="user-select: none">
            <img src="/assets/img/logo.png" alt="Logo">
            <b>KeepYourSoftware</b>
        </div>

        <form class=" flex flex-col gap-5   w-full " method="POST" action="login">

            <!-- USUARIO -->
            <div>
                <div class="relative flex items-center">
                    <input name="user" id="user" type="text" required class="w-full  text-sm border-b border-gray-300 focus:border-[#333] px-2 py-3 outline-none" placeholder="<?=lang('forms.user')?> *" value="<?=(!empty($_COOKIE['user']))?$_COOKIE['user']:''?>" />
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2" viewBox="0 0 682.667 682.667">
                        <defs>
                            <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                <path d="M0 512h512V0H0Z" data-original="#000000"></path>
                            </clipPath>
                        </defs>
                        <g clip-path="url(#a)" transform="matrix(1.33 0 0 -1.33 0 682.667)">
                            <path fill="none" stroke-miterlimit="10" stroke-width="40" d="M452 444H60c-22.091 0-40-17.909-40-40v-39.446l212.127-157.782c14.17-10.54 33.576-10.54 47.746 0L492 364.554V404c0 22.091-17.909 40-40 40Z" data-original="#000000"></path>
                            <path d="M472 274.9V107.999c0-11.027-8.972-20-20-20H60c-11.028 0-20 8.973-20 20V274.9L0 304.652V107.999c0-33.084 26.916-60 60-60h392c33.084 0 60 26.916 60 60v196.653Z" data-original="#000000"></path>
                        </g>
                    </svg>
                </div>
            </div>

            <!-- CONTRASEÑA -->
            <div class="mt-8">
                <div class="relative flex items-center">
                    <input name="password" id="password" type="password" required class="w-full  text-sm border-b border-gray-300 focus:border-[#333] px-2 py-3 outline-none" placeholder="<?= lang('forms.passwd') ?> *"/>
                    <svg xmlns="http://www.w3.org/2000/svg" id="buttonShow" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2 cursor-pointer" viewBox="0 0 128 128">
                        <path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" data-original="#000000"></path>
                    </svg>
                </div>
            </div>

            <!-- RECORDAR + OLVIDAR -->
            <div class="flex gap-10 w-80 text-sm">

                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 shrink-0  border-gray-300 rounded" <?=(!empty($_COOKIE['user']))?'checked':''?> />
                    <label for="remember" class="ml-3 block hover:text-blue-900 hover:underline cursor-pointer">
                        <?=lang('login.remember')?>
                    </label>
                </div>

            </div>

            <!-- BOTON LOGIN -->
            <input class="mb-5 text-lg py-2 rounded-2xl bg-primario text-secundario hover:cursor-pointer hover:bg-terciario-2 hover:text-terciario-1 transition hover:ease-in ease-out duration-250" type="submit" value="<?= lang('buttons.login') ?>">

            <!-- MSG ERROR -->
            <?php if (session()->getFlashdata('error')) : ?>
                <div id="alert-border-2" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 " role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                </div>
                <!-- <p class="bg-red-300 text-terciario-1 text-center text-lg "> <?= session()->getFlashdata('error'); ?></p> -->

            <?php endif ?>
        </form>

        <p class="text-terciario-2"><?=lang('login.next')?></p>

        <a href="<?= $client ?>" class="px-4 py-2 border flex gap-2 border-slate-700 rounded-lg text-slate-700 hover:bg-blue-400 hover:border-slate-400 hover:text-white hover:shadow transition duration-150">
            <img class="w-6 h-6" src="https://www.svgrepo.com/show/475656/google-color.svg" loading="lazy" alt="google logo">
            <span><?=lang('login.google')?></span>
        </a>

    </section>

</body>

<script>
    const password = document.getElementById('password');
    const buttonShow = document.getElementById('buttonShow');

    buttonShow.addEventListener('click', () => {
        const isPasswordVisible = password.type === 'text';
        password.type = isPasswordVisible ? 'password' : 'text';
       
    });
</script>

</html>