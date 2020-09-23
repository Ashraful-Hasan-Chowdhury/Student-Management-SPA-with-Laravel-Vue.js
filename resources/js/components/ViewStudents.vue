<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Students</div>
                    <!-- Search Bar -->
                    <div class="input-group">
                         <input type="text" class="form-control border-primary" v-model="searchQuery" placeholder="search student . . .">

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
                                  <router-link :to="'editStudent/'+student.id">
                                  <button type="button" class="btn btn-success" >
                                      Edit
                                    </button>
                                    </router-link>
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
            deleteStudent(id){
                axios.delete('delete/'+id).then(response => {
                    this.getResults();
                    toastr.warning('Students information Deleted.', 'Delete!', {timeOut: 5000});
				});
            },
            getResults(page = 1) {
			axios.get('show?page=' + page)
				.then(response => {
                    console.log(response.data);
					          this.students = response.data;
				});
		}
        }
    }
</script>
