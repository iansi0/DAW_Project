<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<h1 class="text-2xl text-primario mt-14">FORMULARIO AlUMNO</h1>


<section class="container mx-auto px-4 py-8 mt-10">
    <form action="" class="grid grid-cols-3 gap-x-2">
        <div class="flex items-center">
            <label for="nombre" class="w-20 text-right mr-2">NOMBRE</label>
            <input type="text" id="nombre" name="nombre" class="bg-blue-400 rounded px-2 py-3">
        </div>
        <div class="flex items-center">
            <label for="apellido" class="w-20 text-right mr-2">APELLIDOS</label>
            <input type="text" id="apellido" name="apellido" class="bg-blue-400 rounded px-2 py-3 border-blue-400">
        </div>
        <div class="flex items-center">
            <label for="dni" class="w-16 text-right mr-2">DNI</label>
            <input type="text" id="dni" name="dni" class="bg-blue-400 rounded px-2 py-3">
        </div>
        <div class="flex items-center mt-12 ml-10">
            <label for="dni" class="w-16 text-right mr-2">CURS</label>
            <select id="curso" name="curso" required class="border bg-blue-400 rounded px-2 py-3">
                <option value="">Seleccione uno</option>
                <option value="1">DAW</option>
                <option value="2">DAM</option>
                <option value="3">DAM</option>
                <option value="4">DAW</option>
            </select>
        </div>
        <div class="flex items-center mt-12 ml-14">
            <label for="apellido" class="w-20 text-right mr-2">CLASE</label>
            <select id="curso" name="curso" required class="border bg-blue-400 rounded px-2 py-3">
                <option value="">Seleccione uno</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>
        <div class="flex items-center mt-12 ml-24">
            <label for="dni" class="w-16 text-right mr-2">PROFESOR</label>
            <select id="curso" name="curso" required class="border bg-blue-400 rounded px-2 py-3 ml-5">
                <option value="">Seleccione uno</option>
                <option value="1">ALVER</option>
                <option value="2">DIAZ</option>
                <option value="3">JULIO</option>
                <option value="4">ROMAN</option>
            </select>
        </div>
    </form>
    <div class="flex items-center mt-20">
        <label for="dni" class="w-auto text-right mr-2">ALTRES</label>
        <input type="text" id="dni" name="dni" class="bg-blue-400 rounded px-2 py-3 flex-1">
    </div>
</section>

<div class="flex items-center mt-20 justify-between">
    <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Cancelar</button>
    <div>
        <button class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded">Añadir</button>
        <button class="bg-green-400 hover:bg-green-500 text-white px-4 py-2 rounded ml-4">Guardar</button>
    </div>
</div>



<?= $this->endSection() ?>