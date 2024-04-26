<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<h1 class="text-2xl text-primario mt-14">FORMULARIO DE AÑADIR TICKET</h1>

<section class="container mx-auto px-4 py-8 mt-10 text-base">
    <form action="addticket" method="POST" class="flex flex-col gap-20">

        <div class="grid grid-cols-3 gap-x-2">

            <div class="flex flex-col mt-5">
                <label class="">Descripción de la avaria</label>
                <input type="text" name="description" class="border-2 border-terciario-1 px-2 py-3 rounded ">
            </div>

            <div class="flex flex-col mt-5">
                <label class="">Nom Persona Contacte</label>
                <input type="text" name="nameContact" class="border-2 border-terciario-1 px-2 py-3 rounded "></input>
            </div>

            <div class="flex flex-col mt-5">
                <label class="">Correu Persona Contacte</label>
                <input type="text" name="emailContact" class="border-2 border-terciario-1 px-2 py-3 rounded"></input>
            </div>


            <div class="flex flex-col mt-5">
                <label class="">Tipus de dispositiu</label>
                <select name="id_type" id="" class="border-2 border-terciario-1 px-2 py-3 rounded ">
                <option value="" disabled selected hidden>Seleccioni un tipus de dispositiu</option>
                    <option value="1">Ordinador sobretaula</option>
                    <option value="2">Proyector</option>
                    <option value="3">Portatil</option>
                </select>
            </div>

            <div class="flex flex-col justify-end  mt-5">

                <button type="button" id="assignButton" class="bg-primario text-white px-2 py-3  hover:bg-terciario-4">Assignar centro reparador</button>
                
                <label class="hidden" for="institute" id="labelInstitute">Institut reparador</label>
                <select name="institute" id="institute" class="border-2 border-terciario-1 px-2 py-3 rounded  hidden">
                    <option value="" disabled selected hidden>Seleccioni un institut reparador</option>
                    <option value="1">Institut Caparella</option>
                </select>
            </div>
        </div>

        <div class="flex gap-5">

            <a href="<?= base_url('/tickets') ?>" class="bg-primario hover:bg-red-600 text-white px-4 py-2 rounded">Cancelar</a>

            <input type="submit" value="Añadir" class="bg-green-700 hover:bg-green-500 text-white px-4 py-2 rounded">

        </div>

    </form>
</section>

<script>
    const botonMostrar = document.getElementById('assignButton');
    const labelSelect = document.getElementById('labelInstitute');
    const contenedorSelect = document.getElementById('institute');

    botonMostrar.addEventListener('click', () => {
        labelSelect.style.display = 'block';
        contenedorSelect.style.display = 'block';
        botonMostrar.style.display = 'none';
    });
</script>

<?= $this->endSection() ?>