<template>
    <div>
        <div v-if="errors.size" class="bg-red-300 px-6 py-3 mb-4 rounded-lg text-sm text-gray-800">
            {{errors.size[0]}}
        </div>
        <div class="mb-8">
            <app-uploader @onprocessfile="storeFile" @validation="setValidationErrors" />
        </div>
        <div>
            <h2 class="font-medium pb-3 border-b-2 border-gray-100 text-gray-800">Your files</h2>
            <template v-if="files.length">
                <app-file v-for="file in files" :key="file.uuid" :file="file" />
            </template>
            <p v-else class="mt-3 text-sm text-gray-800"></p>
        </div>
    </div>
</template>

<script>
    import {mapActions,mapGetters, mapMutations} from 'vuex'
    import AppFile from "../components/AppFile";
    import AppUploader from "../components/AppUploader";
    import axios from 'axios';

    export default {
        name: "Upload",
        components:{
            AppFile,
            AppUploader
        },
        data(){
          return {
              errors: {}
          }
        },
        computed: {
            ...mapGetters({
                files: 'files/files'
            })
        },
        methods:{
            ...mapActions({
                getFiles: 'files/getFiles'
            }),
            ...mapMutations({
                addFile: 'files/ADD_FILE',
                incrementUsage: 'usage/INCREMENT_USAGE'
            }),
            setValidationErrors (errors) {
                this.errors = errors
            },
            async storeFile (file) {
                let response = await axios.post('/api/files',{
                    name: file.filename,
                    size: file.fileSize,
                    path: file.serverId
                })
                this.addFile(response.data.data)
                this.incrementUsage(file.fileSize)
            }
        },
        mounted(){
            this.getFiles()
        }
    }
</script>

<style scoped>

</style>
