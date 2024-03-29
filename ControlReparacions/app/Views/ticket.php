<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>
<h1 class="text-center text-7xl text-primario">><?=strtoupper(lang('ticket.ticket'))?></h1>

<button id="add-ticket" class=" bg-primario text-white float-right mb-5 px-5 py-2 hover:bg-terciario-4">+ ><?=lang('ticket.add')?></button>

<table class="w-full ">
  <thead class=" bg-primario text-white">
    <th><?=lang('ticket.ticket')?></th>
    <th><?=lang('ticket.id_device')?></th>
    <th><?=lang('ticket.type')?></th>
    <th><?=lang('ticket.ins')?></th>
    <th><?=lang('ticket.start')?></th>
    <th><?=lang('ticket.last')?></th>
    <th><?=lang('ticket.status')?></th>
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
</table>


<?php
//Imrpimir tabla tickets
 //$table_tickets ?>
<?= $this->endSection() ?>