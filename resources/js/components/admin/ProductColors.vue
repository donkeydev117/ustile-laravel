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
                            <button class="btn ml-2 p-0 kt_notes_panel_toggle" data-toggle="tooltip" title="" data-placement="right" data-original-title="Check out more demos" v-if="$parent.permissions.includes('product-unit-list')">
                                <span class="bg-secondary h-30px font-size-h5 w-30px d-flex align-items-center justify-content-center  rounded-circle shadow-sm " v-on:click="display_form = !display_form">
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
</div>
</template>

<script>
import ErrorHandling from "./../../ErrorHandling";

export default {
    data() {
        return {
           
        };
    },
    methods: {
       fetchcolors(){

       }
    },
    mounted() {
        
        var token = localStorage.getItem('token');
        this.token = {
            headers: {
                Authorization: `Bearer ${token}`
            }
        };

        if(this.$route.params.id){
           this.fetchProduct(this.$route.params.id);
        }
     
    }
};
</script>
