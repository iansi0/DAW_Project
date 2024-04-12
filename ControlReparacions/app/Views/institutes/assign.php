<?= $this->extend('layouts/master.php') ?>

<?= $this->section('content') ?>
<h1 class="text-center text-7xl text-primario">><?=strtoupper(lang('titles.ticket'))?></h1>

<button id="add-ticket" class=" bg-primario text-white float-right mb-5 px-5 py-2 hover:bg-terciario-4">+><?=lang('buttons.add')?></button>


<!-- <table class="w-full ">
  <thead class=" bg-primario text-white">
    <th><?=lang('titles.ticket_2')?>Ticket</th>
    <th><?=lang('titles.disp')?>ID_Disp</th>
    <th><?=lang('titles.type')?>Type</th>
    <th><?=lang('titles.ins')?>Institut</th>
    <th><?=lang('titles.start')?>Inici</th>
    <th>Última</th> // falta por que no hay botton creo yo 
    <th><?=lang('forms.state')?>Estat</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1234-5678-9012</td>
      <td>1234567890</td>
      <td>Portatil</td>
      <td>Institut Escola del Treball</td>
      <td>22-10-2023</td>
      <td>22-10-2023</td>
      <td>En reparació</td>
    </tr>
    <tr>
      <td>1234-5678-9032</td>
      <td>1234577890</td>
      <td>Projector</td>
      <td>Institut Escola del Treball</td>
      <td>22-10-2023</td>
      <td>22-10-2023</td>
      <td>Reparat</td>
    </tr>
    <tr>
      <td>2134-5678-9012</td>
      <td>987654311</td>
      <td>Torre</td>
      <td>Institut Escola del Treball</td>
      <td>22-10-2023</td>
      <td>22-10-2023</td>
      <td>Preparat per recollir</td>
    </tr>
    <tr>
      <td>1234-5678-9012</td>
      <td>098765432</td>
      <td>Pantalla</td>
      <td>Institut Escola del Treball</td>
      <td>22-10-2023</td>
      <td>22-10-2023</td>
      <td>Validat i reparat</td>
    </tr>
    <tr>
      <td>1234-5678-9012</td>
      <td>098765434</td>
      <td>Portatil</td>
      <td>Institut Escola del Treball</td>
      <td>22-10-2023</td>
      <td>22-10-2023</td>
      <td>Espatllat</td>
    </tr>
    <tr>
      <td>1234-5678-9999</td>
      <td>1234567899</td>
      <td>Portatil</td>
      <td>Institut Escola del Treball</td>
      <td>22-10-2023</td>
      <td>22-10-2023</td>
      <td>Desguaçat</td>
    </tr>
  </tbody>
</table> -->

<!-- 
 Search form  
<form method='get' action="<?php // base_url('tickets'); ?>" id="searchForm">
  <input type='text' name='q' value='<?php // $search ?>' placeholder="Search here...">
  <input type='button' id='btnsearch' value='Cercar' onclick='document.getElementById("searchForm").submit();'>
</form>
-->

<!--Tabla 
<?php
//echo $table->generate($news);
?>

Paginacion 
<div style='margin-top: 10px;'>
  <?php
   //$pager->only(['q'])->links(); ?>
</div> -->


<?= $this->endSection() ?>