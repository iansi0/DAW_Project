<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class=" ">

    <div class="flex justify-between items-center mb-1">

        <h1 class=" text-left text-5xl text-primario"><?= strtoupper(lang('titles.students')) ?></h1>

    </div>

    <div class="flex justify-between items-center mb-1">

        <div class="flex gap-3 items-center center">
            <!-- Search form -->
            <form method='get' action="<?= base_url('students'); ?>" id="searchForm" class="flex gap-2 items-center center">
                <input type='text' name='q' value='<?= $search ?>' placeholder="<?= lang('buttons.search') ?>..." class=" px-5 py-1  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                <button id='btnsearch' onclick='document.getElementById("filters_form").submit();' class="bg-primario text-white px-2 py-1 border border-terciario-4 hover:bg-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>

            <!-- BUTTON SHOW FILTERS -->
            <button id='btn_filters' onclick='toggleFilters()' class="bg-primario text-white px-2 py-1 border border-terciario-4 hover:bg-red-300 cursor-pointer hover:text-terciario-4 rounded-lg transition hover:ease-in ease-out duration-250"><i class="fa-solid fa-filter"></i></button>


            <!-- BUTTON ADD STUDENT -->
            <?php if ((session()->get('user')['role'] == "sstt") || (session()->get('user')['role'] == "prof") || (session()->get('user')['role'] == "ins") || (session()->get('user')['role'] == "admin")) : ?>
                <a href="<?= base_url('students/add') ?>">
                    <button id='' class="bg-primario text-white px-2 py-1 border border-terciario-4 hover:bg-green-700 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250"><?= lang('titles.n_students') ?></button>
                </a>
            <?php endif ?>

        </div>

        <!-- Export Buttons -->
        <?php if ((session()->get('user')['role'] == "sstt") || (session()->get('user')['role'] == "ins")  || (session()->get('user')['role'] == "prof") || (session()->get('user')['role'] == "admin")) : ?>

            <div>

                <a href="<?= base_url('tickets/xls/' . $search) ?>">
                    <button id="xls" class=" bg-primario text-white px-8 py-1 border border-terciario-4  rounded-lg  hover:bg-terciario-4 transition hover:ease-in ease-out duration-250"><?= lang('buttons.export') . " XLS" ?></button>
                </a>
                <a href="<?= base_url('tickets/csv/' . $search) ?>">
                    <button id="csv" class=" bg-primario text-white px-8 py-1 border border-terciario-4  rounded-lg  hover:bg-terciario-4 transition hover:ease-in ease-out duration-250"><?= lang('buttons.export') . " CSV" ?></button>
                </a>
            </div>
        <?php endif ?>
    </div>



    <?php // TABLA GENERADA CON TABLE-GEN-HELPER
    echo $table->generate();
    ?>

    <!-- Paginación -->
    <div>
        <?= $pager->only(['q'])->links() ?>
    </div>
</div>

<?= $this->endSection() ?>