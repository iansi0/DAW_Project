<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>

<div class="flex justify-between items-center mb-1">
    <h1 class="text-left text-5xl text-primario"> <?= strtoupper(lang('titles.locations')) ?></h1>
</div>

<main class="flex gap-7 py-1 ">

    <article class="flex flex-col gap-2 w-full">

        <div>
            <div class="flex justify-between items-center mb-1">

                <div class="flex gap-3 items-center center">
                    <!-- Search form -->
                    <form method='get' action="<?= base_url('institutes'); ?>" id="searchForm">
                        <!-- INPUT SEARCH -->
                        <input type='text' name='q' value='<?= 'hola' ?>' onkeypress="inputFilter(this)" placeholder="<?= lang('buttons.search') ?>..." class=" px-5 py-1 w-48  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                        <!-- BUTTON SEARCH -->
                        <button id='btnsearch' onclick='document.getElementById("filters_form").submit();' class="bg-primario text-white px-2 py-1 border border-terciario-4 hover:bg-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    <!-- BUTTON SHOW FILTERS -->
                    <!-- <button id='btn_filters' onclick='toggleFilters()' class="bg-primario text-white px-2 py-1 border border-terciario-4 hover:bg-red-300 cursor-pointer hover:text-terciario-4 rounded-lg transition hover:ease-in ease-out duration-250"><i class="fa-solid fa-filter"></i></button> -->
                    <!-- BUTTON ADD TICKET -->
                    <a href="<?= base_url('institutes/add') ?>">
                        <button id='add-ticket' class="bg-primario text-base font-semibold text-white px-3 py-1 border border-terciario-4 hover:bg-green-700 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250"><?= lang('buttons.add') ?> <?= lang('titles.ins_2') ?></button>
                    </a>
                </div>

            </div>

            <?php
           // echo $table->generate();
            ?>
            <div class="border-b border-primario"></div>
        </div>
        <br><br><br>
    </article>
</main>

<?= $this->endSection() ?>