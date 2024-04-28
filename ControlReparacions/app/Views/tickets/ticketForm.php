<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<h1 class="text-5xl text-primario mt-14"><?= lang("titles.n_ticket")?></h1>

<section style="view-transition-name: addTicket;" class="container mx-auto px-4 py-8 mt-10 text-base">
    <form action="add" method="POST" class="flex flex-col gap-20">

        <div class="grid grid-cols-3 gap-x-2">

            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.description")?></label>
                <input type="text" name="description" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
            </div>

            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.contact_name")?></label>
                <input type="text" name="nameContact" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 "></input>
            </div>

            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.contact_email")?></label>
                <input type="text" name="emailContact" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 "></input>
            </div>


            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.s_disp")?></label>
                <select name="id_type" id="" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                <option value="" disabled selected hidden><?= lang("forms.s_disp")?></option>
                <?php
                        foreach ($types as $type) {
                            echo "<option value='".$type["id"]."'>".$type["nom"]."</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="flex flex-col justify-end  mt-5">
                
                <label class="block" for="sender" id="labelsSender"><?= lang("forms.s_ins")?></label>
                <select name="sender" id="sender" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                    
                    <option value="" disabled selected hidden><?= lang("forms.s_ins")?></option>
                    <?php
                        foreach ($centers as $center) {
                            echo "<option value='".$center["codi"]."'>".$center["nom"]."</option>";
                        }
                    ?>
                    
                </select>
            </div>

            <div class="flex flex-col justify-end  mt-5">

                <button type="button" id="assignButton" class="bg-primario text-white px-2 py-3  hover:bg-terciario-4 bg-primario text-white px-8 py-1 border border-terciario-4 hover:bg-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250"><?= lang("forms.s_ins")." ".lang("forms.work")?></button>
                
                <label class="hidden" for="repair" id="labelRepair"><?= lang("forms.s_ins")." ".lang("forms.work")?></label>
                <select name="repair" id="repair" class="border-2 border-terciario-1 px-2 py-3 rounded  hidden hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                    <option value="" disabled selected hidden><?= lang("forms.s_ins")?></option>
                    <?php
                        foreach ($repairs as $repair) {
                            echo "<option value='".$repair["codi"]."'>".$repair["nom"]."</option>";
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="flex gap-5">

            <a href="<?= strpos(previous_url(), 'tickets?') !== false
                            ? str_replace('index.php/', '', previous_url())
                            : base_url('/tickets');
                        ?>" class="bg-primario hover:bg-red-600 text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel")?></a>

            <input type="submit" value="<?= lang("buttons.add")?>" class="bg-green-700 hover:bg-green-500 text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">

        </div>

    </form>
</section>

<script>
    const botonMostrar = document.getElementById('assignButton');
    const labelSelect = document.getElementById('labelRepair');
    const contenedorSelect = document.getElementById('repair');

    botonMostrar.addEventListener('click', () => {
        labelSelect.style.display = 'block';
        contenedorSelect.style.display = 'block';
        botonMostrar.style.display = 'none';
    });
</script>

<?= $this->endSection() ?>