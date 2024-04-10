<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<main class="flex gap-20">
    <section class="flex flex-col gap-5">
        <div class="p-5">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTscU3jYwiMibdPrr7f7S2htGvZGqUWHKr6gSuuUYKQkA&s" alt="imagen dispositivo" class="w-full">
        </div>

        <div class="text-segundario">
            <h3 class="bg-primario">Descripció</h3>
            <p class="bg-terciario-3"><?= $ticket['descripcio_avaria'] ?></p>
        </div>


        <div class="flex justify-around">
            <!-- Esto es un select, coño -->
            <button class="bg-primario text-white px-5 py-2 rounded hover:bg-terciario-4 mr-4">c_stat </button>
            <button class="bg-primario text-white px-5 py-2 rounded hover:bg-terciario-4">guardar</button>
        </div>

    </section>

    <article class="flex flex-col gap-10 w-full">
        <h1 class="bg-primario text-segundario text-left   text-5xl"><?= $ticket['id'] ?></h1>

        <?php   // TABLE GENERATED WITH TABLE-GEN-HELPER
        echo $table->generate();
        ?>
    </article>
</main>
<?= $this->endSection() ?>