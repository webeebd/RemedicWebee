<template>
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
                                <li class="list-group-item" v-for="analytic in analytics" :key="analytic.id">
                                    <div class="row">
                                        <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 mb-3 mb-lg-0">
                                            <div>
                                            <h6 class="card-title mb-0">{{ analytic.title }}</h6>
                                            <small class="text-muted">{{ analytic.description }}</small>
                                            </div> 
                                        </div>

                                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 text-center text-md-end mt-3 mt-md-0">
                                            <button type="button" class="btn btn-primary border lift" v-if="analytic.visible != 'Y'" @click="addKpis(analytic)">Add to KPIs</button>
                                            <button type="button" class="btn btn-secondary" disabled v-else>KPIs added</button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                analytics : []
            }  
        },
        created(){
            axios
                .get('/admin-api/kpi')
                .then(response => {
                    this.analytics = response.data;
                }).finally(() => {

                }
                );   
        },
        methods : {
            addKpis(menu) {
                axios
                    .post('/admin-api/kpi', {id: menu.id })
                    .then(response => {
                        let index = this.analytics.map(data => data.id).indexOf(menu.id);
                        menu.visible = 'Y'
                        this.analytics[index] = menu
                    })
                    .catch(error => {
                        var errorMessage = error.response.data
                        Swal.fire(errorMessage.message, '', 'error')
                    })
                    .finally(() => {

                    })
            }
        }
    }
</script>