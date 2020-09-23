<template>
    <form>
    <textarea  id="editor" cols="30" rows="10"></textarea>
    </form>
</template>



   <script>

       export default {
           data() {
            return {


            }},
           mounted() {

               console.log('Component mounted.')

               CKEDITOR.replace('editor', {
                    filebrowserUploadUrl: 'public/ckeditor/ck_upload.php',
                    filebrowserUploadMethod: 'form'

                })
           }
       }
   </script>
