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
      <a href="<?= base_url('institutes/add') ?>">
        <button id='add-ticket' class="bg-primario text-white px-2 py-1 border border-terciario-4 hover:bg-green-700 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250"><i class="fa-solid fa-plus"></i></button>
      </a>
    </div>

    <div class="relative">
      <button id="dropdownDefaultButton" class="text-white bg-primario hover:bg-terciario-4 rounded-lg text-sm px-7 py-2.5 text-center inline-flex items-center" type="button">
        Import / Export
        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
        </svg>
      </button>

      <!-- Dropdown menu -->
      <div id="dropdown" class="absolute hidden z-10 w-full  bg-white divide-y divide-gray-100 rounded-lg ">

        <ul class=" flex flex-col shadow-lg border-2 border-terciario-1 gap-2  text-terciario-4 text-lg" aria-labelledby="dropdownDefaultButton">

          <!-- Export CSV  -->
          <li>
            <a href="<?= base_url('institutes/export/csv') ?>" class=" block px-4 py-2 hover:bg-primario hover:text-secundario">
              <?= lang('buttons.export') . " CSV" ?>
            </a>
          </li>

          <!-- Export XLS -->
          <li>
            <a href="<?= base_url('institutes/export/xls') ?>" class=" block px-4 py-2 hover:bg-primario hover:text-secundario">
              <?= lang('buttons.export') . " XLS" ?>
            </a>
          </li>

          <!-- Import CSV -->
          <li>
            <form action="<?= base_url('institutes/import/csv') ?>" method="POST" enctype="multipart/form-data">
              <label for="uploadCSV" class="block px-4 py-2 hover:bg-primario hover:text-secundario">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 mr-2 fill-current inline" viewBox="0 0 32 32">
                  <path d="M23.75 11.044a7.99 7.99 0 0 0-15.5-.009A8 8 0 0 0 9 27h3a1 1 0 0 0 0-2H9a6 6 0 0 1-.035-12 1.038 1.038 0 0 0 1.1-.854 5.991 5.991 0 0 1 11.862 0A1.08 1.08 0 0 0 23 13a6 6 0 0 1 0 12h-3a1 1 0 0 0 0 2h3a8 8 0 0 0 .75-15.956z" data-original="#000000" />
                  <path d="M20.293 19.707a1 1 0 0 0 1.414-1.414l-5-5a1 1 0 0 0-1.414 0l-5 5a1 1 0 0 0 1.414 1.414L15 16.414V29a1 1 0 0 0 2 0V16.414z" data-original="#000000" />
                </svg>
                Import CSV
                <input type="file" id='uploadCSV' name="uploadCSV" class="hidden" />
              </label>
            </form>
          </li>

          <!-- Import XLS -->
          <li>
            <form action="<?= base_url('institutes/import/xls') ?>" method="POST" enctype="multipart/form-data">
              <label for="uploadXLS" class=" block px-4 py-2 hover:bg-primario hover:text-secundario">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 mr-2 fill-current inline" viewBox="0 0 32 32">
                  <path d="M23.75 11.044a7.99 7.99 0 0 0-15.5-.009A8 8 0 0 0 9 27h3a1 1 0 0 0 0-2H9a6 6 0 0 1-.035-12 1.038 1.038 0 0 0 1.1-.854 5.991 5.991 0 0 1 11.862 0A1.08 1.08 0 0 0 23 13a6 6 0 0 1 0 12h-3a1 1 0 0 0 0 2h3a8 8 0 0 0 .75-15.956z" data-original="#000000" />
                  <path d="M20.293 19.707a1 1 0 0 0 1.414-1.414l-5-5a1 1 0 0 0-1.414 0l-5 5a1 1 0 0 0 1.414 1.414L15 16.414V29a1 1 0 0 0 2 0V16.414z" data-original="#000000" />
                </svg>
                Import XLS
                <input type="file" id='uploadXLS' name="uploadXLS" class="hidden" />
              </label>
            </form>
          </li>

          <!-- Plantilla CSV  -->
          <li>
            <a href="<?= base_url('institutes/dowloadCSV') ?>" class="block px-4 py-2 hover:bg-primario hover:text-secundario">Plantilla CSV</a>
          </li>

          <!-- Plantilla XLS  -->
          <li>
            <a href="<?= base_url('institutes/dowloadXLS') ?>" class="block px-4 py-2 hover:bg-primario hover:text-secundario">Plantilla XLS</a>
          </li>
        </ul>
      </div>

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