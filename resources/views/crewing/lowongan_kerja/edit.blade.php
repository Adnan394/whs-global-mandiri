@extends('layout.crewing')

@section('content')
<main id="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-5">
                        <h5 class="card-title">Edit Job Vacancy</h5>
                        <form action="{{ route('lowongan.update', $lowongan->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" value="{{ $lowongan->title }}" required>
                            </div>

                            <div class="row mb-3">
                                <label class="form-label">Description</label>
                                <div class="w-100 p-0"> 
                                    <textarea id="description" name="description" class="w-100">{{ $lowongan->description }}</textarea>
                                </div>
                            </div>

                            <div class="d-flex gap-3 mb-3 p-0">
                                <div class="w-100 m-0">
                                    <label for="" class="form-label">Rank</label>
                                    <select name="rank_id" id="" class="form-select" required>
                                        @foreach ($ranks as $item)
                                            @if($item->id === $lowongan->rank_id)
                                                <option value="{{ $lowongan->rank_id }}" selected>{{ $item->name }}</option>
                                            @endif
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex p-0 m-0 gap-3 mb-3">
                                <div class="w-100">
                                    <label for="" class="form-label">Image <a href="{{ env('APP_URL') . '/images/lowongan_kerja/' . $lowongan->image }}" target="_blank" class="text-primary">Preview</a></label>
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                </div>
                                <div class="w-50">
                                    <label for="" class="form-label">Sallary (from)</label>
                                    <!--<input type="number" class="form-control" name="sallary" value="{{ $lowongan->sallary }}">-->
                                    <input type="text" class="form-control" name="sallary" id="salaryInput" value="{{$lowongan->sallary}}">
                                </div>
                                <div class="w-50">
                                    <label for="" class="form-label">Sallary (to)</label>
                                    <!--<input type="number" class="form-control" name="sallary" value="{{ $lowongan->sallary }}">-->
                                    <input type="text" class="form-control" name="sallary2" id="salaryInput2" value="{{$lowongan->sallary2 ?? 0}}">
                                </div>
                            </div>

                            
                            <button id="tambahPertanyaan" class="btn btn-secondary mb-3" type="button">Add Questions</button>
                            <div id="pertanyaanContainer" class="mb-3">
                                
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 w-100 py-2 m-0">Edit Job Vacancy</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // CKEditor inisialisasi
    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: [
                'undo', 'redo', '|',
                'bold', 'italic', 'underline', '|',
                'bulletedList', 'numberedList', '|',
                'link', 'blockQuote', 'insertTable'
            ],
        })
        .catch(error => console.error('CKEditor error:', error));

    ClassicEditor
        .create(document.querySelector('#requirement'), {
            toolbar: [
                'undo', 'redo', '|',
                'bold', 'italic', 'underline', '|',
                'bulletedList', 'numberedList', '|',
                'link', 'blockQuote', 'insertTable'
            ],
        })
        .catch(error => console.error('CKEditor error:', error));

    // --- Tambah Pertanyaan Dinamis ---
    const btnTambah = document.getElementById('tambahPertanyaan');
    const container = document.getElementById('pertanyaanContainer');
    let count = 0;
    dataPertanyaan();
    resetNomor();

    function dataPertanyaan() {
        let data = @json($pertanyaan);
        data.forEach((item, index) => {
            count++;

            const div = document.createElement('div');
            div.classList.add('mb-3', 'pertanyaan-item');

            div.innerHTML = `
                <label class="form-label">Pertanyaan ${count}</label>
                <div class="d-flex gap-2">
                    <input type="hidden" name="pertanyaan_id[]" value="${item.id}">
                    <input type="text" name="pertanyaan_text[]" class="form-control" value="${item.pertanyaan}" placeholder="type questions ${count}" required>
                    <button type="button" class="btn btn-danger btn-sm hapus-pertanyaan">Delete</button>
                </div>
            `;


            container.appendChild(div);

            // tombol hapus
            div.querySelector('.hapus-pertanyaan').addEventListener('click', function() {
                div.remove();
                resetNomor();
            });
        });
    }

    btnTambah.addEventListener('click', function(e) {
        count++;

        const div = document.createElement('div');
        div.classList.add('mb-3', 'pertanyaan-item');

        div.innerHTML = `
            <label class="form-label">Pertanyaan ${count}</label>
            <div class="d-flex gap-2">
                <input type="hidden" name="pertanyaan_id[]" value="">
                <input type="text" name="pertanyaan_text[]" class="form-control" placeholder="type questions ${count}" required>
                <button type="button" class="btn btn-danger btn-sm hapus-pertanyaan">Delete</button>
            </div>
        `;


        container.appendChild(div);

        // tombol hapus
        div.querySelector('.hapus-pertanyaan').addEventListener('click', function() {
            div.remove();
            resetNomor();
        });
    });

    function resetNomor() {
        count = 0;
        document.querySelectorAll('.pertanyaan-item').forEach((item, index) => {
            count = index + 1;
            item.querySelector('label').innerText = `Pertanyaan ${count}`;
            item.querySelector('input').placeholder = `Masukkan pertanyaan ${count}`;
        });
    }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const salaryInput = document.getElementById('salaryInput');
    const salaryInput2 = document.getElementById('salaryInput2');
    
    salaryInput.addEventListener('input', function(e) {
        let value = this.value.replace(/\D/g, ''); // hapus semua non-digit
        if (value === '') {
            this.value = '';
            return;
        }

        // Format jadi 1.000.000
        this.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    });
    salaryInput2.addEventListener('input', function(e) {
        let value = this.value.replace(/\D/g, ''); // hapus semua non-digit
        if (value === '') {
            this.value = '';
            return;
        }

        // Format jadi 1.000.000
        this.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    });

    // Sebelum submit, bersihkan titik-titik biar aman di database
    document.querySelector('form').addEventListener('submit', function() {
        salaryInput.value = salaryInput.value.replace(/\./g, '');
        salaryInput2.value = salaryInput2.value.replace(/\./g, '');
    });

});
</script>

