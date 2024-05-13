<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>


<div class="flex gap-16 items-center bg-primario text-secundario p-3 rounded-lg pl-5 w-full mb-3">

    <a href="<?= strpos(previous_url(), 'tickets?') !== false
                    ? str_replace('index.php/', '', previous_url())
                    : base_url('/tickets'); ?>">
        <button id="pdf" class="hover:bg-light-blue hover:text-terciario-1 p-2 px-3 rounded-xl transition hover:ease-in ease-out duration-250"><i class="fa-solid fa-arrow-left text-3xl"></i></button>
    </a>

    <h1 class=" text-left text-5xl"><?= lang('titles.id_ticket'); ?>: <?= explode("-", $ticket['id'])[4] ?></h1>
</div>

<main style="view-transition-name: info<?= $ticket['id'] ?>;" class="flex gap-7 py-1 ">

    <section class="flex flex-col gap-2">

        <div class="p-5">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTscU3jYwiMibdPrr7f7S2htGvZGqUWHKr6gSuuUYKQkA&s" alt="imagen dispositivo" class="w-full">
        </div>

        <div class=" text-secundario min-w-72 max-w-80 rounded-t-lg overflow-hidden">
            <h3 class="bg-primario text-lg p-3"> Datos </h3>
            <p class="bg-terciario-2 p-2 text-terciario-1 overflow-auto"><i class="fa-solid fa-hashtag"></i> : <span class="text-sm"><?= $ticket['id'] ?></span></p>
            <p class="bg-terciario-2 p-2 text-terciario-1 overflow-auto"><i class="fa-solid fa-envelope"></i> : <span class="text-sm"><?= $ticket['correu_contacte'] ?></span></p>
        </div>


        <div class=" text-secundario min-w-64 max-w-72  rounded-t-lg overflow-hidden">
            <h3 class="bg-primario text-lg p-3"><?= lang('forms.description'); ?></h3>
            <p class="bg-terciario-2 p-3 text-terciario-1  min-h-auto max-h-32 overflow-y-auto break-words"><?= $ticket['descripcio'] ?></p>
        </div>

    </section>

    <article class="flex flex-col gap-2 w-full">

        <div class="flex justify-between gap-4">

            <form action="<?= base_url('work') ?>" method="get">
                <select name="" id="selectType" class="py-1 bg-primario rounded-lg text-secundario">


                    <?php
                    foreach ($estats as $estat) {
                        if ($estat['id'] == $ticket['id_estat']) {
                            echo "<option selected class=' estat_" . $estat['id'] . "' value='" . $estat["id"] . "'>" . $estat["nom"] . "</option>";
                        } else {
                            echo "<option class=' estat_" . $estat['id'] . "' value='" . $estat["id"] . "'>" . $estat["nom"] . "</option>";
                        }
                    }
                    ?>
                </select>

                <a href="<?= base_url('work') ?>">
                    <button id="pdf" class=" bg-primario text-secundario px-8 py-1 border border-terciario-4  rounded-lg  hover:bg-green-700 transition hover:ease-in ease-out duration-250"><?= lang('buttons.save'); ?></button>
                </a>
            </form>

            <div>

                <a href="<?= base_url('work') ?>">
                    <button id="pdf" class=" bg-primario text-secundario px-8 py-1 border border-terciario-4  rounded-lg  hover:bg-red-800 transition hover:ease-in ease-out duration-250">Imprimir PDF</button>
                </a>
            </div>
        </div>


        <div>
            <div class="flex justify-between bg-primario text-secundario text-left p-3 pr-8 text-3xl rounded-t-2xl">
                <h1><?= lang('titles.int'); ?></h1>
                <div class="hover:bg-light-blue hover:text-terciario-1 p-2 px-3 rounded-xl transition hover:ease-in ease-out duration-250">
                    <a href="<?= base_url('intervention/form') ?>"><i class="fa-icon fa-solid fa-plus "></i></a>
                </div>
            </div>

            <?php
            echo $table->generate();
            ?>
        </div>

    </article>
</main>
<?= $this->endSection() ?>