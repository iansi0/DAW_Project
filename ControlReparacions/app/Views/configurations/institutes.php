<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>

<main class="flex gap-72 px-52 py-5 h-full">

    <aside class="flex flex-col gap-10">

        <div class="flex flex-col gap-5 px-10 py-5 border-2 border-black rounded-lg">
            <h1 class="text-4xl">INFO INSTI</h1>
            <p>name: <?= $institute['nom'] ?> </p>
            <p>codi: <?= $institute['codi'] ?> </p>
            <p>telefon: <?= $institute['telefon'] ?> </p>
            <p>adreca: <?= $institute['adreca_fisica'] ?> </p>
            <p>poblacio: <?= $institute['id_poblacio'] ?> </p>
            <p>correu: <?= $institute['correu_persona_contacte'] ?> </p>
            <p>persona: <?= $institute['nom_persona_contacte'] ?> </p>
        </div>

        <form action="<?= base_url('config/institute') ?>" method="POST" class="flex flex-col gap-5 px-10 py-5 border-2 border-black rounded-lg">
            <div class="flex flex-col mt-5">
                <label class="">Cambiar persona de contacte</label>
                <input type="text" value="<?= $institute['nom_persona_contacte'] ?>" name="name" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                <?php
                if (isset(validation_errors()['name'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['name'] ?></p>
                <?php endif ?>
            </div>

            <div class="flex flex-col mt-5">
                <label class="">Cambiar correu de contacte</label>
                <input type="text" value="<?= $institute['correu_persona_contacte'] ?>" name="email" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                <?php
                if (isset(validation_errors()['email'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['email'] ?></p>
                <?php endif ?>
            </div>

            <div class="flex flex-col mt-5">
                <label class="">Adreça</label>
                <input type="text" value="<?= $institute['adreca_fisica'] ?>" name="adress" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                <?php
                if (isset(validation_errors()['adress'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['adress'] ?></p>
                <?php endif ?>
            </div>

            <div class="flex flex-col mt-5">
                <label class="">Telefon</label>
                <input type="text" value="<?= $institute['telefon'] ?>" name="phone" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                <?php
                if (isset(validation_errors()['phone'])) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['phone'] ?></p>
                <?php endif ?>
            </div>
            <input type="submit" value="Cambiar" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">
        </form>
    </aside>

    <article>

        <div class="flex flex-col gap-5 px-10 py-5 border-2 border-black rounded-lg">
            <h1 class="text-4xl">INFO SSTT</h1>
            <p>name: <?= $sstt['nom'] ?> </p>
            <p>adreca: <?= $sstt['adreca_fisica'] ?> </p>
            <p>cp: <?= $sstt['cp'] ?> </p>
            <p>poblacio: <?= $sstt['poblacio'] ?> </p>
            <p>telefon: <?= $sstt['telefon'] ?> </p>
            <p>altres: <?= $sstt['altres'] ?> </p>
        </div>

    </article>


</main>


<?= $this->endSection() ?>