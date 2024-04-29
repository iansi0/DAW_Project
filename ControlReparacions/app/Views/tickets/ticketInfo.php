<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>



<main style="view-transition-name: info<?= $ticket['id'] ?>;" class="flex gap-7 py-10">
    <section class="flex flex-col gap-2">
        <div class="p-5">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTscU3jYwiMibdPrr7f7S2htGvZGqUWHKr6gSuuUYKQkA&s" alt="imagen dispositivo" class="w-full">
        </div>

        <div class=" text-secundario min-w-64 max-w-72">
            <h3 class="bg-primario text-lg p-3"><?= lang('titles.id'); ?> </h3>
            <p class="bg-terciario-2 p-3 text-terciario-1 overflow-auto"><?= $ticket['id'] ?></p>
        </div>


        <div class=" text-secundario min-w-64 max-w-72">
            <h3 class="bg-primario text-lg p-3"><?= lang('forms.description'); ?></h3>
            <p class="bg-terciario-2 p-3 text-terciario-1  min-h-36 max-h-36 overflow-auto"><?= $ticket['descripcio'] ?></p>
        </div>

    </section>

    <article class="flex flex-col gap-5 w-full">
        <h1 class="bg-primario text-secundario text-left  p-3 text-5xl"><?= lang('titles.id_ticket'); ?>: <?= explode("-", $ticket['id'])[4] ?></h1>


        <div class="flex justify-between gap-4">

            <form action="<?= base_url('work') ?>" method="get">
                <select name="" id="selectType" class="py-1 bg-primario rounded-lg text-secundario">


                    <?php
                    foreach ($estats as $estat) {
                        if ($estat['id']==$ticket['id_estat']) {
                            echo "<option selected class=' estat_" . $estat['id'] . "' value='" . $estat["id"] . "'>" . $estat["nom"] . "</option>";
                            
                        }else{
                            echo "<option class=' estat_" . $estat['id'] . "' value='" . $estat["id"] . "'>" . $estat["nom"] . "</option>";

                        }
                    }
                    ?>
                </select>

                <a href="<?= base_url('work') ?>">
                    <button id="pdf" class=" bg-primario text-secundario px-8 py-1 border border-terciario-4  rounded-lg  hover:bg-terciario-4 transition hover:ease-in ease-out duration-250"><?= lang('buttons.save'); ?></button>
                </a>
            </form>

            <div>

                <a href="<?= base_url('work') ?>">
                    <button id="pdf" class=" bg-primario text-secundario px-8 py-1 border border-terciario-4  rounded-lg  hover:bg-terciario-4 transition hover:ease-in ease-out duration-250">Imprimir PDF</button>
                </a>
            </div>
        </div>


        <div>
            <div class="flex justify-between bg-primario text-secundario text-left p-3 pr-10 text-3xl rounded-t-2xl">
                <h1><?= lang('titles.int'); ?></h1>
                <a href="<?= base_url('work') ?>"><i class="fa-icon fa-solid fa-plus "></i></a>
            </div>

            <?php
            echo $table->generate();
            ?>
        </div>

    </article>
</main>
<?= $this->endSection() ?>