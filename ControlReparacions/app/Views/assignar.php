<?= $this->extend('layouts/master.php') ?>


<?= $this->section('content') ?>
<h1 class="text-center text-7xl text-primario">ASSIGNAR</h1>

<section class="flex  gap-8 mt-8  mb-5">
    <button class="bg-primario text-white px-5 py-2 hover:bg-terciario-4">+Filter</button>

    <form action="" class="flex gap-2 w-full">
        <input type="search" id="gsearch" name="gsearch" class="text-black bg-slate-400 ml-auto pl-2 ">
        <input type="submit" class="bg-primario text-white px-5 py-2 hover:bg-terciario-4">
    </form>

    <button id="add-ticket" class="bg-primario text-white px-5 py-2 hover:bg-terciario-4">Afegir</button>
</section>


<table class="w-full"> 
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
            <td>1234-5678-9012</td>
            <td>Institut Escola del Treball</td>
            <td>caparella</td>
            <td>23-03-24</td>
        </tr>
        <tr>
            <td>1234-5678-9012</td>
            <td>Institut Escola del Treball</td>
            <td>caparella</td>
            <td>23-03-24</td>
        </tr>
        <tr>
            <td>1234-5678-9012</td>
            <td>Institut Escola del Treball</td>
            <td>caparella</td>
            <td>23-03-24</td>
        </tr>
    </tbody>
</table>
<?= $this->endSection() ?>