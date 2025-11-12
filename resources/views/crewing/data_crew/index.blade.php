@extends('layout.crewing')

@section('content')
    <main id="main">
        <div class="container">
            <section class="section">
                <div class="row">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Data Crew</a></li>
                    </ol>
                    </nav>
                    <div class="col-lg-12">
                        <div class="card pt-3">
                            <div class="card-body">
                                <livewire:crewing-table />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection