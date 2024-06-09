<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>

<main class="flex gap-72 px-52 py-5 h-full">

    <aside class="flex flex-col gap-10">
        <div class="flex flex-col gap-5 px-10 py-5 border-2 border-black rounded-lg">
            <h1 class="text-4xl">INFO</h1>
            <p>name: <?= $teacher['nom'] ?> </p>
            <p>apellidos: <?= $teacher['cognoms'] ?> </p>
            <p>email: <?= $user['user'] ?> </p>
         
        </div>
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