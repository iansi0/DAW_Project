<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<div style="view-transition-name: addTicket;">
    <div class="flex">

        <h1 class="text-5xl text-primario"><?= mb_strtoupper(lang("titles.e_inventory")) ?></h1>

    </div>

    <form id="form" action="<?= $product['id']; ?>" method="POST" class="mt-4 flex flex-col gap-2 px-20">

        <!-- BOTONES -->
        <div class="flex justify-end align-middle">

            <a href="<?= strpos(previous_url(), 'inventary?') !== false
                            ? str_replace('index.php/', '', previous_url())
                            : base_url('/inventary');
                        ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 mr-3 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel") ?></a>

            <input type="submit" value="<?= lang("buttons.save") ?>" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">

        </div>

        <div class="shadow-xl border-b border-primario rounded-t-xl">
            <div class="col-span-12 text-left mb-3 bg-primario text-white rounded-t-lg p-4">
                <h2 class="text-2xl font-semibold"><?=mb_strtoupper(lang('titles.inventory_2'))?></h2>
            </div>

            <div class="grid grid-cols-12 mt-2 mb-3 p-4">

                <div class="col-span-12 grid grid-cols-12">

                    <div class="col-span-4 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primary"><?= mb_strtoupper(lang("forms.name")) ?>*</label>
                        <input type="text" name="name" value="<?= $product['nom']; ?>" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                        <?php
                        if (isset(validation_errors()['name'])) : ?>
                            <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['name'] ?></p>
                        <?php endif ?>
                    </div>


                    <div class="col-span-4 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primary"><?= mb_strtoupper(lang("forms.price")) ?>*</label>
                        <input type="text" name="price" value="<?= $product['preu']; ?>" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150"></input>
                        <?php
                        if (isset(validation_errors()['price'])) : ?>
                            <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['price'] ?></p>
                        <?php endif ?>
                    </div>


                    <div class="col-span-4 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primary"><?= mb_strtoupper(lang("forms.type_inventary")) ?>*</label>
                        <select name="type_inventary" id="" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                            <?php foreach ($types as $type): ?>
                                <option value='<?=$type["id"]?>' <?=($type["id"] == $product["id_tipus_inventari"])?'selected':''?>><?=$type["nom"]?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php
                        if (isset(validation_errors()['type_inventary'])) : ?>
                            <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['type_inventary'] ?></p>
                        <?php endif ?>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('submitButton').addEventListener('click', function() {
        Swal.fire({
            title: `<?= lang('alerts.sure') ?>`,
            text: `<?= lang('alerts.sure_sub') ?>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `<?= lang('alerts.yes_upd') ?>`,
            cancelButtonText: `<?= lang('alerts.cancel') ?>`
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: `<?= lang('alerts.updated') ?>`,
                    text: `<?= lang('alerts.updated_sub') ?>`,
                    icon: 'success',
                    showConfirmButton: false,
                    timer:2000,
                }).then(() => {

                    document.getElementById('form').submit();
                });
            }
        });
    });
</script>


<?= $this->endSection() ?>