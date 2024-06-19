<?= $this->extend('layout/user/home'); ?>

<?= $this->section('content'); ?>
<section class="content-body">
    <div class="landingpage mt-5 pt-5 text-center">
        <div class="landingpage-img mb-5">
            <img src="<?= base_url('assets/img/guestbook-icon.png') ?>" alt="">
        </div>
        <div class="landingpage-content w-100 text-center">
            <h1 class="h1 m-0">SAKTI GUESTBOOK</h1>
            <span>Kami sangat menghargai kedatangan anda untuk berbagi keperluan serta kebutuhan di perusahaan kami. Setiap informasi yang Anda berikan akan membantu kami lebih baik lagi dalam menyediakan layanan yang sesuai dengan kebutuhan Anda. Terima kasih atas partisipasi Anda dalam meningkatkan kualitas layanan kami!</span>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>