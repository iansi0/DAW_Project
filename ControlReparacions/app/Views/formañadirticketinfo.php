<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<h1 class="text-2xl text-primario mt-14">FORMULARIO DE AÑADIR TICKET INFO</h1>


<section class="container mx-auto px-4 py-8 mt-10">
    <form action="" class="grid grid-cols-3 gap-x-2">
        <div class="flex items-center">
            <label class="w-20 text-right mr-2">Asunto</label>
            <input type="text"  class="bg-blue-400 hover:bg-blue-500 text-white px-2 py-3 rounded flex-1">
        </div>
        <div class="flex items-center mt-5">
            <label  class="w-20 text-right mr-2">Descripción</label>
            <input type="text" class="bg-blue-400 hover:bg-blue-500 text-white px-2 py-3 rounded flex-1"></input>
        </div>
        <div class="flex items-center mt-5">
            <label  class="w-20 text-right mr-2">Prioridad</label>
            <select  class=" border bg-blue-400 hover:bg-blue-500 text-white px-2 py-3 rounded flex-1">
                <option value="">Seleccione una prioridad</option>
                <option value="alta">Alta</option>
                <option value="media">Media</option>
                <option value="baja">Baja</option>
            </select>
        </div>
        <div class="flex items-center mt-5">
            <label  class="w-20 text-right mr-2">Categoría</label>
            <select class="bg-blue-400 hover:bg-blue-500 text-white px-2 py-3 rounded flex-1">
                <option value="">Seleccione una categoría</option>
                <option value="software">Software</option>
            </select>
        </div>
        <div class="flex items-center mt-5">
            <label  class="w-20 text-right mr-2">Fecha Límite</label>
            <input type="date" id="fecha_limite" name="fecha_limite" class="bg-blue-400 hover:bg-blue-500 text-white px-2 py-3 rounded flex-1">
        </div>
        <div class="flex items-center mt-5">
            <label  class="w-20 text-right mr-2">Estado</label>
            <select  class=" border bg-blue-400 hover:bg-blue-500 text-white px-2 py-3 rounded flex-1">
                <option value="">Seleccione un estado</option>
                <option value="abierto">Abierto</option>
                <option value="cerrado">Cerrado</option>
                <option value="pendiente">Pendiente</option>
            </select>
        </div>
        <div class="flex items-center mt-5">
            <label class="w-20 text-right mr-2">Fecha Creación</label>
            <input type="date" id="fecha_creacion" name="fecha_creacion" class="bg-blue-400 hover:bg-blue-500 text-white px-2 py-3 rounded flex-1">
        </div>
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