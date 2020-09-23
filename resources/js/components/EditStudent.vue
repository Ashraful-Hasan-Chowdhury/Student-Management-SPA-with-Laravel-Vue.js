<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Update Student</div>

                    <div class="card-body">
                        <form>
                            <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" v-model="editname" aria-describedby="name" placeholder="Enter name">
                            </div>


                            <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" v-model="editemail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" v-model="editphone" class="form-control" id="phone" placeholder="phone">
                            </div>
                            <div class="form-group">

                                <button type="button" class="btn btn-primary" @click.prevent="swalUpdate">Update</button>

                            </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </template>
    <script>
        export default {
            data(){
                return {
                    students: {},
                    id:'',
                    name: '',
                    email: '',
                    phone: '',
                    editname: '',
                    editemail: '',
                    editphone: '',
                    errors: {},
                    searchQuery: '',
                    temp: ''
                }
            },
            mounted() {
                axios.get('edit/'+this.$route.params.id)
                .then(response => {
                    this.id = response.data.id;
                    this.editname  =response.data.name;
                    this.editemail =response.data.email;
                    this.editphone =response.data.phone;
				});
            },
            methods:{
                swalUpdate(){
                    Swal.fire({
                      title: 'Do you want to update informations?',
                      text: "",
                      icon: 'success',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, save it!'
                    }).then((result) => {
                      if (result.value) {
                          this.updateStudent();
                      }
                    })
                },
                updateStudent(){

                    axios.put('update/'+this.id,{

                        name:this.editname,
                        email:this.editemail,
                        phone:this.editphone
                    }).then(response => {
                        toastr.success(this.editname+'\'s information Updated.', 'Success!', {timeOut: 5000});
                        this.$router.push('/VueStudent/viewStudents')

    				});
                }
            }
        }
    </script>
