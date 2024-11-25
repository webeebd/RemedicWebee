@extends('layouts.app')
@section('content')
<div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-2">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><router-link to="/admin/home">Remedic</router-link></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-fluid">
            <div class="row g-3 row-deck mb-4">
                <div class="col-xxl-12 col-xl-12 col-lg-12">
                    <div class="card bg-transparent border-0">
                        <div class="row g-3">
                            <div class="col-xxl-6 col-xl-3 col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <span class="text-uppercase">New Orders</span>
                                        <h4 class="mb-0 mt-2">0</h4>
                                        <small class="text-muted">Analytics for last week</small>
                                        <div id="apex_c_1"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-6 col-xl-3 col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <span class="text-uppercase">AMC Sales</span>
                                        <h4 class="mb-0 mt-2">0</h4>
                                        <small class="text-muted">Analytics for last week</small>
                                        <div id="apex_c_2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-6 col-xl-3 col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <span class="text-uppercase">New Customer</span>
                                        <h4 class="mb-0 mt-2">0</h4>
                                        <small class="text-muted">Analytics for last week</small>
                                        <div id="apex_c_3"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-6 col-xl-3 col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <span class="text-uppercase">Total Return</span>
                                        <h4 class="mb-0 mt-2">0</h4>
                                        <small class="text-muted">Analytics for last week</small>
                                        <div id="apex_c_4"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div>
                                        <h6 class="card-title mb-0">Customer Order &amp; Data</h6>
                                        <small class="text-muted">Or you can <a href="#">sync data to dashboard</a> to ensure your data is always up-to-date.</small>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="d-flex flex-row flex-wrap">
                                            <div class="card py-2 px-3 me-2 mt-2">
                                                <small class="text-uppercase text-muted"><i class="fa fa-square me-1 chart-text-color1"></i>New Orders</small>
                                                <div><span class="fs-4 fw-bold">0</span> <span class="text-success fa fa-level-up">0%</span></div>
                                                <div class="text-muted small">0.0 Total Orders</div>
                                                </div>
                                                <div class="card py-2 px-3 me-2 mt-2">
                                                <small class="text-uppercase text-muted"><i class="fa fa-square me-1 chart-text-color5"></i>Return Orders</small>
                                                <div><span class="fs-4 fw-bold">0</span> <span class="text-danger fa fa-level-down">0%</span></div>
                                                <div class="text-muted small">0.0 Total Returns</div>
                                                </div>
                                                <div class="card py-2 px-3 me-2 mt-2">
                                                <small class="text-muted text-uppercase">In Transit</small>
                                                <div><span class="fs-4 fw-bold">0%</span></div>
                                                <div class="progress mt-1" style="height: 5px;">
                                                <div class="progress-bar chart-color1" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 2%;"></div>
                                                </div>
                                                </div>
                                                <div class="card py-2 px-3 me-2 mt-2">
                                                <small class="text-muted text-uppercase">Preparing</small>
                                                <div><span class="fs-4 fw-bold">0%</span></div>
                                                <div class="progress mt-1" style="height: 5px;">
                                                <div class="progress-bar chart-color5" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 2%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="apex_c_5"></div>
                                    </div>
                                </div>
                            </div>    



                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-center p-5">
                                        <img src="/assets/img/no-data.svg" class="w120" alt="No Data">
                                        <div class="mt-4 mb-3">
                                        <span class="text-muted">Customize your dashboard with the KPIs that matter to you</span>
                                        </div>
                                        <button type="button" class="btn btn-white border lift" onClick="kpi()">Choose your KPIs</button>
                                        <button type="button" class="btn btn-primary border lift">Keep default KPIs</button>
                                    </div>
                                </div>
                            </div>   

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
<script>
function kpi(){
    window.location = '/admin/kpi';
}
</script>
@stop