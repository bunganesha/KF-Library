@extends('layouts.master')
@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-xxl-4 col-md-6">
                        {{-- features for book data cards --}}
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Buku <span>| Saat ini</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-book-open-line"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $books }}</h6>
                                        <span class="text-success small pt-1 fw-bold">Jumlah</span> <span
                                            class="text-muted small pt-2 ps-1">Buku</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- features for category data cards --}}
                        {{-- <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Kategori <span>| Saat ini</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                  </div>
                  <div class="ps-3">
                    <h6>145</h6>
                    <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                  </div>
                </div>
              </div>
            </div> --}}
                    </div>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Rak <span>| Saat ini</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-book-read-line"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $shelf }}</h6>
                                        <span class="text-success small pt-1 fw-bold">Jumlah</span> <span
                                            class="text-muted small pt-2 ps-1">Rak</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Kategori <span>| Saat ini</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-clipboard-line"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $category }}</h6>
                                        <span class="text-danger small pt-1 fw-bold">Jumlah</span> <span
                                            class="text-muted small pt-2 ps-1">Kategori</span>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->

                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>
                            <div class="card-body pb-0">
                                <h5 class="card-title">Buku Populer <span>| Saat ini</span></h5>
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Judul Buku</th>
                                            <th>Penulis</th>
                                    
                                            <th>Jumlah Dipinjam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($popularBooks as $popular)
                                            <tr>
                                                <td>{{ $popular->title }}</td>
                                                <td>{{ $popular->writer }}</td>
                                   
                                                <td>{{ $popular->lending_count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                                {{-- <h5 class="card-title">Peminjam Teraktif</h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Pegawai</th>
                                            <th>Total Pinjam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($popularBooks as $popular)
                                            <tr>
                                                <td>{{ $popular->title }}</td>
                                                <td>{{ $popular->writer }}</td>
                                                <td>{{ $popular->stock }}</td>
                                            </tr>
                                        @endforeach --}}
                                </tbody>
                                {{-- </table> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Peminjaman <span>| Saat ini</span></h5>
                        <table class="table datatable" id="examples">
                            <thead>
                                <tr>
                                    <th>Nama Peminjam</th>
                                    <th>Judul Buku</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($lending)
                                    @foreach ($lending as $l)
                                        <tr>
                                            <td>{{ $l->User->name }}</td>
                                            <td>{{ $l->Book->title }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $l->status == 1 ? 'text-dark bg-warning bi-collection me-1' : 'bg-success bi-check-circle me-1' }}">
                                                    {{ $l->status == 1 ? 'Dipinjam' : 'Dikembalikan' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <!-- Tampilkan pesan bahwa tidak ada data peminjaman -->
                                    <p>Tidak ada data peminjaman.</p>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            echarts.init(document.querySelector("#trafficChart")).setOption({
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    top: '5%',
                    left: 'center'
                },
                series: [{
                    name: 'Access From',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: '18',
                            fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: [{
                            value: 1048,
                            name: 'Search Engine'
                        },
                        {
                            value: 735,
                            name: 'Direct'
                        },
                        {
                            value: 580,
                            name: 'Email'
                        },
                        {
                            value: 484,
                            name: 'Union Ads'
                        },
                        {
                            value: 300,
                            name: 'Video Ads'
                        }
                    ]
                }]
            });
        });
    </script>
@endsection
