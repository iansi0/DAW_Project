<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>


<section style="view-transition-name: addTicket;">

    <div>
        <div class="flex">

            <h1 class="text-5xl text-primario"><?= strtoupper(lang("titles.e_ticket")) ?></h1>

        </div>

    </div>

    <form id="form" action="<?= $ticket['id']; ?>" method="POST" class="mt-4 flex flex-col gap-2 px-20">

        <!-- BOTONES -->
        <div class="flex justify-end align-middle">

            <a href="<?= strpos(previous_url(), 'tickets?') !== false
                            ? str_replace('index.php/', '', previous_url())
                            : base_url('/tickets');
                        ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 mr-3 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel")?></a>

            <input type="button" id="submitButton" value="<?= lang("buttons.save")?>" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">

        </div>

        <div class="shadow-xl border-b border-primario rounded-t-xl">

            <div class="col-span-12 text-left mb-3 bg-primario text-white rounded-t-lg p-4">
                <h2 class="text-2xl font-semibold"><?=mb_strtoupper(lang('titles.ticket_2'))?></h2>
            </div>

            <div class="grid grid-cols-12 mt-2 p-4">

                <div class="col-span-6 grid-cols-12 text-left px-2">

                    <!-- NOMBRE CONTACTO -->
                    <div class="col-span-6 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primario"><?= mb_strtoupper(lang("forms.contact_name"))?>*</label>
                        <input type="text" name="nameContact" value="<?= $ticket['nom_persona_contacte_centre']; ?>" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150"></input>
                    </div>

                    <!-- EMAIL CONTACTO -->
                    <div class="col-span-6 grid-cols-12 text-left px-2 mt-2">
                        <label class="font-semibold text-primario"><?=  mb_strtoupper(lang("forms.contact_email"))?>*</label>
                        <input type="text" name="emailContact" value="<?= $ticket['correu_persona_contacte_centre']; ?>" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150"></input>
                    </div>

                    <!-- DISPOSITIVO -->
                    <div class="col-span-6 grid-cols-12 text-left px-2 mt-2">
                        <label class="font-semibold text-primario"><?=  mb_strtoupper(lang("forms.s_disp"))?>*</label>
                        <select name="id_type" id="" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                        <?php
                                foreach ($types as $type) {
                                    if ($type["id"]==$ticket["id_tipus_dispositiu"]) {
                                        echo "<option selected value='".$type["id"]."'>".$type["nom"]."</option>";
                                    } else {
                                        echo "<option value='".$type["id"]."'>".$type["nom"]."</option>";
                                    }
                                    
                                }
                            ?>
                        </select>
                    </div>
                    
                    <!-- ESTADO -->
                    <div class="col-span-6 grid-cols-12 text-left px-2 mt-2">
                        <label class="font-semibold text-primario"><?=  mb_strtoupper(lang("forms.state"))?>*</label>
                        <select name="id_state" id="" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                        <?php
                                foreach ($states as $state) {
                                    if ($state["id"]==$ticket["id_estat"]) {
                                        echo "<option selected value='".$state["id"]."'>".$state["nom"]."</option>";
                                    } else {
                                        echo "<option value='".$state["id"]."'>".$state["nom"]."</option>";
                                    }
                                    
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- DESCRIPCIÓN -->
                <div class="col-span-6 grid-cols-12 text-left px-2">
                    <div class="col-span-12 h-full" style="position: relative;">
                        <label class="text-terciario-4" style="position: absolute; top: 0px; left: 5px;">Descripció* (<span id="char_1">0</span>/200)</label>
                        <textarea class="border-2 border-terciario-1 h-full w-full pt-5 ps-2 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150" name="description" id="description_1" maxlength="200" oninput="sumChar()"><?= $ticket['descripcio_avaria']; ?></textarea>
                    </div>
                </div>
                
                <?php if (((session()->get('user')['role']=="sstt") && $ticket['id_estat']!=6) || (session()->get('user')['role']=="admin") ) : ?>
                    <div class="col-span-6 grid-cols-12 text-left px-4 mt-2">
                        
                        <label class="font-semibold text-primario" for="sender" id="labelSender"><?=  mb_strtoupper(lang("forms.s_ins"))?>*</label>
                        <select name="sender" id="sender" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                            
                            <option value="" disabled selected hidden><?= lang("forms.s_ins")?></option>
                            <?php
                                foreach ($centers as $center) {
                                    if ($center["codi"]==$ticket["codi_centre_emissor"]) {
                                        echo "<option selected value='".$center["codi"]."'>".$center["nom"]."</option>";
                                    } else {
                                        echo "<option value='".$center["codi"]."'>".$center["nom"]."</option>";
                                    }
                                }
                            ?>
                            
                        </select>
                    </div>

                    <div class="col-span-6 grid-cols-12 text-left px-2 mt-2">
                        
                        <label class="font-semibold text-primario" for="repair" id="labelRepair"><?=  mb_strtoupper(lang("forms.s_ins")." ".lang("forms.work"))?></label>
                        <select name="repair" id="repair" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                            <option value="" disabled selected hidden><?= lang("forms.s_ins")?></option>
                            <?php
                                foreach ($repairs as $repair) {
                                    if ($repair["codi"]==$ticket["codi_centre_reparador"]) {
                                        echo "<option selected value='".$repair["codi"]."'>".$repair["nom"]."</option>";
                                    }else{
                                        echo "<option value='".$repair["codi"]."'>".$repair["nom"]."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                <?php else : ?>
                    <input type="text" name="sender" id="sender" hidden value="<?= session()->get('user')['code']; ?>">
                <?php endif ?>
            </div>
        
        </div>

    </form>
</section>

<script>
    document.getElementById('submitButton').addEventListener('click', function() {
        Swal.fire({
            title: `<?=lang('alerts.sure')?>`,
            text: `<?=lang('alerts.sure_sub')?>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `<?=lang('alerts.yes_upd')?>`,
            cancelButtonText: `<?=lang('alerts.cancel')?>`
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: `<?=lang('alerts.updated')?>`,
                    text: `<?=lang('alerts.updated_sub')?>`,
                    icon: 'success'
                }).then(() => {
                    
                    document.getElementById('form').submit();
                });
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function(){
        sumChar();
    })

    function sumChar(){
        var spanElement = document.getElementById('char_1');
        spanElement.innerText = document.getElementById('description_1').value.length;
    }
</script>


<?= $this->endSection() ?>