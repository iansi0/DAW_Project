<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<main class="flex gap-7 py-10">
    <section class="flex flex-col gap-5">
        <div class="p-5">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTscU3jYwiMibdPrr7f7S2htGvZGqUWHKr6gSuuUYKQkA&s" alt="imagen dispositivo" class="w-full">
        </div>

        <div class="text-segundario min-w-64 max-w-72">
            <h3 class="bg-primario text-lg">Descripció</h3>
            <p class="bg-terciario-3 min-h-36 max-h-36 overflow-auto"><?= $ticket['descripcio_avaria'] ?></p>
        </div>


        <div class="flex justify-around">
            <!-- Esto es un select, coño -->
            <button class="bg-primario text-white px-5 py-2 rounded hover:bg-terciario-4 mr-4">c_stat </button>
            <button class="bg-primario text-white px-5 py-2 rounded hover:bg-terciario-4">guardar</button>
        </div>

    </section>

    <article class="flex flex-col gap-5 w-full">
        <h1 class="bg-primario text-segundario text-left   text-5xl"><?= $ticket['id'] ?></h1>


        <div class="flex justify-end gap-5">

            <!-- Search form -->
            <form method='get' action="<?= base_url('/tickets'); ?>" id="searchForm">
                <input type='text' name='q' value='' placeholder="Search here..." class="mb-5 px-5 py-1.5  border-2 border-terciario-3">
                <input type='button' id='btnsearch' value='Cercar' onclick='document.getElementById("searchForm").submit();' class="bg-primario text-white  mb-5 px-5 py-2 float-right">
            </form>


            <a href="<?= base_url('export') ?>">
                <button id="add-ticket" class=" bg-primario text-white px-5 py-2  hover:bg-terciario-4">PDF</button>

            </a>

            <a href="<?= base_url('ticketform') ?>">
                <button id="add-ticket" class=" bg-primario text-white px-5 py-2  hover:bg-terciario-4">Add Intervention</button>
            </a>

        </div>

        <?php   // TABLE GENERATED WITH TABLE-GEN-HELPER
        echo $table->generate();
        ?>
    </article>
</main>
<?= $this->endSection() ?>