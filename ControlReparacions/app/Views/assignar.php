<?= $this->extend('layouts/master.php') ?>


<?= $this->section('content') ?>
<h1 class="text-center text-7xl text-primario">ASSIGNAR</h1>

<section class="flex justify-between mt-8">
    <button class="bg-primario text-white mb-5 px-5 py-2 hover:bg-terciario-4">+Filter</button>

    <form action="" class="flex items-center">
        <label for="gsearch" class="hidden">buscador</label>
        <input type="search" id="gsearch" name="gsearch" class="text-black bg-slate-400 ">
        <input type="submit" class="bg-primario text-white hover:bg-terciario-4 ">
    </form>

    <button id="add-ticket" class="bg-primario text-white mb-5 px-5 py-2 hover:bg-terciario-4">Afegir</button>
</section>


<table class="w-full m"> 
    <thead class="bg-primario  text-white">
        <th>Ticket</th>
        <th>Emisor</th>
        <th>Receptor</th>
        <th>Inici</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1234-5678-9012</td>
            <td>Institut Escola del Treball</td>
            <td>caparella</td>
            <td>23-03-24</td>
        </tr>
        <tr>
            <td class=" bg-gray-200">1234-5678-9012</td>
            <td class=" bg-gray-200">Institut Escola del Treball</td>
            <td class=" bg-gray-200">caparella</td>
            <td class=" bg-gray-200">23-03-24</td>
        </tr>
        <tr>
            <td>1234-5678-9012</td>
            <td>Institut Escola del Treball</td>
            <td>caparella</td>
            <td>23-03-24</td>
        </tr>
        <tr>
            <td class=" bg-gray-200">1234-5678-9012</td>
            <td class=" bg-gray-200">Institut Escola del Treball</td>
            <td class=" bg-gray-200">caparella</td>
            <td class=" bg-gray-200">23-03-24</td>
        </tr>
    </tbody>
</table>
<?= $this->endSection() ?>