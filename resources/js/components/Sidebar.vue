
<template>
    <nav id="sidebar">
                <div class="custom-menu">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            </div>
                <div class="p-4" >
                <h1><a href="" class="logo">Student Mangement System</a></h1>
            <ul class="list-unstyled components mb-5">
                <li class="active sticky-top" >
                    <slot></slot>
                </li>

              <li >
                  <router-link to="/VueStudent/"><span class="fa fa-home mr-3"></span>Home</router-link>
              </li>
              <li>
                  <router-link to="/VueStudent/addStudents"><span class="fa fa-user mr-3"></span>Add Students</router-link>
              </li>
              <li>
                  <router-link to="/VueStudent/viewStudents"><span class="fa fa-briefcase mr-3"></span>View Students</router-link>
              </li>
              <li>
                  <router-link to="/VueStudent/createPost"><span class="fa fa-sticky-note mr-3"></span>Create Blog</router-link>
              </li>
              <li>
              <a href="#"><span class="fa fa-paper-plane mr-3"></span> Read Blog</a>
              </li>
            </ul>

            </div>
    </nav>
</template>
