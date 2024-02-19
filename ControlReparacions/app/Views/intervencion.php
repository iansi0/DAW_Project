<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<h1 class=" text-center mt-9 bg-primario ml-60">Intervencion</h1>

<div id="imagen" style="margin-bottom: 20px;"> <!-- Añade un margen inferior de 20px -->
    <img src="imagen/aponer" style="width: 10%; height: 20%; " alt="">
</div>

<section>
    <table class=" ml-20 mt-28">
        <thead class="bg-primario">
            <tr>
                <th>Fecha</th>
                <th>Alumne/Profesor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>23-09-22</td>
                <td>123456789F</td>
            </tr>
            <tr>
                <td>23-08-22</td>
                <td>123456789f</td>
            </tr>
            <tr>
                <td>23-09-22</td>
                <td>12345679g</td>
            </tr>
            <tr>
                <td>23-09-22</td>
                <td>12345679g</td>
            </tr>
        </tbody>
    </table>

    <div class=" flex justify-start mt-6 ml-20">
        <button class="bg-primario text-white px-5 py-2 hover:bg-terciario-4 mr-4">star *</button>
        <button class=" bg-primario text-white px-5 py-2 hover:bg-terciario-4">guardar</button>
    </div>
</section>


<?= $this->endSection() ?>
