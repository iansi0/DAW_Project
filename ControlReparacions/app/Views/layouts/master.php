<!DOCTYPE html>
<html lang="ca" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">

    <title>KeepYourSoftware</title>
</head>

<style>
    body {
        /* font-family: monospace; */
        font-family: system-ui;
        /*montserrat para titulos con bold
        lato y popins para textos medium */
    }
</style>

<body class=" flex flex-col  h-full bg-[#ffffff]">

    <header class=" fixed w-full  bg-[#f7f7f9] text-terciario-4  h-12 flex text-xl z-20 ">

        <!-- Navbar Movil -->
        <div class="modalButton md:hidden flex items-center ml-5">
            <button class="outline-none mobile-menu-button">
                <svg class="w-6 h-6 text-gray-500" x-show="!showMenu" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <nav id="modal" class="md:hidden h-full overflow-x-hidden overflow-y-hidden fixed inset-0 z-10  flex-col text-3xl  bg-white">

            <button class="modalButton w-full text-right pr-8 pt-5 text-4xl">X</button>

            <ul class=" flex flex-col gap-5 text-center justify-center justify-items-center content-center">
                <li>
                    <a href="<?= base_url('tickets') ?>" class="w-full h-16 flex items-center justify-center transition-all ease-in duration-300 hover:bg-primario hover:text-white <?= (uri_string() === 'tickets') ? 'bg-red-300' : '' ?>">
                        <p class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="100" fill="currentColor" viewBox="-50 0 600 512">
                                <path d="M473.6,215.5508a17.1034,17.1034,0,0,0,8.498-14.7788V127.75A17.0965,17.0965,0,0,0,465,110.6519H349.0981v28.5a17.0981,17.0981,0,1,1-34.1962,0v-28.5H47A17.0965,17.0965,0,0,0,29.9019,127.75v73.022A17.1034,17.1034,0,0,0,38.4,215.5508a46.5019,46.5019,0,0,1-.0093,80.9077,17.095,17.095,0,0,0-8.4887,14.7788V384.25A17.0965,17.0965,0,0,0,47,401.3481H314.9019v-28.5a17.0981,17.0981,0,1,1,34.1962,0v28.5H465A17.0965,17.0965,0,0,0,482.0981,384.25V311.2373a17.1034,17.1034,0,0,0-8.498-14.7788,46.5064,46.5064,0,0,1,0-80.9077Zm-124.502,98.4a17.0981,17.0981,0,1,1-34.1962,0v-28.5a17.0981,17.0981,0,1,1,34.1962,0Zm0-87.4018a17.0981,17.0981,0,1,1-34.1962,0v-28.5a17.0981,17.0981,0,1,1,34.1962,0Z"></path>
                            </svg>
                        </p>
                        <b><?= lang('titles.ticket') ?></b>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('students') ?>" class="w-full h-16 flex items-center justify-center transition-all ease-in duration-300 hover:bg-primario hover:text-white <?= (uri_string() === 'students') ? 'bg-red-300' : '' ?>">
                        <p class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="100" fill="currentColor" viewBox="-3 0 40 32">
                                <g>
                                    <path d="M31,26c-0.6,0-1-0.4-1-1V12c0-0.6,0.4-1,1-1s1,0.4,1,1v13C32,25.6,31.6,26,31,26z"></path>
                                </g>
                                <g>
                                    <path d="M16,21c-0.2,0-0.3,0-0.5-0.1l-15-8C0.2,12.7,0,12.4,0,12s0.2-0.7,0.5-0.9l15-8c0.3-0.2,0.6-0.2,0.9,0l15,8
		                        c0.3,0.2,0.5,0.5,0.5,0.9s-0.2,0.7-0.5,0.9l-15,8C16.3,21,16.2,21,16,21z">
                                    </path>
                                </g>
                                <path d="M17.4,22.6C17,22.9,16.5,23,16,23s-1-0.1-1.4-0.4L6,18.1V22c0,3.1,4.9,6,10,6s10-2.9,10-6v-3.9L17.4,22.6z"></path>
                            </svg>
                        </p>
                        <b><?= lang('titles.students') ?></b>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('institutes') ?>" class="w-full h-16 flex items-center justify-center transition-all ease-in duration-300 hover:bg-primario hover:text-white <?= (uri_string() === 'institutes') ? 'bg-red-300' : '' ?>">
                        <p class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="100" fill="currentColor" viewBox="-2 2 35 26">
                                <g id="school-7_1_">
                                    <polygon points="15,10 14,10 14,12 14,13 15,13 17,13 17,12 15,12 	"></polygon>
                                    <path d="M27,25v-9h1l-1-2h-6v11h-1V9.067l1.529,0.815l0.941-1.766L15,4.133V3h3V0h-3h-1v4.133L6.529,8.117l0.941,1.766L9,9.067V25
		                    H8V14H2l-1,2h1v9H0v1h29v-1H27z M22,21v-1h3v1H22z M4,21v-1h3v1H4z M14.5,16c-1.933,0-3.5-1.567-3.5-3.5S12.567,9,14.5,9
		                    c1.933,0,3.5,1.567,3.5,3.5S16.433,16,14.5,16z M13,25v-5h3v5H13z">
                                    </path>
                                </g>
                            </svg>
                        </p>
                        <b><?= lang('titles.ins') ?></b>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('assign') ?>" class="w-full h-16 flex items-center justify-center transition-all ease-in duration-300 hover:bg-primario hover:text-white <?= (uri_string() === 'assign') ? 'bg-red-300' : '' ?>">
                        <p class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="100" fill="currentColor" viewBox="-30 0 520 455">
                                <g transform="translate(0.000000,455.000000) scale(0.050000,-0.050000)" stroke="none">
                                    <path d="M4038 9036 c-801 -397 -673 -1607 196 -1846 95 -26 93 -26 -138 -28
                            -489 -4 -782 -156 -937 -488 -92 -196 -102 -296 -95 -979 8 -797 16 -815 393
                            -815 l178 0 8 248 c41 1208 1697 1170 1697 -40 l0 -208 187 0 c378 0 393 33
                            393 854 0 812 -28 937 -259 1167 -197 196 -382 258 -789 261 -198 2 -226 6
                            -152 20 869 170 1035 1429 242 1845 l-138 73 -329 0 -329 0 -128 -64z" />
                                    <path d="M1102 8828 c-939 -252 -987 -1575 -69 -1899 l137 -48 -180 -1 c-474
                            -2 -763 -135 -931 -428 l-59 -102 0 -835 0 -836 65 -39 c99 -60 2488 -62 2587
                            -2 127 77 131 105 124 877 -7 790 -12 820 -184 1032 -183 225 -385 312 -766
                            328 l-264 11 126 44 c609 213 859 967 495 1495 -238 346 -680 511 -1081 403z" />
                                    <path d="M7362 8828 c-958 -257 -967 -1617 -12 -1920 79 -25 77 -25 -90 -27
                                -581 -6 -919 -221 -1030 -654 -52 -205 -36 -1436 20 -1510 91 -122 31 -117
                                1375 -117 l1229 0 68 46 68 46 5 808 5 809 -53 105 c-161 318 -461 463 -967
                                466 l-170 1 130 45 c1200 409 646 2231 -578 1902z" />
                                    <path d="M4398 5718 c-129 -19 -240 -82 -332 -186 -156 -177 -146 17 -146
                            -2894 l0 -2598 -140 0 -140 0 0 1169 c0 1409 -8 1461 -258 1711 -205 205 -714
                            328 -840 202 l-42 -42 0 -1520 0 -1520 -1250 0 c-820 0 -1250 -7 -1250 -20 0
                            -13 1513 -20 4500 -20 2987 0 4500 7 4500 20 0 12 -100 20 -259 20 l-260 0 -5
                            1355 -6 1355 -54 102 c-292 553 -796 264 -796 -457 l0 -257 -125 14 c-69 7
                            -132 17 -140 22 -8 5 -15 250 -15 546 0 627 -14 698 -173 852 -178 173 -309
                            177 -489 14 -175 -159 -187 -206 -195 -793 l-6 -516 -104 13 c-189 24 -170
                            -49 -177 676 l-6 644 -59 107 c-161 290 -398 347 -606 145 -167 -162 -174
                            -195 -181 -859 l-7 -586 -83 13 c-46 6 -109 17 -139 23 l-55 10 0 1398 c0
                            1344 -2 1402 -40 1503 -92 246 -351 394 -622 354z" />
                                </g>
                            </svg>

                        </p>
                        <b><?= lang('titles.assign') ?></b>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('inventary') ?>" class="w-full h-16 flex items-center justify-center transition-all ease-in duration-300 hover:bg-primario hover:text-white <?= (uri_string() === 'inventary') ? 'bg-red-300' : '' ?>">
                        <p class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="65" height="100" fill="currentColor" viewBox="-3 0 38 32">
                                <g>
                                    <path d="M27.3,12.1l2.4-2.4C29.9,9.5,30,9.1,30,8.8c-0.1-0.3-0.3-0.6-0.6-0.7l-10-4C19,3.9,18.6,4,18.3,4.3L16,6.6l-2.3-2.3
		                    C13.4,4,13,3.9,12.6,4.1l-10,4C2.3,8.2,2.1,8.5,2,8.8C2,9.1,2.1,9.5,2.3,9.7l2.4,2.4l-2.5,3.3C2,15.6,2,16,2,16.3
		                    c0.1,0.3,0.3,0.5,0.6,0.7l10,4c0.1,0,0.2,0.1,0.4,0.1c0.3,0,0.6-0.1,0.8-0.4l2.2-2.9l2.2,2.9c0.2,0.3,0.5,0.4,0.8,0.4
		                    c0.1,0,0.3,0,0.4-0.1l10-4c0.3-0.1,0.5-0.4,0.6-0.7c0.1-0.3,0-0.6-0.2-0.9L27.3,12.1z M16,14.9L8.7,12L16,9.1l7.3,2.9L16,14.9z">
                                    </path>
                                    <path d="M19,23c-0.9,0-1.8-0.4-2.4-1.2L16,21l-0.6,0.8c-0.8,1.1-2.3,1.5-3.5,1L5,20v4c0,0.4,0.2,0.8,0.6,0.9l10,4
		                    c0.1,0,0.2,0.1,0.4,0.1s0.3,0,0.4-0.1l10-4c0.4-0.2,0.6-0.5,0.6-0.9v-4l-6.9,2.8C19.8,22.9,19.4,23,19,23z">
                                    </path>
                                </g>
                            </svg>
                        </p>
                        <b><?= lang("titles.inventory_2") ?></b>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('logout') ?>" class=" w-full  h-16 flex items-center justify-center transition-all ease-in duration-300 hover:bg-primario hover:text-white">
                        <p class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="100" fill="currentColor" viewBox="-2 0 30 24">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path d="M4 18h2v2h12V4H6v2H4V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3zm2-7h7v2H6v3l-5-4 5-4v3z"></path>
                            </svg>
                        </p>
                        <b><?= lang('buttons.logout') ?></b>
                    </a>
                </li>
            </ul>
        </nav>



        <div class="absolute right-44 flex align-middle mt-2 gap-3">
            <a class="hover:text-primario <?= session('user')['lang']=='es' ? "text-primario font-bold" : "" ?>" href="<?= base_url('change_lang/es') ?>">ES</a>
            <span>&nbsp;|&nbsp;</span>
            <a class="hover:text-primario <?= session('user')['lang']=='ca' ? "text-primario font-bold" : "" ?>" href="<?= base_url('change_lang/ca') ?>">CA</a>
        </div>

        <!-- User img and name -->
        <div id="div_user" style="cursor:pointer" class="flex items-center absolute right-5 h-full gap-2 transform transition-all ease-in duration-200 hover:text-primario">
            <div class="">
            </div>
            <!-- <img class="w-10 h-10 rounded-full" src="https://cdn-icons-png.freepik.com/512/1077/1077114.png" alt="Rounded avatar"> -->
            <i class="py-3 rounded-full fa-solid fa-user text-2xl"></i>
            <h1 class="align-center h mr-5 font-bold ">
                <?= session('user')['user'] ?>&nbsp;
                <i class="fa-solid fa-caret-down"></i>
            </h1>
        </div>

        <!-- DROPDOWN USER -->
        <div id="dropdown_user" class="absolute hidden right-1 top-12 w-60 px-5 py-3 bg-[#f7f7f9] shadow border border-transparent rounded-b-lg">
            <ul class="space-y-3 text-terciario-4">
                <li class="font-medium h-8">
                    <a href="<?= base_url('profile') ?>" class="pl-2 h-full py-2 flex items-center rounded-lg transform transition-all ease-in duration-300 hover:bg-primario hover:text-white">
                        <div class="mr-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <?= lang('buttons.user') ?>
                    </a>
                </li>
                <li class="font-medium h-8">
                    <a href="<?= base_url('work') ?>" class="pl-2 h-full py-2 flex items-center rounded-lg transform transition-all ease-in duration-300 hover:bg-primario hover:text-white">
                        <div class="mr-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <?= lang('buttons.config') ?>
                    </a>
                </li>

                <hr class="border-gray-700">

                <li class="font-medium h-8">
                    <a href="<?= base_url('logout') ?>" class="pl-2 h-full py-2 flex items-center rounded-lg transition-all ease-in duration-300 hover:bg-primario hover:text-white">
                        <div class="ml-1 mr-3 text-red-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </div>
                        <?= lang('buttons.logout') ?>
                    </a>
                </li>
            </ul>
        </div>
    </header>


    <main id="tickets" class="w-full h-full flex  text-center  justify-items-center items-center">

        <!-- Navbar Web -->
        <div class=" hidden md:block text-lg min-w-10 h-full  overflow-hidden transition-all ease-in duration-300 hover:min-w-60 ">
            <nav id="Sidebar" class="fixed bg-[#f7f7f9] text-terciario-4 flex flex-col gap-5  w-14 h-full  overflow-hidden transition-all ease-in duration-300 hover:w-60 z-30 ">

                <!-- LOGO -->
                <div class="w-full h-16 flex items-center text-sm text-terciario-1 ">
                    <img width="50" height="100" class="mr-3" src="/assets/img/logo.png" alt="Logo">
                    <b>KeepYourSoftware</b>
                </div>

                <!-- TICKET -->
                <a href="<?= base_url('tickets') ?>" class="w-full h-16 flex items-center transition-all ease-in duration-300 hover:bg-primario hover:text-white <?= (uri_string() === 'tickets') ? 'bg-red-300' : '' ?>">
                    <p class="mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="100" fill="currentColor" viewBox="-50 0 600 512">
                            <path d="M473.6,215.5508a17.1034,17.1034,0,0,0,8.498-14.7788V127.75A17.0965,17.0965,0,0,0,465,110.6519H349.0981v28.5a17.0981,17.0981,0,1,1-34.1962,0v-28.5H47A17.0965,17.0965,0,0,0,29.9019,127.75v73.022A17.1034,17.1034,0,0,0,38.4,215.5508a46.5019,46.5019,0,0,1-.0093,80.9077,17.095,17.095,0,0,0-8.4887,14.7788V384.25A17.0965,17.0965,0,0,0,47,401.3481H314.9019v-28.5a17.0981,17.0981,0,1,1,34.1962,0v28.5H465A17.0965,17.0965,0,0,0,482.0981,384.25V311.2373a17.1034,17.1034,0,0,0-8.498-14.7788,46.5064,46.5064,0,0,1,0-80.9077Zm-124.502,98.4a17.0981,17.0981,0,1,1-34.1962,0v-28.5a17.0981,17.0981,0,1,1,34.1962,0Zm0-87.4018a17.0981,17.0981,0,1,1-34.1962,0v-28.5a17.0981,17.0981,0,1,1,34.1962,0Z"></path>
                        </svg>
                    </p>
                    <b><?= lang('titles.ticket') ?></b>
                </a>

                <!-- ESTUDIANTES -->
                <a href="<?= base_url('students') ?>" class="w-full h-16 flex items-center transition-all ease-in duration-300 hover:bg-primario hover:text-white  <?= (uri_string() === 'students') ? 'bg-red-300' : '' ?>">
                    <p class="mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="100" fill="currentColor" viewBox="-3 0 40 32">
                            <g>
                                <path d="M31,26c-0.6,0-1-0.4-1-1V12c0-0.6,0.4-1,1-1s1,0.4,1,1v13C32,25.6,31.6,26,31,26z"></path>
                            </g>
                            <g>
                                <path d="M16,21c-0.2,0-0.3,0-0.5-0.1l-15-8C0.2,12.7,0,12.4,0,12s0.2-0.7,0.5-0.9l15-8c0.3-0.2,0.6-0.2,0.9,0l15,8
		                        c0.3,0.2,0.5,0.5,0.5,0.9s-0.2,0.7-0.5,0.9l-15,8C16.3,21,16.2,21,16,21z">
                                </path>
                            </g>
                            <path d="M17.4,22.6C17,22.9,16.5,23,16,23s-1-0.1-1.4-0.4L6,18.1V22c0,3.1,4.9,6,10,6s10-2.9,10-6v-3.9L17.4,22.6z"></path>
                        </svg>
                    </p>
                    <b><?= lang('titles.students') ?></b>
                </a>

                <!-- INSTITUTOS -->
                <a href="<?= base_url('institutes') ?>" class="w-full h-16 flex items-center transition-all ease-in duration-300 hover:bg-primario hover:text-white  <?= (uri_string() === 'institutes') ? 'bg-red-300' : '' ?>">
                    <p class="mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="100" fill="currentColor" viewBox="-2 2 35 26">
                            <g id="school-7_1_">
                                <polygon points="15,10 14,10 14,12 14,13 15,13 17,13 17,12 15,12 	"></polygon>
                                <path d="M27,25v-9h1l-1-2h-6v11h-1V9.067l1.529,0.815l0.941-1.766L15,4.133V3h3V0h-3h-1v4.133L6.529,8.117l0.941,1.766L9,9.067V25
		                    H8V14H2l-1,2h1v9H0v1h29v-1H27z M22,21v-1h3v1H22z M4,21v-1h3v1H4z M14.5,16c-1.933,0-3.5-1.567-3.5-3.5S12.567,9,14.5,9
		                    c1.933,0,3.5,1.567,3.5,3.5S16.433,16,14.5,16z M13,25v-5h3v5H13z">
                                </path>
                            </g>
                        </svg>
                    </p>
                    <b><?= lang('titles.ins') ?></b>
                </a>

                <!-- ASIGNAR -->
                <a href="<?= base_url('assign') ?>" class="w-full h-16 flex items-center transition-all ease-in duration-300 hover:bg-primario hover:text-white  <?= (uri_string() === 'assign') ? 'bg-red-300' : '' ?>">
                    <p class="mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="100" fill="currentColor" viewBox="-30 0 520 455">
                            <g transform="translate(0.000000,455.000000) scale(0.050000,-0.050000)" stroke="none">
                                <path d="M4038 9036 c-801 -397 -673 -1607 196 -1846 95 -26 93 -26 -138 -28
                            -489 -4 -782 -156 -937 -488 -92 -196 -102 -296 -95 -979 8 -797 16 -815 393
                            -815 l178 0 8 248 c41 1208 1697 1170 1697 -40 l0 -208 187 0 c378 0 393 33
                            393 854 0 812 -28 937 -259 1167 -197 196 -382 258 -789 261 -198 2 -226 6
                            -152 20 869 170 1035 1429 242 1845 l-138 73 -329 0 -329 0 -128 -64z" />
                                <path d="M1102 8828 c-939 -252 -987 -1575 -69 -1899 l137 -48 -180 -1 c-474
                            -2 -763 -135 -931 -428 l-59 -102 0 -835 0 -836 65 -39 c99 -60 2488 -62 2587
                            -2 127 77 131 105 124 877 -7 790 -12 820 -184 1032 -183 225 -385 312 -766
                            328 l-264 11 126 44 c609 213 859 967 495 1495 -238 346 -680 511 -1081 403z" />
                                <path d="M7362 8828 c-958 -257 -967 -1617 -12 -1920 79 -25 77 -25 -90 -27
                                -581 -6 -919 -221 -1030 -654 -52 -205 -36 -1436 20 -1510 91 -122 31 -117
                                1375 -117 l1229 0 68 46 68 46 5 808 5 809 -53 105 c-161 318 -461 463 -967
                                466 l-170 1 130 45 c1200 409 646 2231 -578 1902z" />
                                <path d="M4398 5718 c-129 -19 -240 -82 -332 -186 -156 -177 -146 17 -146
                            -2894 l0 -2598 -140 0 -140 0 0 1169 c0 1409 -8 1461 -258 1711 -205 205 -714
                            328 -840 202 l-42 -42 0 -1520 0 -1520 -1250 0 c-820 0 -1250 -7 -1250 -20 0
                            -13 1513 -20 4500 -20 2987 0 4500 7 4500 20 0 12 -100 20 -259 20 l-260 0 -5
                            1355 -6 1355 -54 102 c-292 553 -796 264 -796 -457 l0 -257 -125 14 c-69 7
                            -132 17 -140 22 -8 5 -15 250 -15 546 0 627 -14 698 -173 852 -178 173 -309
                            177 -489 14 -175 -159 -187 -206 -195 -793 l-6 -516 -104 13 c-189 24 -170
                            -49 -177 676 l-6 644 -59 107 c-161 290 -398 347 -606 145 -167 -162 -174
                            -195 -181 -859 l-7 -586 -83 13 c-46 6 -109 17 -139 23 l-55 10 0 1398 c0
                            1344 -2 1402 -40 1503 -92 246 -351 394 -622 354z" />
                            </g>
                        </svg>

                    </p>
                    <b><?= lang('titles.assign') ?></b>
                </a>

                <!-- INVENTARIO -->
                <a href="<?= base_url('inventary') ?>" class="w-ful h-16 flex items-center transition-all ease-in duration-300 hover:bg-primario hover:text-white  <?= (uri_string() === 'inventary') ? 'bg-red-300' : '' ?>">
                    <p class="mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="100" fill="currentColor" viewBox="-3 0 38 32">
                            <g>
                                <path d="M27.3,12.1l2.4-2.4C29.9,9.5,30,9.1,30,8.8c-0.1-0.3-0.3-0.6-0.6-0.7l-10-4C19,3.9,18.6,4,18.3,4.3L16,6.6l-2.3-2.3
		                    C13.4,4,13,3.9,12.6,4.1l-10,4C2.3,8.2,2.1,8.5,2,8.8C2,9.1,2.1,9.5,2.3,9.7l2.4,2.4l-2.5,3.3C2,15.6,2,16,2,16.3
		                    c0.1,0.3,0.3,0.5,0.6,0.7l10,4c0.1,0,0.2,0.1,0.4,0.1c0.3,0,0.6-0.1,0.8-0.4l2.2-2.9l2.2,2.9c0.2,0.3,0.5,0.4,0.8,0.4
		                    c0.1,0,0.3,0,0.4-0.1l10-4c0.3-0.1,0.5-0.4,0.6-0.7c0.1-0.3,0-0.6-0.2-0.9L27.3,12.1z M16,14.9L8.7,12L16,9.1l7.3,2.9L16,14.9z">
                                </path>
                                <path d="M19,23c-0.9,0-1.8-0.4-2.4-1.2L16,21l-0.6,0.8c-0.8,1.1-2.3,1.5-3.5,1L5,20v4c0,0.4,0.2,0.8,0.6,0.9l10,4
		                    c0.1,0,0.2,0.1,0.4,0.1s0.3,0,0.4-0.1l10-4c0.4-0.2,0.6-0.5,0.6-0.9v-4l-6.9,2.8C19.8,22.9,19.4,23,19,23z">
                                </path>
                            </g>
                        </svg>
                    </p>
                    <b><?= lang("titles.inventory_2") ?></b>
                </a>

                <!-- CERRAR SESIÓN -->
                <a href="<?= base_url('logout') ?>" class=" w-full  h-16 flex items-center transition-all ease-in duration-300 hover:bg-primario hover:text-white ">
                    <p class="mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="100" fill="currentColor" viewBox="-2 0 30 24">
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path d="M4 18h2v2h12V4H6v2H4V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3zm2-7h7v2H6v3l-5-4 5-4v3z"></path>
                        </svg>
                    </p>
                    <b><?= lang('buttons.logout') ?></b>
                </a>
            </nav>
        </div>

        <article class=" w-full h-full px-10 pt-14 rounded-l-md">
            <?= $this->renderSection('content') ?>
        </article>

    </main>


