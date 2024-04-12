<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<h1 class=" text-center mt-9 bg-primario ml-80 text-5xl" style="margin-top: 9%;">><?=strtoupper(lang('titles.int_2'))?></h1>

<div id="imagen" style="margin-bottom: 20px;"> <!-- Añade un margen inferior de 20px -->
    <img src="imagen/aponer" style="width: 10%; height: 20%; " alt="">
</div>

<section class="w-full">
    <table class="table-auto border border-primario ml-20 ">
        <thead class="bg-primario text-white">
            <tr>
                <th>Fecha</th>
                <th>Alumno/Profesor</th>
            </tr>
        </thead>
        <tbody class="text-primario">
            <tr>
                <td>23-09-22</td>
                <td>123456789F</td>
            </tr>
            <tr class="bg-gray-200">
                <td>23-08-22</td>
                <td>123456789f</td>
            </tr>
            <tr>
                <td>23-09-22</td>
                <td>12345679g</td>
            </tr>
            <tr class="bg-gray-200">
                <td>23-09-22</td>
                <td>12345679g</td>
            </tr>
        </tbody>
    </table>

    <div class="flex justify-start mt-6 ml-20">
        <button class="bg-primario text-white px-5 py-2 rounded hover:bg-terciario-4 mr-4">><?=lang('titles.start')?>star*</button>
        <button class="bg-primario text-white px-5 py-2 rounded hover:bg-terciario-4">><?=lang('buttons.save')?>guardar</button>
    </div>
</section>

<section class="mt-10">
    <table class="table-auto border border-primario w-8/12 ml-96 -mt-44">
        <thead class="bg-primario text-white">
            <tr>
                <th>Material</th>
                <th></th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody class="text-black">
            <tr>
                <td>Memoria Ram</td>
                <td>2</td>
                <td>He probat amb un tester si arriba la electricitat</td>
            </tr>
            <tr class="bg-gray-200">
                <td>y9698374f</td>
                <td>2</td>
                <td>He probat amb un tester si arriba la electricitat</td>
            </tr>
            <tr>
                <td>y9698374f</td>
                <td>2</td>
                <td>He probat amb un tester si arriba la electricitat</td>
            </tr>
            <tr class="bg-gray-200">
                <td>y9698374f</td>
                <td>2</td>
                <td>He probat amb un tester si arriba la electricitat</td>
            </tr>
        </tbody>
        <thead class="bg-primario text-white hover:bg-slate-400 text-right mr-11">
            <tr>
                <td>Total</td>
            </tr>
        </thead>
    </table>
    
</section>


<?= $this->endSection() ?>