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
                                Product Shades
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
                        <div class=" table-responsive" id="printableTable">
                            <table id="productColorTable" class="display dataTable no-footer" role="grid">
                                <thead class="text-body">
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="productColorTable" rowspan="1" colspan="1">ID</th>
                                        <th class="sorting" tabindex="0" aria-controls="productColorTable" rowspan="1" colspan="1">Shade</th>
                                        <th class="sorting" tabindex="0" aria-controls="productColorTable" rowspan="1" colspan="1">Image</th>
                                        <th class="no-sort sorting_disabled" rowspan="1" colspan="1">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="kt-table-tbody text-dark">
                                    <tr class="kt-table-row kt-table-row-level-0 odd" role="row" v-for="m_shade in shades" v-bind:key="m_shade.id">
                                        <td class="sorting_1">{{m_shade.id}}</td>
                                        <td>{{ m_shade.name }}</td>
                                        <td><img :src='m_shade.media' style='width: 50px; height:50px' /></td>
                                        <td>
                                            <a href="javascript:void(0)" class=" click-edit" id="click-edit1" data-toggle="tooltip" title="" data-placement="right" data-original-title="Check out more demos" @click="editShade(m_shade)"><i class="fa fa-edit"></i></a>
                                            <a class="" href="#" @click="deleteShade(m_shade.id)"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
   </div>
    <div class="offcanvas offcanvas-right kt-color-panel p-5 kt_notes_panel" v-if="displayForm" :class="displayForm ? 'offcanvas-on' : ''">
        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-3">
            <h4 class="font-size-h4 font-weight-bold m-0">Add Shade</h4>
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
                        <label class="text-dark">Shade Name</label>
                        <input type="text" v-model='shade.name' class="form-control" />
                        <small class="form-text text-danger" v-if="errors.has('name')" v-text="errors.get('name')"></small>
                    </div>
                    
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" @click="toggleImageSelect()">Upload Shade Thumbnail</button>
                        <small id="textHelp" class="form-text text-muted">Select Image file from gallary.</small>
                        <small class="form-text text-danger" v-if="errors.has('media')" v-text="errors.get('media')"></small>

                        <img v-if="shade.media != ''" :src="shade.media" style="width:100px;height:100px;"/>
                    </div>
                </div>
            </div>
            <button type="button" @click="addUpdateShade()" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <attach-image @toggleImageSelect="toggleImageSelect" :showModal="showMediaSelector" @setImage="setImage"/>
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
            edit: false,
            shades:[],
            shade: {
                id:"",
                key: "",
                name: "",
                media: "",
            },
            showMediaSelector: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        };
    },
    methods: {
        fetchShades(){
            this.$parent.loading = true;
            let page_url = "/api/admin/shade";
            axios.get(page_url, this.token).then(res => {
                this.shades = res.data;
            }).finally(() => (this.$parent.loading = false));
        },
        clearForm(){
            this.displayForm = !this.displayForm;
            this.shade.id = '';
            this.shade.name = '';
            this.shade.media = '';
            this.edit = false;
        },
        addUpdateShade(){
            this.$parent.loading = true;
            var url = '/api/admin/shade';
            if (this.edit === false) {
                // Add
                this.request_method = 'post'
            } else {
                // Update
                var url = '/api/admin/shade/' + this.shade.id;
                this.request_method = 'put'
            }
            axios[this.request_method](url, this.shade, this.token)
                .then(res => {
                    if (res.data.status == "success") {
                        this.$toaster.success('Shade has been updated successfully')
                        this.clearForm();
                        this.fetchShades();
                    } else {
                        this.$toaster.error(res.message)
                    }
                })
                .catch(error => {
					this.error_message = '';
					this.errors = new ErrorHandling();
					if (error.response.status == 422) {
						if(error.response.data.status == 'Error'){
							this.error_message = error.response.data.message;
						}
						else{
							this.errors.record(error.response.data.errors);
						}
					}
				}).finally(() => (this.$parent.loading = false));
        },
        editShade(m){
            this.edit = true;
            this.displayForm = 1;
            this.errors = new ErrorHandling();
            this.shade.id = m.id;
            this.shade.name = m.name;
            this.shade.media = m.media;
        },
        deleteShade(id){
            let confirm = window.confirm("Are you sure?");
            if(!confirm) return;
            this.$parent.loading = true;
            axios.delete(`/api/admin/shade/${id}`,this.token)
            .then(res => {
                console.log(res);
                this.$toaster.success('Shade has been removed successfully')
                this.fetchShades();
            })
            .catch(error => {
                console.log(error);
                this.$toaster.error(error.message);
            })
            .finally(() => this.$parent.loading = false );
            
        },
        toggleImageSelect(){
            this.showMediaSelector = !this.showMediaSelector;
        },
        setImage(gallery){
            this.shade.media = gallery.gallary_path;
        }
    },
    mounted() {
        
        var token = localStorage.getItem('token');
        this.token = {
            headers: {
                Authorization: `Bearer ${token}`
            }
        };
        this.fetchShades();
     
    }
};
</script>
