<template>
    <div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-2">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><router-link to="/admin/home">Dashboard</router-link></li>
                        <li class="breadcrumb-item active" aria-current="page">Masters</li>
                    </ol>
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h2 mb-md-0 text-white fw-light">Permission</h1>
                        <div class="page-action">
                            <button class="btn d-none d-sm-inline-flex rounded-pill" type="button" @click="$router.push('/admin/roles')">
                                <span class="me-1 d-none d-lg-inline-block">Create Role</span>
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 0C7.23206 0 7.45462 0.0921874 7.61872 0.256282C7.78281 0.420376 7.875 0.642936 7.875 0.875V6.125H13.125C13.3571 6.125 13.5796 6.21719 13.7437 6.38128C13.9078 6.54538 14 6.76794 14 7C14 7.23206 13.9078 7.45462 13.7437 7.61872C13.5796 7.78281 13.3571 7.875 13.125 7.875H7.875V13.125C7.875 13.3571 7.78281 13.5796 7.61872 13.7437C7.45462 13.9078 7.23206 14 7 14C6.76794 14 6.54538 13.9078 6.38128 13.7437C6.21719 13.5796 6.125 13.3571 6.125 13.125V7.875H0.875C0.642936 7.875 0.420376 7.78281 0.256282 7.61872C0.0921874 7.45462 0 7.23206 0 7C0 6.76794 0.0921874 6.54538 0.256282 6.38128C0.420376 6.21719 0.642936 6.125 0.875 6.125H6.125V0.875C6.125 0.642936 6.21719 0.420376 6.38128 0.256282C6.54538 0.0921874 6.76794 0 7 0V0Z" fill="white"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-transparent pb-0">
                            <div>
                            <h6 class="card-title mb-0">Manage permissions</h6>
                            <small class="text-muted">Permissions are used for access level control of the roles.</small>
                            </div> 
                        </div>
                        <div class="card-body col-12 text-center p-5" v-if="roles.length == 0"> 
                            <img src="/assets/img/no-data.svg" class="w120" alt="No Data">
                            <div class="mt-4 mb-3">
                                <span class="text-muted">Currently you have not create any roles to show here use below to create one.</span>
                            </div>
                            <button type="button" class="btn btn-white border lift" @click="$router.push('/admin/roles')">Create Role</button>
                        </div>
                        <div class="card-body table-responsive" v-else>
                            <div class="row-title mb-2">
                                <h5 class="fw-light mb-0">Permissions
                                    <span class="fw-bold ms-2">({{ permissions.length }})</span>
                                    | Dashboard KPIs
                                    <span class="fw-bold ms-2">({{ analytics.length }})</span>
                                </h5>
                                <div>
                                    <div class="input-group">
                                        <select class="form-select" v-model="role" @change="onPermissionChange($event)">
                                        <option disabled value=""> -- Select a role-- </option>
                                        <option v-for="role in roles" :key="role.id" :value="role.id" >{{ role.title }}</option>
                                        </select>
                                        <button class="btn btn-outline-secondary" type="button" @click="selectAll()"><i class="fa fa-check-circle"></i><span class="d-none d-md-inline-block ms-2">Mark All</span></button>
                                        <button class="btn btn-outline-secondary" type="button" @click="unSelectAll()"><i class="fa fa-check-circle-o"></i><span class="d-none d-md-inline-block ms-2">Unmark All</span></button>
                                    </div>
                                </div>
                            </div>
                        <table class="table card-table mb-0" p-3>
                            <tbody>
                                <tr v-for="index in permissionNumbers" :key="index">
                                    <td class="form-label">{{ permissions[index] }}</td>
                                    <td>
                                        <div class="form-check">
                                        <input class="form-check-input" type="checkbox" :id="permissions[index]" v-model="this.permit" :value="permissions[index]">
                                        </div>
                                    </td>
                                    <td class="form-label">{{ permissions[index + 1] }}</td>
                                    <td>
                                        <div class="form-check">
                                        <input class="form-check-input" type="checkbox" :id="permissions[index + 1]" v-model="this.permit" :value="permissions[index + 1]">
                                        </div>
                                    </td>
                                </tr>
                                <tr v-for="pos in analyticNumbers" :key="pos">
                                    <td class="form-label">{{ analytics[pos] }} (KPI)</td>
                                    <td>
                                        <div class="form-check">
                                        <input class="form-check-input" type="checkbox" :id="analytics[pos]" v-model="this.dashboard" :value="analytics[pos]">
                                        </div>
                                    </td>
                                    <td class="form-label">{{ analytics[pos + 1] }} (KPI)</td>
                                    <td>
                                        <div class="form-check">
                                        <input class="form-check-input" type="checkbox" :id="analytics[pos + 1]" v-model="this.dashboard" :value="analytics[pos + 1]">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        <div role="alert" class="alert alert-danger m-2" v-bind:class="{ 'd-none' : message == '' }">{{ message }}</div>
                        <div class="card-footer text-end" v-if="role.length > 0">
                            <button class="btn btn-lg btn-primary" type="submit" @click="savePermissions()"  :disabled="isCreating">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-bind:class="{ 'd-none' : !isCreating }"></span> Save Changes</button>
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
                roles: [],
                isCreating : false,
                message : "",
                role : '',
                permit : [],
                dashboard : [],
                permissions : [
                    "Dashboard",
                    "Roles",
                    "Permissions",
                    "Departments",
                    "Brand",
                    "Categories",
                    "AMC Master",
                    "Discount",
                    "Customers",
                    "Create Products",
                    "Update Products",
                    "View Inventory",
                    "Update Inventory",
                    "Create Users",
                    "View Orders",
                    "View Transaction",
                    "Update Tracking",
                    "Cancel Orders",
                    "Generate Invoice",
                    "Initiate Return",
                    "Initiate Refunds",
                    "View AMC",
                    "Update AMC",
                    "View Support Tickets",
                    "Update Support Tickets",
                ],
                analytics : [
                    "Orders",
                    "Net Profit",
                    "Sales",
                    "Transaction",
                    "Warranty",
                    "AMC Order",
                    "Support Tickets",
                    "Return Orders",
                    "Roles Data",
                    "Products",
                    "Discount Data",
                    "Inventory Health",
                    "Total Customers",
                ],
            }
        },
        computed : {
            permissionNumbers(){
                return [...Array(this.permissions.length - 1)].map((_,i)=>i).filter(i=>i%2===0)
            },
            analyticNumbers(){
                return [...Array(this.analytics.length - 1)].map((_,i)=>i).filter(i=>i%2===0)
            },
        },
        created(){
            axios
                .get('/admin-api/roles')
                .then(response => {
                    response.data.forEach(element => {
                        if(element.title != 'Administrator'){
                            this.roles.push(element);
                        }
                    });
                    
                });
            if(this.$route.params.id != "all"){
                this.role = this.$route.params.id 
                axios
                    .get('/admin-api/permissions/'+this.$route.params.id)
                    .then(response => {
                        var selected = [];
                        var analytic = [];
                        response.data.forEach(function (allowedUrl) {
                            if(allowedUrl.slug == "/analytic")
                            analytic.push(allowedUrl.title);
                            else selected.push(allowedUrl.title);
                        });
                        this.permit = selected;
                        this.dashboard = analytic;
                    });
            }        
        },
        methods : {
            unSelectAll(){
                this.permit = [];
                this.dashboard = [];
            },
            selectAll() {
                var selected = [];
                this.permissions.forEach(function (permission) {
                    selected.push(permission);
                });
                this.permit = selected;
                var permitted = [];
                this.analytics.forEach(function (analytic) {
                    permitted.push(analytic);
                });
                this.dashboard = permitted;
            },
            onPermissionChange(event) {
                this.role = event.target.value
                axios
                .get('/admin-api/permissions/'+event.target.value)
                .then(response => {
                    var selected = [];
                    var analytic = [];
                    response.data.forEach(function (allowedUrl) {
                        if(allowedUrl.slug == "/analytic")
                        analytic.push(allowedUrl.title);
                        else selected.push(allowedUrl.title);
                    });
                    this.dashboard = analytic;
                    this.permit = selected;
                    console.dir(this.permit);
                });
            },
            savePermissions() {
                this.isCreating = true
                const params = {
                    idRole : this.role,
                    idChart : this.dashboard,
                    idPermission : this.permit 
                }
                axios
                    .post('/admin-api/permissions', params)
                    .then(response => {
                        this.message = ""
                        Swal.fire('User role permission updated', '', 'success')
                    })
                    .catch(err => {
                        var errorMessage = err.response.data
                        this.message = errorMessage.message
                    })
                    .finally(() => {
                        this.isCreating = false
                        }
                    )
            },
        }
    }
</script>