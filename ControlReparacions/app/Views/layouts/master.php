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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
    <title>KeepYourSoftware</title>
</head>

<style>
    body {
        font-family: monospace;
        /* font-family: system-ui; */
    }
</style>

<body class=" flex h-full bg-secundario">
    <div class=" relative text-lg min-w-20 h-full  overflow-hidden transition-all ease-in duration-300 hover:min-w-60 ">
        <nav id="Sidebar" class="bg-terciario-1 text-primario flex flex-col gap-9 py-16 pl-1  w-20  fixed overflow-hidden transition-all ease-in duration-300 hover:w-60 ">
            <div class=" w-20 h-16  flex items-center text-sm text-secundario ">
                <!-- Imagen ticket-->
                <img src="/assets/img/logo.png" alt="Logo">
                <b>KeepYourSoftware</b>
            </div>

            <a href="<?= base_url('tickets') ?>" class=" w-20 h-16  flex items-center   transition-all ease-in duration-300   hover:w-full  hover:bg-primario hover:text-white hover:z-10">
                <!-- Imagen ticket-->
                <p>

                    <svg xmlns="http://www.w3.org/2000/svg" width="75" height="100" fill="currentColor" viewBox="-50 0 600 512">
                        <path d="M473.6,215.5508a17.1034,17.1034,0,0,0,8.498-14.7788V127.75A17.0965,17.0965,0,0,0,465,110.6519H349.0981v28.5a17.0981,17.0981,0,1,1-34.1962,0v-28.5H47A17.0965,17.0965,0,0,0,29.9019,127.75v73.022A17.1034,17.1034,0,0,0,38.4,215.5508a46.5019,46.5019,0,0,1-.0093,80.9077,17.095,17.095,0,0,0-8.4887,14.7788V384.25A17.0965,17.0965,0,0,0,47,401.3481H314.9019v-28.5a17.0981,17.0981,0,1,1,34.1962,0v28.5H465A17.0965,17.0965,0,0,0,482.0981,384.25V311.2373a17.1034,17.1034,0,0,0-8.498-14.7788,46.5064,46.5064,0,0,1,0-80.9077Zm-124.502,98.4a17.0981,17.0981,0,1,1-34.1962,0v-28.5a17.0981,17.0981,0,1,1,34.1962,0Zm0-87.4018a17.0981,17.0981,0,1,1-34.1962,0v-28.5a17.0981,17.0981,0,1,1,34.1962,0Z"></path>
                    </svg>
                </p>
                <b>TICKETS</b>
            </a>

            <a href="<?= base_url('students') ?>" class=" w-20  h-16 flex items-center   transition-all ease-in duration-300  hover:w-56  hover:bg-primario hover:text-white">
                <!-- Imagen ticket-->
                <p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="75" height="100" fill="currentColor" viewBox="-3 0 40 32">
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
                <b>STUDENTS</b>
            </a>

            <a href="<?= base_url('institutes') ?>" class=" w-20 h-16 flex items-center   transition-all ease-in duration-300   hover:w-56  hover:bg-primario hover:text-white hover:z-10">
                <!-- Imagen ticket-->
                <p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="75" height="100" fill="currentColor" viewBox="-2 2 35 26">
                        <g id="school-7_1_">
                            <polygon points="15,10 14,10 14,12 14,13 15,13 17,13 17,12 15,12 	"></polygon>
                            <path d="M27,25v-9h1l-1-2h-6v11h-1V9.067l1.529,0.815l0.941-1.766L15,4.133V3h3V0h-3h-1v4.133L6.529,8.117l0.941,1.766L9,9.067V25
		                    H8V14H2l-1,2h1v9H0v1h29v-1H27z M22,21v-1h3v1H22z M4,21v-1h3v1H4z M14.5,16c-1.933,0-3.5-1.567-3.5-3.5S12.567,9,14.5,9
		                    c1.933,0,3.5,1.567,3.5,3.5S16.433,16,14.5,16z M13,25v-5h3v5H13z">
                            </path>
                        </g>
                    </svg>
                </p>
                <b>INSTITUTES</b>
            </a>

            <a href="<?= base_url('assign') ?>" class=" w-20  h-16 flex items-center   transition-all ease-in duration-300  hover:w-56  hover:bg-primario hover:text-white">
                <!-- Imagen ticket-->
                <p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="75" height="100" fill="currentColor" viewBox="-30 0 520 455">
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
                <b>ASSIGN</b>
            </a>

            <a href="<?= base_url('Inventari') ?>" class=" w-20  h-16 flex items-center  transition-all ease-in duration-300  hover:w-56  hover:bg-primario hover:text-white">
                <!-- Imagen ticket-->
                <p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="75" height="100" fill="currentColor" viewBox="-3 0 38 32">
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
                <b>Inventari</b>
            </a>

            <a href="<?= base_url('logout') ?>" class=" w-20  h-16 flex items-center   transition-all ease-in duration-300  hover:w-56  hover:bg-primario hover:text-white">
                <!-- Imagen ticket-->
                <p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="75" height="100" fill="currentColor" viewBox="-2 0 30 24">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path d="M4 18h2v2h12V4H6v2H4V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3zm2-7h7v2H6v3l-5-4 5-4v3z"></path>
                    </svg>
                </p>
                <b>LogOut</b>
            </a>
        </nav>
    </div>

    <main id="tickets" class="w-full h-full   text-center  justify-items-center items-center">

        <header class=" fixed w-[-webkit-fill-available]  bg-terciario-1 text-secundario  h-16 flex items-center  justify-center  ">
                <img src="/assets/img/logo.png" alt="Logo">
                <h1 class=" absolute right-0 mr-5  "><?= $name ?></h1>
        </header>

        <article class="p-5 pt-16">
            <?= $this->renderSection('content') ?>
        </article>
    </main>
</body>

</html>