<template>
<div>
   <div class="d-flex flex-column-fluid">
      <!--begin::Container-->
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
                <div class="card card-custom gutter-b bg-transparent shadow-none border-0">
                    <div class="card-header align-items-center  border-bottom-dark px-0">
                        <div class="card-title mb-0">
                            <h3 class="card-label mb-0 font-weight-bold text-body">
                                Product Colors
                            </h3>
                        </div>
                        <div class="icons d-flex">
                            <button class="btn ml-2 p-0 kt_notes_panel_toggle" data-toggle="tooltip" title="" data-placement="right">
                                <span class="bg-secondary h-30px font-size-h5 w-30px d-flex align-items-center justify-content-center  rounded-circle shadow-sm " v-on:click="displayForm = !displayForm">
                                    <svg width="25px" height="25px" viewBox="0 0 16 16" class="bi bi-plus white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
         </div>
         <div class="row">
            <div class="col-12 ">
                <div class="card card-custom gutter-b bg-white border-0">
                    <div class="card-body">
                        <div>
                            <div class=" table-responsive" id="printableTable">
                            
                                <div id="productUnitTable_wrapper" class="dataTables_wrapper no-footer">

                                    <div class="dataTables_length" id="productUnitTable_length">
                                        <label>Show 
                                            <select name="productUnitTable_length" aria-controls="productUnitTable" class="" v-model="limit" v-on:change="fetchcolors()">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                                <option value="200">200</option>
                                                <option value="500">500</option>
                                                <option value="1000">1000</option>
                                            </select> entries
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
   </div>
       <div class="offcanvas offcanvas-right kt-color-panel p-5 kt_notes_panel" v-if="displayForm" :class="displayForm ? 'offcanvas-on' : ''">
        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-3">
            <h4 class="font-size-h4 font-weight-bold m-0">Add Color</h4>
            <a href="#" class="btn btn-sm btn-icon btn-light btn-hover-primary kt_notes_panel_close" v-on:click="clearForm()">
                <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                </svg>
            </a>
        </div>
        <form id="myform">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="text-dark">Color Name</label>
                        <input type="text" class="form-control" />
                        <small class="form-text text-danger" v-if="errors.has('name')" v-text="errors.get('name')"></small>
                    </div>
                    <div class="form-group">
                        <label class="text-dark">Color Code</label>
                        <input type="text" class="form-control" />
                        <small class="form-text text-danger" v-if="errors.has('name')" v-text="errors.get('name')"></small>
                    </div>
                    <div class="form-group ">
                        <label>Status</label>
                        <fieldset class="form-group mb-3">
                            <select class="js-example-basic-single js-states form-control bg-transparent" v-model="color.is_active">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </fieldset>
                        <small class="form-text text-danger" v-if="errors.has('is_active')" v-text="errors.get('is_active')"></small>
                    </div>
                </div>
            </div>
            <button type="button" @click="addUpdateColor()" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
</template>

<script>
import ErrorHandling from "./../../ErrorHandling";

export default {
    data() {
        return {
            displayForm: false,
            limit: 10,
            selectedLanguage:'',
            errors: new ErrorHandling(),
            languages: [],
            token: [],
            selectedLanguage:'',
            colors:[],
            color: {
                id:"",
                key: "",
                value: "",
                code: "",
                is_active: 1
            },
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        };
    },
    methods: {
        fetchLanguages() {
            this.$parent.loading = true;
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};

            axios.get('/api/admin/language?limit=500', config)
                .then(res => {
                    if (res.data.status == "Success") {
                        this.languages = res.data.data;
                        console.log(this.languages);
                        for(var i = 0 ; i < res.data.data.length; i++){
                            // this.unit.language_id.push(res.data.data[i].id);
                            if(res.data.data[i].is_default){
                                this.selectedLanguage = res.data.data[i].id;   
                            }
                        }
                    }
                }).finally(() => (this.$parent.loading = false));
        },
        fetchcolors(){

        },
        clearForm(){
            this.displayForm = !this.displayForm;
        },
        addUpdateColor(){

        }
    },
    mounted() {
        
        var token = localStorage.getItem('token');
        this.token = {
            headers: {
                Authorization: `Bearer ${token}`
            }
        };
        // this.fetchunits();
        this.fetchLanguages();
     
    }
};
</script>
