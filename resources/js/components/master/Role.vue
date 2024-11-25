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
                        <h1 class="h2 mb-md-0 text-white fw-light">Roles</h1>
                        <div class="page-action">
                            <button class="btn d-none d-sm-inline-flex rounded-pill" type="button" @click="openCreatePannel()">
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
                <div class="col-12" v-if="createPannel" style="margin-bottom: 10px;">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div>
                            <h6 class="card-title mb-0">Role Details</h6>
                            <small class="text-muted">Roles are used for access level control of the assigned user.</small>
                            </div> 
                        </div>
                        <form class="card-body">
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Role Title <sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <input type="text" class="form-control form-control-lg" v-model="roleParam.title">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Role Description <sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <input type="text" class="form-control form-control-lg" v-model="roleParam.description">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Status <sup class="text-danger">*</sup></label>
                                <div class="col-md-9 col-sm-8">
                                <select class="form-control form-control-lg" v-model="roleParam.active">
                                    <option disabled value="">--- Select Status --</option>
                                    <option value="Y">Active</option>
                                    <option value="N">Inactive</option>
                                </select>
                                </div>
                            </div>

                            
                            <div class="row mb-3">
                                <label class="col-md-3 col-sm-4 col-form-label">Redirect to permission after save ?</label>
                                <div class="col-md-9 col-sm-8">
                                <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="permissions" v-model="roleParam.redirect">
                                <label class="form-check-label" for="permissions">Yes</label>
                                </div>
                                </div>
                            </div>
                            <div role="alert" class="alert alert-danger" v-bind:class="{ 'd-none' : message == '' }">{{ message }}</div>
                    
                        </form>
                        <div class="card-footer text-end" v-if="createPannel">
                            <button class="btn btn-lg btn-light me-2" type="reset" @click="closeCreatePannel()">Close</button>
                            <button class="btn btn-lg btn-primary" type="submit" :disabled="isCreating" @click="createRole()" v-if="!roleParam.hasOwnProperty('id')">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-bind:class="{ 'd-none' : !isCreating }"></span> Save Changes</button>
                            <button class="btn btn-lg btn-primary" type="submit" :disabled="isCreating" @click="updateRole()" v-else>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-bind:class="{ 'd-none' : !isCreating }"></span> Save Changes</button>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-transparent pb-0">
                            <div>
                            <h6 class="card-title mb-0">Manage roles</h6>
                            <small class="text-muted">Roles are used for access level control of the assigned user.</small>
                            </div> 
                        </div>
                        <div class="card-body" v-if="roles.length > 0">
                            <table class="table align-middle card-table mb-0 roleTable">
                                <thead>
                                    <tr>
                                        <th>Role ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Modified</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="role in roles" :key="role.id">
                                        <td>
                                            R-00{{ role.id }}
                                        </td>
                                        <td>{{ role.title }} 
                                            <span class="badge bg-success" v-if="role.active === 'Y'">Active</span>
                                            <span class="badge bg-danger" v-else>Inactive</span> 
                                        </td>
                                        <td>{{ role.description }}</td>
                                        <td>{{ role.updated_at }}</td>
                                        <td v-if="role.title != 'Administrator'">
                                            <button type="button" class="btn btn-link btn-sm text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="View Permission" @click="fetchPermission(role.id)"><i class="fa fa-eye"></i></button>
                                            <button type="button" class="btn btn-link btn-sm text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Role"  @click="showEditDialog(role)"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" @click="showDeleteAlert(role.id)"><i class="fa fa-trash"></i></button>
                                        </td>
                                        <td v-else></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body col-12 text-center p-5" v-else> 
                            <img src="/assets/img/no-data.svg" class="w120" alt="No Data">
                            <div class="mt-4 mb-3">
                                <span class="text-muted">Currently you have not create any roles to show here use below to create one.</span>
                            </div>
                            <button type="button" class="btn btn-white border lift" @click="openCreatePannel()">Create Role</button>
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
                createPannel : false,
                isCreating : false,
                roleParam: {},
                message : "",
            }
        },
        updated(){
            if(this.isCreating){
                $('.roleTable').addClass('nowrap').dataTable({
                    responsive: true,
                    paging: false,
                    ordering: true,
                    info: false,
                    bDestroy :true,
                });
            }
        },
        created(){
            this.roleParam.active = ''
            axios
                .get('/admin-api/roles')
                .then(response => {
                    this.roles = response.data;
                }).finally(() => {
                        this.isCreating = false
                        }
                    );   
        },
        methods : {
            fetchPermission(id){
                window.location = "/admin/permissions/"+id
            },
            showDeleteAlert(id){
               Swal.fire({
                    title: 'Do you want to remove this role?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Cancel',
                    denyButtonText: 'Delete',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isDenied) {
                       axios
                        .delete('/admin-api/roles/'+id)
                        .then(response => {
                            let i = this.roles.map(data => data.id).indexOf(id);
                            this.roles.splice(i, 1)
                            $('.roleTable').DataTable().destroy();
                        });
                    }
                })
            },
            showEditDialog(roleData){
                this.message = ""
                this.isEditing = true
                this.roleParam.id = roleData.id;
                this.roleParam.title = roleData.title;
                this.roleParam.description = roleData.description;
                this.roleParam.active = roleData.active;
                this.createPannel = true
                window.scrollTo(0,0);
            },
            updateRole(){
                this.isCreating = true
                axios
                    .patch('/admin-api/roles/'+this.roleParam.id, this.roleParam)
                    .then((res) => {
                        let index = this.roles.map(data => data.id).indexOf(this.roleParam.id);
                        this.roles[index] = res.data
                        this.isCreating = false
                        this.createPannel = false
                        Swal.fire('User Role Updated', '', 'success')
                    })
                    .catch(err => {
                        var errorMessage = err.response.data
                        this.message = errorMessage.message
                    })
                    .finally(() => {
                        this.isCreating = false
                        }
                    );
            },
            createRole() {
                this.isCreating = true
                axios
                    .post('/admin-api/roles', this.roleParam)
                    .then(response => {
                        if(this.roleParam.redirect){
                            window.location = "/admin/permissions/"+response.data.id     
                        }else{
                            this.roleParam = {}
                            this.roles.unshift( response.data )
                            this.createPannel = false
                            $('.roleTable').DataTable().destroy();
                            Swal.fire('User Role Created', '', 'success')
                        }
                    })
                    .catch(error => {
                        var errorMessage = error.response.data
                        this.message = errorMessage.message
                    })
                    .finally(() => {
                        this.isCreating = false
                        }
                    )
            },
            scrollToTop() {
                window.scrollTo(0,0);
            },    
            openCreatePannel(){
                this.roleParam = {}
                this.roleParam.active = ''
                this.createPannel = true
            },
            closeCreatePannel(){
                this.createPannel = false
            }
        }
    }
</script>