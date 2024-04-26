<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-r text-white">
    <div class="text-center p-12 bg-white shadow-2xl rounded-lg text-gray-800  ">
        <img src="<?= base_url('/assets/img/reparacion.jpg') ?>" alt="Mantenimiento" class="mb-6 w-full max-w-lg mx-auto">
    </div>
</div>
<?= $this->endSection() ?>
