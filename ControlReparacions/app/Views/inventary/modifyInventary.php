<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>
<h1 class="text-5xl text-primario mt-14"><?= lang("titles.e_ticket")?></h1>

<section style="view-transition-name: addTicket;" class="container mx-auto px-4 py-8 mt-10 text-base">
    <form id="form" action="<?= $product['id']; ?>" method="POST" class="flex flex-col gap-20">

        <div class="grid grid-cols-3 gap-x-2">

             <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.name")?></label>
                <input type="text" name="name" value="<?=$product['nom']; ?>" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
            </div> 


            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.price")?></label>
                <input type="number" name="price" value="<?= $product['preu']; ?>" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 "></input>
            </div>


            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.type_inventary")?></label>
                <select name="type_inventary" id="" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                <?php
                        foreach ($types as $type) {
                            if ($type["id"]==$product["id_tipus_inventari"]) {
                                echo "<option selected value='".$type["id"]."'>".$type["nom"]."</option>";
                            } else {
                                echo "<option value='".$type["id"]."'>".$type["nom"]."</option>";
                            }
                            
                        }
                    ?>
                </select>
            </div>

        </div>

        <div class="flex gap-5 justify-end w-full">

            <a href="<?= strpos(previous_url(), 'inventary?') !== false
                            ? str_replace('index.php/', '', previous_url())
                            : base_url('/inventary');
                        ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel")?></a>

            <input type="button" id="submitButton" value="<?= lang("buttons.save")?>" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">

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
</script>


<?= $this->endSection() ?>