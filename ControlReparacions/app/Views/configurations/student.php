<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>

<main class="flex gap-72 px-52 py-5 h-full">

    <aside class="flex flex-col gap-10">

        <div class="shadow-xl border-b border-primario rounded-t-xl">

            <div class="col-span-12 text-left mb-3 bg-primario text-white rounded-t-lg p-4">
                <h2 class="text-2xl font-semibold">INFO</h2>
            </div>


            <div class="grid grid-cols-6 mt-2 p-4">
                <div class="col-span-12 grid grid-cols-12">
                    <div class="col-span-6 grid-cols-12 text-left px-2">
                        <p>name: <?= $student['nom'] ?> </p>
                    </div>
                </div>

                <div class="col-span-12 grid grid-cols-12">
                    <div class="col-span-6 grid-cols-12 text-left px-2">
                        <p>apellidos: <?= $student['cognoms'] ?> </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-6 mt-2 p-4">
                <div class="col-span-6 grid grid-cols-12">
                    <div class="col-span-6 grid-cols-12 text-left px-2">
                        <p>email: <?= $student['correo'] ?> </p>
                    </div>
                </div>

                <div class="col-span-6 grid grid-cols-12">
                    <div class="col-span-6 grid-cols-12 text-left px-2">
                        <p>curs: <?= $student['curs'] ?> </p>
                    </div>
                </div>
            </div>





        </div>

        <form action="<?= base_url('config/passwd') ?>" method="POST" class="mt-4 flex flex-col gap-2 px-20">

            <div class="shadow-xl border-b border-primario rounded-t-xl">

                <div class="col-span-12 text-left mb-3 bg-primario text-white rounded-t-lg p-4">
                    <h2 class="text-2xl font-semibold">INFO</h2>
                </div>

                <div class="grid grid-cols-12 mt-2 p-4">
                    <div class="col-span-12 grid grid-cols-12">
                        <div class="col-span-6 grid-cols-12 text-left px-2">
                            <label class="">Cambiar contraseña*</label>
                            <input type="password" name="passwd" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                            <?php
                            if (isset(validation_errors()['passwd'])) : ?>
                                <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['passwd'] ?></p>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" value="Cambiar" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">
        </form>
    </aside>

    <article>

        <div class="flex flex-col gap-5 px-10 py-5 border-2 border-black rounded-lg">
            <h1 class="text-4xl">INFO INSTI</h1>
            <p>name: <?= $institute['nom'] ?> </p>
            <p>codi: <?= $institute['codi'] ?> </p>
            <p>telefon: <?= $institute['telefon'] ?> </p>
            <p>adreca: <?= $institute['adreca_fisica'] ?> </p>
            <p>poblacio: <?= $institute['id_poblacio'] ?> </p>
            <p>correu: <?= $institute['correu_persona_contacte'] ?> </p>
        </div>

    </article>

</main>


<?= $this->endSection() ?>