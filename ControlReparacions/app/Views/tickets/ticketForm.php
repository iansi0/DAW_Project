<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<h1 class="text-2xl text-primario mt-14">FORMULARIO DE AÑADIR TICKET</h1>

<section class="container mx-auto px-4 py-8 mt-10">
    <form action="addticket" method="POST" class="grid grid-cols-3 gap-x-2">

        <div class="flex flex-col mt-5">
            <label class=""><?=lang('forms.')?></label>
            <input type="text" name="description"  class="bg-blue-400 hover:bg-blue-500 text-white px-2 py-3 rounded flex-1">
        </div>

        <div class="flex flex-col mt-5">
            <label  class="">Nom Persona Contacte</label>
            <input type="text" name="nameContact" class="bg-blue-400 hover:bg-blue-500 text-white px-2 py-3 rounded flex-1"></input>
        </div>

        <div class="flex flex-col mt-5">
            <label  class="">Correu Persona Contacte</label>
            <input type="text" name="emailContact" class="bg-blue-400 hover:bg-blue-500 text-white px-2 py-3 rounded flex-1"></input>
        </div>


        <div class="flex flex-col mt-5">
            <label  class="">Tipus</label>
            <select name="id_type" id="" class="bg-blue-400 hover:bg-blue-500 text-white px-2 py-3 rounded flex-1">
                <option value="1">option 1</option>
                <option value="2">option 2</option>
                <option value="3">option 3</option>
                <option value="4">option 4</option>
            </select>
        </div>

<input type="submit" value="Añadir" >
        
    </form>
</section>

<div class="flex items-center mt-20 justify-between">
    <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Cancelar</button>
    <div>
        <button class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded">Añadir</button>
        <button class="bg-green-400 hover:bg-green-500 text-white px-4 py-2 rounded ml-4">Guardar</button>
    </div>
</div>

<?= $this->endSection() ?>
