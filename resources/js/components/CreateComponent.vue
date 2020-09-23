<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Create new student</div>

                    <div class="card-body">
                    <form>
                        <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control " :class="{' border-danger':errors.name}" id="name" v-model="name" aria-describedby="name" placeholder="Enter name" required>
                        <small v-if="errors.name" class="text-danger">{{errors.name[0]}}</small>
                        </div>


                        <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" v-model="email" class="form-control " :class="{' border-danger':errors.email}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                        <small v-if="errors.email" class="text-danger">{{errors.email[0]}}</small>

                        </div>
                        <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" v-model="phone" class="form-control " :class="{' border-danger':errors.phone}" id="phone" placeholder="phone" required>
                        <small v-if="errors.phone" class="text-danger">{{errors.phone[0]}}</small>

                        </div>

                        <button type="submit"  class="btn btn-primary"  @click.prevent="swalSave">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">All Students</div>
                    <!-- Search Bar -->
                    <div class="mt-4 ml-4 mr-4">
                    <form>
                         <input type="text" class="form-control border-primary" v-model="searchQuery" placeholder="search student . . .">
                    </form>
                     </div>

                    <!-- Search Bar -->
                    <div class="card-body">
                        <table class="table table-dark">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Phone</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(student,i) in students.data" :key="student.id">
                              <th scope="row">{{i+1}}</th>
                              <td>{{student.name}}</td>
                              <td>{{student.email}}</td>
                              <td>{{student.phone}}</td>
                              <td>
                                  <button type="button" @click.prevent="edit(student.id)" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                      Edit
                                    </button>
                                    <button type="button" @click.prevent="swalDelete(student.id)" class="btn btn-danger">
                                        Delete
                                      </button>
                              </td>
                            </tr>


                          </tbody>

                        </table>
                        <pagination :data="students" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
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
                      </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click.prevent="swalUpdate" >Update</button>
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
            this.getResults();
        },
        watch:{
            searchQuery(){
                if(this.searchQuery == ''){
                    this.getResults();
                }
                axios.get('search/'+this.searchQuery)
                .then(response => {
                    this.students = response.data
				});
            }
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
            swalDelete(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.value) {
                      this.deleteStudent(id);
                  }
                })
            },
            swalSave(){
                Swal.fire({
                  title: 'Do you want to save this student?',
                  text: "you can update informations later!",
                  icon: 'success',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, save it!'
                }).then((result) => {
                  if (result.value) {
                      this.saveStudent();
                  }
                })
            },
            saveStudent(){
                this.errors=''
                axios.post('insert',{

                    name:this.name,
                    email:this.email,
                    phone:this.phone
                })
                .catch((error) => this.errors = error.response.data.errors)
                .then(response => {
                    this.name  ='',
                    this.email ='',
                    this.phone ='',
                    this.getResults();

                    if(this.errors.name || this.errors.email || this.errors.phone){
                        toastr.error('Students information could not be Saved.', 'Failed!', {timeOut: 5000});
                    }
                    else{
                        toastr.success('Students information Saved.', 'Success!', {timeOut: 5000});
                    }
				});
            },
            getResults(page = 1) {
			axios.get('show?page=' + page)
				.then(response => {
					this.students = response.data;
                    this.temp = response.data;
				});
		},
            edit(id){
                axios.get('edit/'+id)
                .then(response => { 
                    this.id = response.data.id;
                    this.editname  =response.data.name;
                    this.editemail =response.data.email;
                    this.editphone =response.data.phone;
				        });
            },
            updateStudent(){

                axios.put('update/'+this.id,{

                    name:this.editname,
                    email:this.editemail,
                    phone:this.editphone
                }).then(response => {
                    this.editname  ='',
                    this.editemail ='',
                    this.editphone ='',
                    this.getResults();
                    toastr.warning('Students information Updated.', 'Success!', {timeOut: 5000});
				});
            },
            deleteStudent(id){
                axios.delete('delete/'+id).then(response => {
                    this.getResults();
                    toastr.warning('Students information Deleted.', 'Delete!', {timeOut: 5000});
				});
            },
        }
    }
</script>
