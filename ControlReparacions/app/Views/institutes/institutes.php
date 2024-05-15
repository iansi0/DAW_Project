<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>
<div>

  <div class="flex justify-between items-center mb-1">

    <h1 class="text-left text-5xl text-primario"><?= strtoupper(lang('titles.ins')) ?></h1>

  </div>

  <div class="flex justify-between items-center mb-1">

    <div class="flex gap-3 items-center center">
      <!-- Search form -->
      <form method='get' action="<?= base_url('institutes'); ?>" id="searchForm">
        <!-- INPUT SEARCH -->
        <input type='text' name='q' value='<?= $search ?>' onkeypress="inputFilter(this)" placeholder="<?= lang('buttons.search') ?>..." class=" px-5 py-1 w-48  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
        <!-- BUTTON SEARCH -->
        <button id='btnsearch' onclick='document.getElementById("filters_form").submit();' class="bg-primario text-white px-2 py-1 border border-terciario-4 hover:bg-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
      <!-- BUTTON SHOW FILTERS -->
      <button id='btn_filters' onclick='toggleFilters()' class="bg-primario text-white px-2 py-1 border border-terciario-4 hover:bg-red-300 cursor-pointer hover:text-terciario-4 rounded-lg transition hover:ease-in ease-out duration-250"><i class="fa-solid fa-filter"></i></button>
      <!-- BUTTON ADD TICKET -->
      <a href="<?= base_url('tickets/add') ?>">
        <button id='add-ticket' class="bg-primario text-white px-2 py-1 border border-terciario-4 hover:bg-green-700 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250"><i class="fa-solid fa-plus"></i></button>
      </a>
    </div>

    <!-- Export Buttons -->
    <div>

      <a href="<?= base_url('tickets/xls/' . $search . '') ?>">
        <button id="xls" class=" bg-primario text-white px-8 py-1 border border-terciario-4  rounded-lg  hover:bg-terciario-4 transition hover:ease-in ease-out duration-250"><?= lang('buttons.export') . " XLS" ?></button>
      </a>
      <a href="<?= base_url('tickets/csv/' . $search . '') ?>">
        <button id="csv" class=" bg-primario text-white px-8 py-1 border border-terciario-4  rounded-lg  hover:bg-terciario-4 transition hover:ease-in ease-out duration-250"><?= lang('buttons.export') . " CSV" ?></button>
      </a>
    </div>

  </div>

  <!-- Filters -->
  <form id="filters_form" action="<?= base_url('institutes') ?>" method="get" class="hidden gap-8 items-center mb-2 mt-2 border-y-2 p-3">

    <input type="hidden" id="search_hidden" name="q">
    <!-- DISPOSITIUS -->
    <div>
      <input list="dispositius" name="d" id="dispositiu" placeholder="Dispositius..." class="px-2 py-1 w-32 border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      <datalist id="dispositius">
        <option>a</option>
        <option>b</option>
        <option>c</option>
        <option>d</option>
      </datalist>
    </div>

    <!-- CENTRES -->
    <div>
      <input list="centres" name="c" id="centre" placeholder="Centres..." class="px-2 py-1 w-32  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      <datalist id="centres">
        <option>a</option>
        <option>b</option>
        <option>c</option>
        <option>d</option>
      </datalist>
    </div>

    <!-- DATA -->
    <div class="flex justify-between gap-3">
      <div class="flex">
        <input id="desde" name="dt_1" type="date" class=" px-5 py-1  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      </div>

      <label for="hasta">Hasta</label>

      <div class="flex ">
        <input id="hasta" name="dt_2" type="date" class=" px-5 py-1  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      </div>
    </div>

    <!-- HORA -->
    <div class="flex justify-between gap-3">
      <div class="flex ">
        <input id="desde" name="tm_1" type="time" class=" px-5 py-1   border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      </div>

      <label for="hasta">Hasta</label>

      <div class="flex ">
        <input id="hasta" name="tm_2" type="time" class=" px-5 py-1  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      </div>

    </div>

    <!-- ESTAT -->
    <div>
      <input list="estats" name="e" id="estat" placeholder="Estats..." class=" px-5 py-1 w-32 border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      <datalist id="estats">
        <option>a</option>
        <option>b</option>
        <option>c</option>
        <option>d</option>
      </datalist>
    </div>

    <div>
      <button onclick='document.getElementById("filters_form").submit();' class="bg-primario text-white px-8 py-1 border border-terciario-4 rounded-lg hover:bg-terciario-4 transition hover:ease-in ease-out duration-250">Filtrar</button>
    </div>
  </form>

  <?php   // TABLE GENERATED WITH TABLE-GEN-HELPER
  echo $table->generate();
  ?>

  <!-- Paginate -->
  <div>
    <?= $pager->only(['q'])->links() ?>
  </div>

</div>

<?= $this->endSection() ?>