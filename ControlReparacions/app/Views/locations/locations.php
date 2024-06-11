<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>

<div class="flex justify-between items-center mb-1">
    <h1 class="text-left text-5xl text-primario"> <?= strtoupper(lang('titles.locations')) ?></h1>
</div>

<main class="flex gap-7 py-1 ">

    <article class="flex flex-col gap-2 w-full">

        <div>
            <div class="flex justify-between items-center pr-8">

                <div class="flex gap-3 items-center center">                   

                    <!-- BUTTON ADD  -->
                    <?php if ($filter == 'comarca') : ?>
                        <form method='get' action="<?= base_url('locations/filterComarca'); ?>" id="searchForm">
                            <!-- INPUT SEARCH -->
                            <input type='text' name='q' value='<?= $search ?>' onkeypress="inputFilter(this)" placeholder="<?= lang('buttons.search') ?>..." class=" px-5 py-1 w-48  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                            <!-- BUTTON SEARCH -->
                            <button id='btnsearch' onclick='document.getElementById("filters_form").submit();' class="bg-primario text-white px-2 py-1 border border-terciario-4 hover:bg-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                        <a href="<?= base_url('locations/addComarca') ?>">
                            <button id='add-ticket' class="bg-primario text-base font-semibold text-white px-3 py-1 border border-terciario-4 hover:bg-green-700 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250"><?= lang('buttons.add') ?> <?= lang('titles.comarca') ?></button>
                        </a>
                    <?php else : ?>
                        <form method='get' action="<?= base_url('locations/filterPoblacio'); ?>" id="searchForm">
                            <!-- INPUT SEARCH -->
                            <input type='text' name='q' value='<?= $search ?>' onkeypress="inputFilter(this)" placeholder="<?= lang('buttons.search') ?>..." class=" px-5 py-1 w-48  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                            <!-- BUTTON SEARCH -->
                            <button id='btnsearch' onclick='document.getElementById("filters_form").submit();' class="bg-primario text-white px-2 py-1 border border-terciario-4 hover:bg-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                        <a href="<?= base_url('locations/addPoblacio') ?>">
                            <button id='add-ticket' class="bg-primario text-base font-semibold text-white px-3 py-1 border border-terciario-4 hover:bg-green-700 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250"><?= lang('buttons.add') ?> <?= lang('titles.population') ?></button>
                        </a>
                    <?php endif ?>

                </div>

                <div class="flex text-4xl align-right gap-1">
                    <a class="transition hover:ease-in ease-out duration-250 pb-1 <?= $filter == 'comarca' ? "bg-primario rounded-t-lg text-white px-4" : "border border-primario rounded-t-lg px-4" ?>" href="<?= base_url('locations/filterComarca') ?>"><?= lang('titles.locations_1') ?></a>
                    <a class="transition hover:ease-in ease-out duration-250 pb-1 <?= $filter == 'poblacio' ? "bg-primario rounded-t-lg text-white px-4" : "border border-primario rounded-t-lg px-4" ?>" href="<?= base_url('locations/filterPoblacio') ?>"><?= lang('titles.locations_2') ?></a>
                </div>

            </div>

            <?= $table->generate(); ?>

            <div class="border-b border-primario"></div>

            <div>
                <?php // LA FUNCION DE ->only() ES LA QUE MANTIENE LA BUSQUEDA Y FILTROS EN LA URL SIN RESETEARLOS 
                ?>
                <?= $pager->only(['q', 'd', 'c', 'dt_1', 'dt_2', 'tm_1', 'tm_2', 'e'])->links() ?>
            </div>
        </div>
        <br><br><br>
    </article>
</main>

<?= $this->endSection() ?>