</body>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        // FUNCIONES DE SHOW / HIDE DE DROPDOWN USUARIO
        var dropdown = document.querySelector("#dropdown_user");
     

        window.addEventListener('click', function(event) {

            if (event.target.id != 'dropdown_user' || event.target.closest('div').id != 'dropdown_user') {
                if (event.target && (event.target.id === 'div_user' || (event.target.closest('div') && event.target.closest('div').id === 'div_user'))) {
                    if (dropdown.style.display == "none") {
                        dropdown.style.display = "block";
                    } else {
                        dropdown.style.display = "none";
                    }
                } else {
                    dropdown.style.display = "none";
                }
            }

        })

        // FUNCIONES DE LA BARRA LATERAL DEL MENÚ (version movil)
        var modal = document.getElementById('modal');
        modal.style.display = 'none';

        var botones = document.querySelectorAll(".modalButton");

        for (let index = 0; index < botones.length; index++) {
            botones[index].addEventListener('click', function() {
                if (modal.style.display == "none") {
                    modal.style.display = "block";
                    document.documentElement.style.overflow = 'hidden';
                } else {
                    modal.style.display = "none";
                    document.documentElement.style.overflow = 'auto';
                }
            })
        }



    });

    function show() {
        var modal = document.getElementById('modal');
        modal.style.display = 'none';

    }
</script>

</html>