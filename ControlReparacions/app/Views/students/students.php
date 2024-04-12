<?= $this->extend('layouts/master.php') ?>


<?= $this->section('content') ?>
<h1 class="text-center text-7xl text-primario">><?=strtoupper(lang('titles.students_2'))?></h1>


<section class="flex  gap-8 mt-8   mb-5">
    <button class="bg-primario text-white px-5 py-2 hover:bg-terciario-4">+ ><?=lang('buttons.filter')?></button>

    <form action="" class="flex gap-2 w-full">
        <input type="search" id="gsearch" name="gsearch" class="text-black bg-slate-400 ml-auto pl-2  rounded-lg ">
        <input type="submit" class="bg-primario text-white px-5 py-2 hover:bg-terciario-4">
    </form>

    <button id="add-ticket" class="bg-primario text-white px-5 py-2 hover:bg-terciario-4">><?=lang('buttons.add')?></button>
</section>


<!-- <table class="w-full m"> 
    <thead class="bg-primario  text-white">
        <th><?=lang('forms.dni')?>DNI</th>
        <th>Categoria</th> // no veo el de categoria
        <th><?=lang('titles.n_disp')?>Asignar Dispositivo</th>
        <th><?=lang('titles.start')?>Inici</th>
        <th><?=lang('titles.end')?>Ultima</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>y9698374f</td>
            <td>CFGM SMX 1BA</td>
            <td>1234567890</td>
            <td>23-03-24</td>
            <td>24-09-24</td>
        </tr>
        <tr>
            <td class=" bg-gray-200">y9698374f</td>
            <td class=" bg-gray-200">CFGM SMX 1BA</td>
            <td class=" bg-gray-200">1234567890</td>
            <td class=" bg-gray-200">23-03-23</td>
            <td class=" bg-gray-200">23-03-24</td>
        </tr>
        <tr>
            <td>y9698374f</td>
            <td>CFGM SMX 1BA</td>
            <td>1234567890</td>
            <td>23-03-23</td>
            <td>23-03-24</td>
        </tr>
        <tr>
            <td class=" bg-gray-200">y9698374f</td>
            <td class=" bg-gray-200">CFGM SMX 1BA</td>
            <td class=" bg-gray-200">1234567890</td>
            <td class=" bg-gray-200">23-03-23</td>
            <td class=" bg-gray-200">23-03-24</td>
        </tr>
    </tbody>
</table> -->
<?= $this->endSection() ?>