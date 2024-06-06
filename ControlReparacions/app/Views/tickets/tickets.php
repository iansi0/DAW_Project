<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>

<style>
  #add-ticket {
    view-transition-name: addTicket;

  }
</style>

<div>

  <div class="flex justify-between items-center mb-1">

    <h1 class="text-left text-5xl text-primario"><?= strtoupper(lang('titles.ticket')) ?></h1>

  </div>

  <div class="flex justify-between items-center mb-1">

    <div class="flex gap-3 items-center center">
      <!-- Search form -->
      <form method='get' action="<?= base_url('tickets'); ?>" id="searchForm">
        <!-- INPUT SEARCH -->
        <input type='text' id="inputSearch" name='q' value='<?= $search ?>' placeholder="<?= lang('buttons.search') ?>..." class=" px-5 py-1 w-48  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
        <!-- BUTTON SEARCH -->
        <button id='btnsearch' onclick='document.getElementById("filters_form").submit();' class="bg-primario text-white px-2 py-1 border border-terciario-4 hover:bg-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
      <!-- BUTTON SHOW FILTERS -->
      <button id='btn_filters' onclick='toggleFilters()' class="bg-primario text-white px-2 py-1 border border-terciario-4 hover:bg-red-300 cursor-pointer hover:text-terciario-4 rounded-lg transition hover:ease-in ease-out duration-250"><i class="fa-solid fa-filter"></i></button>
      <!-- BUTTON ADD TICKET -->
      <?php if ((session()->get('user')['role'] == "sstt") || (session()->get('user')['role'] == "prof") || (session()->get('user')['role'] == "ins") || (session()->get('user')['role'] == "admin")) : ?>
        <a href="<?= base_url('tickets/add') ?>">
          <button id='add-ticket' class="bg-primario text-white px-2 py-1 border border-terciario-4 hover:bg-green-700 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250"><i class="fa-solid fa-plus"></i></button>
        </a>
      <?php endif ?>
    </div>


    <!-- Dropdown menu -->
    <?php if ((session()->get('user')['role'] == "sstt") || (session()->get('user')['role'] == "ins")  || (session()->get('user')['role'] == "prof") || (session()->get('user')['role'] == "admin")) : ?>

      <div class="relative">
        <button id="dropdownDefaultButton" class="text-white bg-primario hover:bg-terciario-4 rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center" type="button">Dropdown button <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
          </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="dropdown" class="absolute z-10 w-full  bg-white divide-y divide-gray-100 rounded-lg ">

          <ul class=" flex flex-col shadow-lg border-2 border-terciario-1 gap-2  text-terciario-4 text-lg" aria-labelledby="dropdownDefaultButton">

            <!-- Export CSV  -->
            <li>
              <a href="<?= base_url('export/csv?q=' . $search . "&d=" . $filters['device'] . "&c=" . $filters['center'] . "&dt_1=" . $filters['date_ini'] . "&dt_2=" . $filters['date_end'] . "&tm_1=" . $filters['time_ini'] . "&tm_2=" . $filters['time_end'] . "&e=" . $filters['state']) ?>">
                <button id="csv" class=" px-8  py-1 border border-terciario-4  rounded-lg  transition hover:ease-in ease-out duration-250"><?= lang('buttons.export') . " CSV" ?></button>
              </a>
            </li>

            <!-- Export XLS -->
            <li>
              <a href="<?= base_url('export/xls?q=' . $search . "&d=" . $filters['device'] . "&c=" . $filters['center'] . "&dt_1=" . $filters['date_ini'] . "&dt_2=" . $filters['date_end'] . "&tm_1=" . $filters['time_ini'] . "&tm_2=" . $filters['time_end'] . "&e=" . $filters['state']) ?>">
                <button id="xls" class=" bg-primario text-white px-8 py-1 border border-terciario-4  rounded-lg  hover:bg-terciario-4 transition hover:ease-in ease-out duration-250"><?= lang('buttons.export') . " XLS" ?></button>
              </a>
            </li>

            <!-- Import CSV -->
            <li>
              <form action="subircsv" method="POST">

                <label for="uploadCSV" class="flex bg-gray-800 hover:bg-gray-700 text-white text-base px-5 py-3 outline-none rounded w-max cursor-pointer mx-auto font-[sans-serif]">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 mr-2 fill-white inline" viewBox="0 0 32 32">
                    <path d="M23.75 11.044a7.99 7.99 0 0 0-15.5-.009A8 8 0 0 0 9 27h3a1 1 0 0 0 0-2H9a6 6 0 0 1-.035-12 1.038 1.038 0 0 0 1.1-.854 5.991 5.991 0 0 1 11.862 0A1.08 1.08 0 0 0 23 13a6 6 0 0 1 0 12h-3a1 1 0 0 0 0 2h3a8 8 0 0 0 .75-15.956z" data-original="#000000" />
                    <path d="M20.293 19.707a1 1 0 0 0 1.414-1.414l-5-5a1 1 0 0 0-1.414 0l-5 5a1 1 0 0 0 1.414 1.414L15 16.414V29a1 1 0 0 0 2 0V16.414z" data-original="#000000" />
                  </svg>
                  Import CSV
                  <input type="file" id='uploadCSV' class="hidden" />
                </label>
              </form>
            </li>

            <!-- Import XLS -->
            <li>
              <form action="subirxls" method="POST">
                <label for="uploadXLS" class="flex bg-gray-800 hover:bg-gray-700 text-white text-base px-5 py-3 outline-none rounded w-max cursor-pointer mx-auto font-[sans-serif]">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 mr-2 fill-white inline" viewBox="0 0 32 32">
                    <path d="M23.75 11.044a7.99 7.99 0 0 0-15.5-.009A8 8 0 0 0 9 27h3a1 1 0 0 0 0-2H9a6 6 0 0 1-.035-12 1.038 1.038 0 0 0 1.1-.854 5.991 5.991 0 0 1 11.862 0A1.08 1.08 0 0 0 23 13a6 6 0 0 1 0 12h-3a1 1 0 0 0 0 2h3a8 8 0 0 0 .75-15.956z" data-original="#000000" />
                    <path d="M20.293 19.707a1 1 0 0 0 1.414-1.414l-5-5a1 1 0 0 0-1.414 0l-5 5a1 1 0 0 0 1.414 1.414L15 16.414V29a1 1 0 0 0 2 0V16.414z" data-original="#000000" />
                  </svg>
                  Import XLS
                  <input type="file" id='uploadXLS' class="hidden" />
                </label>
              </form>
            </li>

            <!-- Imprimir PDF  -->
            <li>
              <a href="<?= base_url('TicketsPDF?q=' . $search . "&d=" . $filters['device'] . "&c=" . $filters['center'] . "&dt_1=" . $filters['date_ini'] . "&dt_2=" . $filters['date_end'] . "&tm_1=" . $filters['time_ini'] . "&tm_2=" . $filters['time_end'] . "&e=" . $filters['state']) ?>" 
              class="block px-4 py-2 hover:bg-primario hover:text-secundario">Imprimir PDF</a>
            </li>

            <!-- Etiquetas PDF  -->
            <li>
              <a href="<?= base_url('EtiquetasPDF?q=' . $search . "&d=" . $filters['device'] . "&c=" . $filters['center'] . "&dt_1=" . $filters['date_ini'] . "&dt_2=" . $filters['date_end'] . "&tm_1=" . $filters['time_ini'] . "&tm_2=" . $filters['time_end'] . "&e=" . $filters['state']) ?>" 
                class="block px-4 py-2 hover:bg-primario hover:text-secundario">Etiquetes PDF</a>
            </li>

            <!-- Plantilla CSV  -->
            <li>
              <a href="<?= base_url('dowloadCSV') ?>" class="block px-4 py-2 hover:bg-primario hover:text-secundario">Plantilla CSV</a>
            </li>

            <!-- Plantilla XLS  -->
            <li>
              <a href="<?= base_url('dowloadXLS') ?>" class="block px-4 py-2 hover:bg-primario hover:text-secundario">Plantilla XLS</a>
            </li>
          </ul>
        </div>

      </div>

    <?php endif ?>

  </div>

  <!-- Filters -->
  <form id="filters_form" action="<?= base_url('tickets') ?>" method="get" class="hidden relative gap-4 items-center mb-2 mt-2 border-y-2 p-3">
    <input type="hidden" id="search_hidden" name="q" value="<?= $search ?>">

    <!-- DATALIST DISPOSITIVOS -->
    <div class='relative searchable-device-list'>
      <input name="d" id="f_devices" type='text' value="<?= $filters['device'] ?>" style="width: 165px; overflow: hidden;text-overflow: ellipsis;" class='data-device-list peer h-10 rounded-sm bg-white cursor-pointer outline-none text-gray-700
              caret-gray-800 pl-2 pr-7 focus:bg-gray-200 font-bold transition-all duration-300 text-sm text-overflow-ellipsis ' spellcheck="false" placeholder="<?= lang('forms.s_disp') ?>">
      <svg class="outline-none cursor-pointer fill-gray-400 absolute transition-all duration-200 h-full w-4 -rotate-90 right-2 top-[50%] -translate-y-[50%]" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <path d="M0 256l512 512L1024 256z"></path>
      </svg>
      <ul class='absolute option-device-list overflow-y-scroll max-h-64 min-h-[0px] flex flex-col top-12 
              left-0 max-w-[120%] min-w-[120%] bg-white rounded-sm scale-0 opacity-0 
              transition-all 
              duration-200 origin-top-left'>
      </ul>
    </div>

    <!-- DATALIST CENTROS -->
    <div class='relative searchable-center-list'>
      <input name="c" id="f_centers" type='text' value="<?= $filters['center'] ?>" style="width: 165px; overflow: hidden;text-overflow: ellipsis;" class='data-center-list peer h-10 rounded-sm bg-white cursor-pointer outline-none text-gray-700
              caret-gray-800 pl-2 pr-7 focus:bg-gray-200 font-bold transition-all duration-300 text-sm text-overflow-ellipsis ' spellcheck="false" placeholder="<?= lang('forms.s_ins') ?>">
      <svg class="outline-none cursor-pointer fill-gray-400 absolute transition-all duration-200 h-full w-4 -rotate-90 right-2 top-[50%] -translate-y-[50%]" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <path d="M0 256l512 512L1024 256z"></path>
      </svg>
      <ul class='absolute option-center-list overflow-y-scroll max-h-64 min-h-[0px] flex flex-col top-12 
              left-0 max-w-[120%] min-w-[120%] bg-white rounded-sm   scale-0 opacity-0 
              transition-all 
              duration-200 origin-top-left'>
      </ul>
    </div>

    <!-- DATALIST ESTADOS -->
    <div class='relative searchable-state-list'>
      <input name="e" id="f_states" type='text' value="<?= $filters['state'] ?>" style="width: 165px; overflow: hidden;text-overflow: ellipsis;" class='data-state-list peer h-10 rounded-sm bg-white cursor-pointer outline-none text-gray-700
              caret-gray-800 pl-2 pr-7 focus:bg-gray-200 font-bold transition-all duration-300 text-sm text-overflow-ellipsis ' spellcheck="false" placeholder="<?= lang('forms.s_state') ?>">
      <svg class="outline-none cursor-pointer fill-gray-400 absolute transition-all duration-200 h-full w-4 -rotate-90 right-2 top-[50%] -translate-y-[50%]" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <path d="M0 256l512 512L1024 256z"></path>
      </svg>
      <ul class='absolute option-state-list overflow-y-scroll max-h-64 min-h-[0px] flex flex-col top-12 
              left-0 max-w-[120%] min-w-[120%] bg-white rounded-sm   scale-0 opacity-0 
              transition-all 
              duration-200 origin-top-left'>
      </ul>
    </div>

    <!-- FECHA -->
    <div class="flex justify-between gap-3">
      <div class="flex">
        <input id="dt_1" name="dt_1" type="date" value="<?= $filters['date_ini'] ?>" class=" px-2 py-1 w-32  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      </div>

      <span class="flex items-center"><i class="fa-solid fa-arrow-right"></i></span>

      <div class="flex ">
        <input id="dt_2" name="dt_2" type="date" value="<?= $filters['date_end'] ?>" class=" px-2 py-1 w-32  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      </div>
    </div>

    <!-- HORA -->
    <div class="flex justify-between gap-3">
      <div class="flex ">
        <input id="tm_1" name="tm_1" type="time" value="<?= $filters['time_ini'] ?>" class=" px-2 py-1   border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      </div>

      <span class="flex items-center"><i class="fa-solid fa-arrow-right"></i></span>

      <div class="flex ">
        <input id="tm_2" name="tm_2" type="time" value="<?= $filters['time_end'] ?>" class=" px-2 py-1  border-2 rounded-lg border-terciario-3 hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
      </div>

    </div>

    <div class="absolute right-2">
      <button onclick='document.getElementById("filters_form").submit();' class="bg-primario text-white px-8 py-1 border border-terciario-4 rounded-lg hover:bg-terciario-4 transition hover:ease-in ease-out duration-250"><?= lang('buttons.filter') ?></button>
      <a href="<?= base_url('tickets') ?>" class="bg-primario text-white px-8 py-1 border border-terciario-4 rounded-lg hover:bg-red-500 transition hover:ease-in ease-out duration-250"><?= lang('buttons.clear') ?></a>
    </div>

  </form>

  <?php // TABLE GENERATED WITH TABLE-GEN-HELPER
  echo $table->generate();
  ?>

  <!-- Paginate -->
  <div>
    <?php // LA FUNCION DE ->only() ES LA QUE MANTIENE LA BUSQUEDA Y FILTROS EN LA URL SIN RESETEARLOS 
    ?>
    <?= $pager->only(['q', 'd', 'c', 'dt_1', 'dt_2', 'tm_1', 'tm_2', 'e'])->links() ?>
  </div>

