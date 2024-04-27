<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>



<main style="view-transition-name: info<?=$ticket['id']?>;" class="flex gap-7 py-10">
    <section class="flex flex-col gap-2">
        <div class="p-5">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTscU3jYwiMibdPrr7f7S2htGvZGqUWHKr6gSuuUYKQkA&s" alt="imagen dispositivo" class="w-full">
        </div>

        <div class=" flex flex-col">
            </div>
            
        <div class=" text-white min-w-64 max-w-72">
            <h3 class="bg-primario text-lg p-3"><?= lang('titles.id'); ?> </h3>
            <p class="bg-terciario-2 p-3 text-terciario-1 overflow-auto"><?= $ticket['id'] ?></p>
            <br>
            <h3 class="bg-primario text-lg p-3"><?= lang('forms.description'); ?></h3>
            <p class="bg-terciario-2 p-3 text-terciario-1  min-h-36 max-h-36 overflow-auto"><?= $ticket['descripcio'] ?></p>
        </div>


        <div class="flex justify-around">
            <!-- Esto es un select, coño -->
            <button class="bg-primario text-white px-5 py-2 rounded hover:bg-terciario-4 mr-4"><?= $ticket['estat'] ?> </button>
            <button class="bg-primario text-white px-5 py-2 rounded hover:bg-terciario-4 mr-4">PDF</button>
            <button class="bg-primario text-white px-5 py-2 rounded hover:bg-terciario-4"><?= lang('buttons.save'); ?></button>
        </div>

    </section>

    <article class="flex flex-col gap-5 w-full">
        <h1 class="bg-primario text-white text-left  p-3 text-5xl"><?= lang('titles.id_ticket'); ?>: <?= explode("-",$ticket['id'])[4] ?></h1>


        <div class="flex justify-end gap-5">




        </div>
        <div>
            <h1 class="bg-primario text-white text-left p-3  text-3xl"><?= lang('titles.int'); ?></h1>
            <?php  

                echo $table->generate();

            ?>
        </div>
     
    </article>
</main>
<?= $this->endSection() ?>