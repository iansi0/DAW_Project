<!DOCTYPE html>
<html lang="en" class=" h-screen">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/styles.css">
</head>

<style>
    body {
        font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        /* font-family: system-ui; */
    }
</style>

<body class="h-screen flex flex-col justify-center items-center bg-secundario">

    <section class="bg-terciario-1 text-secundario flex flex-col gap-5 items-center border-2 rounded-md px-20 py-10">
        <img src="/assets/img/logo.png" alt="Logo">
        <form class=" flex flex-col   w-60 " method="POST" action="login">
            <label class="mb-1 text-xl" for="user"><?=lang('forms.user')?></label>
            <input class="mb-5 rounded-md border-2 text-terciario-1 pl-1 focus:outline-none" type="text" id="user" name="user" />

            <label class="mb-1 text-xl" for="password"><?=lang('forms.passwd')?></label>
            <input class="mb-10 rounded-md border-2 text-terciario-1 pl-1 focus:outline-none" type="password" id="password" name="password" />

            <input class="mb-5 text-lg py-2 rounded-sm bg-primario   hover:bg-terciario-2 hover:text-terciario-1" type="submit" value="<?=lang('buttons.login')?>">

            <?php if (isset($error) && !empty($error)) : ?>
                <p class="  text-primario text-center  text-lg r py-2"> <strong><?= $error ?></strong></p>
            <?php endif ?>

            <?= session()->getFlashdata('error'); ?>

            <a class=" text-center" href="#"><?=lang('login.forget')?></a>
        </form>

        <a href="">
            <button class="flex gap-2 text-lg px-4 py-2 rounded-sm bg-primario   hover:bg-terciario-2 hover:text-terciario-1">
                <svg width="30px" height="30px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff" stroke="#ffffff">

                    <g id="SVGRepo_bgCarrier" stroke-width="0" />

                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                    <g id="SVGRepo_iconCarrier">
                        <title>google [#ffffff]</title>
                        <desc>Created with Sketch.</desc>
                        <defs> </defs>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Dribbble-Light-Preview" transform="translate(-300.000000, -7399.000000)" fill="currentColor">
                                <g id="icons" transform="translate(56.000000, 160.000000)">
                                    <path d="M263.821537,7247.00386 L254.211298,7247.00386 C254.211298,7248.0033 254.211298,7250.00218 254.205172,7251.00161 L259.774046,7251.00161 C259.560644,7252.00105 258.804036,7253.40026 257.734984,7254.10487 C257.733963,7254.10387 257.732942,7254.11086 257.7309,7254.10986 C256.309581,7255.04834 254.43389,7255.26122 253.041161,7254.98137 C250.85813,7254.54762 249.130492,7252.96451 248.429023,7250.95364 C248.433107,7250.95064 248.43617,7250.92266 248.439233,7250.92066 C248.000176,7249.67336 248.000176,7248.0033 248.439233,7247.00386 L248.438212,7247.00386 C249.003881,7245.1669 250.783592,7243.49084 252.969687,7243.0321 C254.727956,7242.65931 256.71188,7243.06308 258.170978,7244.42831 C258.36498,7244.23842 260.856372,7241.80579 261.043226,7241.6079 C256.0584,7237.09344 248.076756,7238.68155 245.090149,7244.51127 L245.089128,7244.51127 C245.089128,7244.51127 245.090149,7244.51127 245.084023,7244.52226 L245.084023,7244.52226 C243.606545,7247.38565 243.667809,7250.75975 245.094233,7253.48622 C245.090149,7253.48921 245.087086,7253.49121 245.084023,7253.49421 C246.376687,7256.0028 248.729215,7257.92672 251.563684,7258.6593 C254.574796,7259.44886 258.406843,7258.90916 260.973794,7256.58747 C260.974815,7256.58847 260.975836,7256.58947 260.976857,7256.59047 C263.15172,7254.63157 264.505648,7251.29445 263.821537,7247.00386" id="google-[#ffffff]"> </path>
                                </g>
                            </g>
                        </g>
                    </g>

                </svg>
                <span>Login with Google</span>
            </button>
        </a>
    </section>
</body>

</html>