<template>
    <div class="col-lg-6 d-flex justify-content-center align-items-center">
        <div class="card shadow p-4 p-md-5" style="max-width: 32rem;">
            <div class="col-12 text-center mb-4">
                <img src="/assets/img/remedic-logo.png" alt="Image Description" style="width: 150px;">
            </div>  
            <div class="col-12 text-center mb-4">
                <h4>Admin Login</h4>
                <span class="text-muted">Enter email address and password to view your dashboard.</span>
            </div>
            <div class="col-12">
                <div class="mb-2">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control form-control-lg" v-model="email" placeholder="name@example.com" name="email">
                </div>
            </div>
            <div class="col-12">
                <div class="mb-2">
                    <div class="form-label">
                        <span class="d-flex justify-content-between align-items-center">Password
                            <a class="text-primary" href="">
                                Forgot Password?
                            </a>
                        </span>
                    </div>
                    <input type="password" name="password" v-model="password" class="form-control form-control-lg" placeholder="***************">
                </div>
            </div>
            <div role="alert" class="alert alert-danger" v-bind:class="{ 'd-none' : message == '' }">{{ message }}</div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" v-model="checked">
                    <label class="form-check-label" for="flexCheckDefault">Remember Me</label>
                </div>
            </div>
            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg btn-dark text-uppercase form-control" :disabled="isFetching" @click="checkAuth()">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-bind:class="{ 'd-none' : !isFetching }"></span> Login</button>
            </div>
            
            
        </div>
    </div>        
</template>
<script>
    export default {
        props: ['homeRoute'],
        data(){
            return{
                isFetching : false,
                message : ""
            }
        },
        methods : {
            checkAuth(){
                this.isFetching = true
                this.message = ""
                const params = { email: this.email, password : this.password, remember : this.checked};
                axios.post("/admin/login", params)
                    .then(response => {
                        this.isFetching = false
                        if(response.data.result == 1){
                            window.location = '/admin/home'
                        }
                    })
                    .catch(error => {
                        this.isFetching = false
                        var errorMessage = error.response.data
                        var errorData = errorMessage.errors
                        if(errorData){
                            if(errorData.email){
                                this.message = errorData.email[0]
                            }else
                            if(errorData.password){
                                this.message = errorData.password[0]
                            }
                        }
                    });
            }
        }
    }
</script>
