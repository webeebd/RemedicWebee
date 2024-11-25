@extends('layouts.app')
@section('content')
<div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-2">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><router-link to="/admin/home">Dashboard</router-link></li>
                        <li class="breadcrumb-item active" aria-current="page">Metrics</li>
                    </ol>
                    <h1 class="h2 mb-md-0 text-white fw-light">Choose your KPIs</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div>
                            <h6 class="card-title mb-0">Suggested KPIs</h6>
                            <small class="text-muted">Add or remove metrics to customise your KPIs on the dashboard. This won't change any settings for other users in your system.</small>
                            </div> 
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-custom">
                                @foreach($permission as $analytic)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 mb-3 mb-lg-0">
                                            <div>
                                            <h6 class="card-title mb-0">{{ $analytic->title }}</h6>
                                            <small class="text-muted">{{$analytic->description }}</small>
                                            </div> 
                                        </div>

                                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 text-center text-md-end mt-3 mt-md-0" id="{{$analytic->id}}">
                                            @if($analytic->visible != 'Y')
                                            <button type="button" class="btn btn-primary border lift" onClick="addKpis({{$analytic->id}})">Add to KPIs</button>
                                            @else
                                            <button type="button" class="btn btn-secondary" disabled>KPIs added</button>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('script')
<script>
function addKpis(id){
    $.ajaxSetup({
        headers : {
            'X-CSRF-Token' : "{{ csrf_token() }}"
        }
    });
    $.post("{{url('/admin-api/kpi')}}",
    {
        idPermission: id
    },
    function(data, status){
        if(status == 'success'){
            if(data.result == 1){
                $('#'+id).empty();
                $('#'+id).html('<button type="button" class="btn btn-secondary" disabled>KPIs added</button>');
            }else{
                setUpError();
            }       
        }else{
            setUpError();
        }
    });
}

function setUpError(){
    Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Failed to add kpi to your account.'
            });
}
</script>
@stop