</div>

<script>
  document.addEventListener("DOMContentLoaded", function(event) {

    // FUNCIONES DE SHOW / HIDE DE DROPDOWN USUARIO
    var dropdown = document.querySelector("#dropdown");


    window.addEventListener('click', function(event) {

      if (event.target.id != 'dropdown' || event.target.closest('div').id != 'dropdown') {
        if (event.target && (event.target.id === 'dropdownDefaultButton' || (event.target.closest('div') && event.target.closest('div').id === 'dropdownDefaultButton'))) {
          if (dropdown.style.display == "none") {
            dropdown.style.display = "block";
          } else {
            dropdown.style.display = "none";
          }
        } else {
          dropdown.style.display = "none";
        }
      }

    })
  })


  const uploadCSV = document.getElementById('uploadCSV');
  const uploadXLS = document.getElementById('uploadXLS');

  uploadCSV.addEventListener('change', function() {
    if (this.files && this.files[0]) {
      let parentForm = uploadCSV.parentElement.parentElement;

      (function() {
        Swal.fire({
          customClass: {
            htmlContainer: ``,
          },
          title: `<?= lang('alerts.sure') ?>`,
          text: `<?= lang('alerts.sure_sub') ?> "`,
          icon: `warning`,
          showCancelButton: true,
          confirmButtonColor: `#3085d6`,
          cancelButtonColor: `#d33`,
          confirmButtonText: `<?= lang('alerts.yes_del') ?>`,
          cancelButtonText: `<?= lang('alerts.cancel') ?>`,
        }).then((result) => {
          if (result.isConfirmed) {
            parentForm.submit();
          }
          uploadCSV.value = '';
        });
      })()

    }
  })

  uploadXLS.addEventListener('change', function() {
    if (this.files && this.files[0]) {
      let parentForm = uploadXLS.parentElement.parentElement;

      (function() {
        Swal.fire({
          customClass: {
            htmlContainer: ``,
          },
          title: `<?= lang('alerts.sure') ?>`,
          text: `<?= lang('alerts.sure_sub') ?> "`,
          icon: `warning`,
          showCancelButton: true,
          confirmButtonColor: `#3085d6`,
          cancelButtonColor: `#d33`,
          confirmButtonText: `<?= lang('alerts.yes_del') ?>`,
          cancelButtonText: `<?= lang('alerts.cancel') ?>`,
        }).then((result) => {
          if (result.isConfirmed) {
            parentForm.submit();
          }
          uploadXLS.value = '';
        });
      })()

    }
  })



  // Funcion para mostrar/esconder los filtros
  function toggleFilters() {

    var filters = document.getElementById("filters_form");

    if (filters.classList.contains('hidden')) {
      filters.classList.remove('hidden');
      filters.classList.add('flex');
      document.getElementById('btn_filters').classList.add('bg-red-300')
      document.getElementById('btn_filters').classList.remove('text-white')
      document.getElementById('btn_filters').classList.add('text-terciario-4')
    } else {
      filters.classList.add('hidden');
      document.getElementById('btn_filters').classList.remove('bg-red-300')
      document.getElementById('btn_filters').classList.add('text-white')
      document.getElementById('btn_filters').classList.remove('text-terciario-4')
    }

  }

  // Funcion para resetear los filtros
  function resetForm() {
    event.preventDefault();
    document.getElementById("filters_form").reset();
    document.getElementById("f_devices").value = '';
    document.getElementById("f_centers").value = '';
    document.getElementById("f_states").value = '';
  }

  // CREADOR DE DATALIST DISPOSITIVOS
  const dataList_device = new DataList('searchable-device-list', 'data-device-list', 'option-device-list', 'option-device');
  // Inicializamos
  dataList_device.init();
  // Generamos el array de opciones 
  var devicesJSON = `<?php echo json_encode($arrFilters['devices']) ?>`;
  var devices = JSON.parse(devicesJSON);
  var arrDevices = [];
  devices.forEach(element => {
    arrDevices.push(element['nom'])
  });
  // Añadimos cada elemento al dataList_device
  arrDevices.forEach(v => (dataList_device.append(v)));

  // CREADOR DE DATALIST CENTROS
  const dataList_center = new DataList('searchable-center-list', 'data-center-list', 'option-center-list', 'option-center');
  // Inicializamos
  dataList_center.init();
  // Generamos el array de opciones 
  var centersJSON = `<?php echo json_encode($arrFilters['centers']) ?>`;
  var centers = JSON.parse(centersJSON);
  var arrCenters = [];
  centers.forEach(element => {
    arrCenters.push(element['nom'])
  });
  // Añadimos cada elemento al dataList_center
  arrCenters.forEach(v => (dataList_center.append(v)));

  // CREADOR DE DATALIST ESTADOS
  const dataList_state = new DataList('searchable-state-list', 'data-state-list', 'option-state-list', 'option-state');
  // Inicializamos
  dataList_state.init();
  // Generamos el array de opciones 
  var statesJSON = `<?php echo json_encode($arrFilters['states']) ?>`;
  var states = JSON.parse(statesJSON);
  var arrStates = [];
  states.forEach(element => {
    arrStates.push(element['nom'])
  });
  // Añadimos cada elemento al dataList_state
  arrStates.forEach(v => (dataList_state.append(v)));

  document.getElementById("inputSearch").addEventListener('keypress', function() {
    document.getElementById('search_hidden').value = this.value;
  })
</script>

<?= $this->endSection() ?>