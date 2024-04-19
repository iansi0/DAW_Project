<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<h1 class="text-center text-7xl text-primario"><?= strtoupper(lang('institute.institute')) ?></h1>

<div class=" ">
  <div class="flex justify-end gap-5">
     <!-- Formulario de búsqueda -->
     <form method='get' action="<?= base_url('/institutes'); ?>" id="searchForm">
      <input type='text' name='q' value='<?= $search ?>' placeholder="Buscar aquí..." class="mb-5 px-5 py-1.5 border-2 border-terciario-3">
      <input type='button' id='btnsearch' value='Buscar' onclick='document.getElementById("searchForm").submit();' class="bg-primario text-white mb-5 px-5 py-2 float-right">
    </form>

    <!-- Botón para exportar -->
    <a href="<?= base_url('export/' . $search . '') ?>">
      <button id="add-institute" class="bg-primario text-white px-5 py-2 hover:bg-terciario-4">Exportar</button>
    </a>

    <!-- Botón para agregar instituto -->
    <a href="<?= base_url('instituteform') ?>">
      <button id="add-institute" class="bg-primario text-white px-5 py-2 hover:bg-terciario-4">Agregar Instituto</button>
    </a>
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
