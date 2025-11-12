@extends('layout.crewing')

@section('content')
    <main id="main">
        <div class="container">
            <section class="section">
                <div class="row">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Crew List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                    </nav>
                    <div class="col-lg-12">
                        <livewire:crew-list-table />
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function() {
            const id = this.dataset.id;
            const pesanWrap = document.getElementById(`pesanWrap${id}`);
            const interviewWrap = document.getElementById(`interviewWrap${id}`);
            const pesanTextarea = pesanWrap ? pesanWrap.querySelector('textarea') : null;

            // Reset tampilan
            pesanWrap.classList.add('d-none');
            interviewWrap.classList.add('d-none');

            if (pesanTextarea) pesanTextarea.value = ''; // reset isi

            if (this.value == '2') { 
                // Interview
                pesanWrap.classList.remove('d-none');
                interviewWrap.classList.remove('d-none');
                if (pesanTextarea) {
                    pesanTextarea.value = 
                        `Halo, kami telah meninjau lamaran Anda dan ingin melanjutkan ke tahap interview. Silakan hadir pada jadwal yang telah kami tentukan di bawah ini atau melalui tautan berikut: [LINK] Mohon konfirmasi kehadiran Anda. Terima kasih.`;
                }
            } else if (this.value == '3') {
                // Accepted
                pesanWrap.classList.remove('d-none');
                if (pesanTextarea) {
                    pesanTextarea.value = 
                        `Selamat! Lamaran Anda telah diterima. Tim kami akan segera menghubungi Anda untuk proses selanjutnya. Terima kasih telah melamar di perusahaan kami.`;
                }
            } else if (this.value == '4') {
                // Decline
                pesanWrap.classList.remove('d-none');
                if (pesanTextarea) {
                    pesanTextarea.value = 
                        `Terima kasih telah melamar di perusahaan kami. Setelah mempertimbangkan semua kandidat, kami memutuskan untuk melanjutkan dengan kandidat lain. Jangan berkecil hati, Anda dapat mencoba kembali di kesempatan berikutnya.`;
                }
            }
        });
    });
});
</script>

