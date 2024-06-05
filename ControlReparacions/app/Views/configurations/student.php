<?= $this->extend('layouts/master') ?>


<?= $this->section('content') ?>

<main class="flex bg-blue-500 gap-72 px-52">

    <aside class="flex flex-col gap-5 border-2 border-black rounded-lg">
        <h1 class="text-4xl">INFO</h1>
        <p>name: <?=$user['name']?> </p>
        <p>email: <?=$user['user']?> </p>

    </aside>

    <article class="bg-red-300">
       <form action="" class="flex flex-col">
        <label for="">Cambiar contraseña</label>
        <input type="text">
        <input type="submit" value="cambiar">
       </form>
    </article>


</main>


<?= $this->endSection() ?>