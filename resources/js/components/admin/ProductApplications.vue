<template>
    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-12 col-xl-12">
                                <div class="card card-custom gutter-b bg-transparent shadow-none border-0">
                                    <div class="card-header align-items-center  border-bottom-dark px-0">
                                        <div class="card-title mb-0">
                                            <h3 class="card-label mb-0 font-weight-bold text-body">
                                                Product Applications
                                            </h3>
                                        </div>
                                        <div class="icons d-flex">
                                            <button class="btn ml-2 p-0 kt_notes_panel_toggle" data-toggle="tooltip" title="" data-placement="right" data-original-title="Check out more demos" v-if="$parent.permissions.includes('product-applications')">
                                                <span class="bg-secondary h-30px font-size-h5 w-30px d-flex align-items-center justify-content-center  rounded-circle shadow-sm " v-on:click="
                                                            display_form = !display_form
                                                        ">
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

                                            <div id="productbrandTable_wrapper" class="dataTables_wrapper no-footer">

                                                <div class="dataTables_length" id="productbrandTable_length"><label>Show
                                                        <select name="productbrandTable_length" aria-controls="productbrandTable" class="" v-model="limit" v-on:change="fetchbrands()">
                                                            <option value="10">10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                            <option value="200">200</option>
                                                            <option value="500">500</option>
                                                            <option value="1000">1000</option>
                                                        </select> entries</label></div>

                                                <div id="productbrandTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="productbrandTable" v-model="searchParameter" @keyup="fetchbrands()"></label></div>
                                                <table id="productbrandTable" class="display dataTable no-footer" role="grid">
                                                    <thead class="text-body">
                                                        <tr role="row">
                                                            <th class="sorting" tabindex="0" aria-controls="productbrandTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 31.25px;" @click="sorting('id')" :class="(this.$data.sortType == 'asc' || this.$data.sortType == 'ASC') && this.$data.sortBy == 'id'  ? 'sorting_asc' : (this.$data.sortType == 'desc' || this.$data.sortType == 'DESC') && this.$data.sortBy == 'id' ? 'sorting_desc' : 'sorting'">
                                                                ID
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="productbrandTable" rowspan="1" colspan="1" aria-label="brand: activate to sort column ascending" style="width: 95.5288px;" @click="sorting('name')" :class="(this.$data.sortType == 'asc' || this.$data.sortType == 'ASC') && this.$data.sortBy == 'name'  ? 'sorting_asc' : (this.$data.sortType == 'desc' || this.$data.sortType == 'DESC') && this.$data.sortBy == 'name' ? 'sorting_desc' : 'sorting'">
                                                                Name
                                                            </th>
                                                            <th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Action" style="width: 53.1891px;">
                                                                Slug
                                                            </th>
                                                            <th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Action" style="width: 53.1891px;">
                                                                Status
                                                            </th>
                                                            <th v-if="$parent.permissions.includes('product-brand-manage')" class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Action" style="width: 53.1891px;">
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="kt-table-tbody text-dark">
                                                        <tr class="kt-table-row kt-table-row-level-0 odd" role="row" v-for="brand in brands" v-bind:key="brand.brand_id">
                                                            <td class="sorting_1">
                                                                {{brand.brand_id}}
                                                            </td>
                                                            <td>
                                                                {{ brand.brand_name }}
                                                            </td>
                                                            <td>
                                                                {{ brand.brand_slug }}
                                                            </td>
                                                            <td>
                                                                {{ brand.brand_status }}
                                                            </td>
                                                            <td v-if="$parent.permissions.includes('product-brand-manage')">
                                                                <a href="javascript:void(0)" class=" click-edit" id="click-edit1" data-toggle="tooltip" title="" data-placement="right" data-original-title="Check out more demos" @click="editbrand(brand)"><i class="fa fa-edit"></i></a>
                                                                <a class="" href="#" @click="deletebrand(brand.brand_id)"><i class="fa fa-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <ul class="pagination pagination-sm m-0 float-right">
                                                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]"><button class="page-link" href="#" @click="fetchbrands(pagination.prev_page_url)">Previous</button></li>

                                                    <li class="disabled"><button class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</button></li>

                                                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><button class="page-link" href="#" @click="fetchbrands(pagination.next_page_url)">Next</button></li>
                                                </ul>
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
    </div>
</template>

<script>
import ErrorHandling from "../../ErrorHandling";
export default {
    data() {
        return {
            display_form: 0,
            brand: {
                brand_id: "",
                brand_name: "",
                brand_status: "",
                gallary_id: ""
            },
            searchParameter: '',
            sortBy: 'id',
            sortType: 'ASC',
            limit: 10,
            error_message: '',
            edit: false,
            actions: false,
            pagination: {},
            request_method: "",
            countrySelected: "",
            stateSelected: "",
            brands: [],
            languages: [],
            token: [],
            selectedLanguage: '',
            showModal:false,
            gallary_path:"",
            errors: new ErrorHandling(),
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        };
    },

    methods: {
        fetchbrands(page_url) {
            this.$parent.loading = true;
            let vm = this;
            page_url = page_url || "/api/admin/brand";
            var arr = page_url.split('?');

            if (arr.length > 1) {
                page_url += '&limit=' + this.limit;
            } else {
                page_url += '?limit=' + this.limit;
            }
            if (this.searchParameter != null) {
                page_url += '&searchParameter=' + this.searchParameter;
            }
            page_url += '&sortBy=' + this.sortBy + '&sortType=' + this.sortType + '&getDetail=1';
            var responseData = {};

            axios.get(page_url, this.token).then(res => {
                this.brands = res.data.data;
                vm.makePagination(res.data.meta, res.data.links);
            }).finally(() => (this.$parent.loading = false));
        },
        makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            };

            this.pagination = pagination;
        },
        deletebrand(id) {
            if (confirm('Are You Sure?')) {
                this.$parent.loading = true;
                axios.delete(`/api/admin/brand/${id}`, this.token)
                    .then(res => {
                        if (res.data.status == "Success") {
                            this.$toaster.success('Settings has been updated successfully')
                            this.fetchbrands();
                        }

                    })
                    .catch(error =>{
                        if (error.response.status == 422) {
                            if(error.response.data.status == 'Error'){
                                this.$toaster.error(error.response.data.message)
                            } 
                        }
                    })
                    .finally(() => (this.$parent.loading = false));
            }
        },
        addUpdatebrand() {
            this.$parent.loading = true;
            var url = '/api/admin/brand';
            if (this.edit === false) {
                // Add
                this.request_method = 'post'
            } else {
                // Update
                var url = '/api/admin/brand/' + this.brand.brand_id;
                this.request_method = 'put'
            }
            axios[this.request_method](url, {
                    name: this.brand.brand_name,
                    gallary_id: this.brand.gallary_id,
                    status: this.brand.brand_status,
                }, this.token)
                .then(res => {
                    if (res.data.status == "Success") {
                        this.display_form = 0;
                        this.$toaster.success('Settings has been updated successfully')
                        this.clearForm();
                        this.fetchbrands();
                    } else {
                        this.$toaster.error(res.data.message)
                    }
                })
                .catch(error => {
                    this.error_message = '';
                    this.errors = new ErrorHandling();
                    if (error.response.status == 422) {
                        if (error.response.data.status == 'Error') {
                            this.error_message = error.response.data.message;
                        } else {
                            this.errors.record(error.response.data.errors);
                        }
                    }
                }).finally(() => (this.$parent.loading = false));

        },
        editbrand(brand) {
            this.edit = true;
            this.display_form = 1;
            this.errors = new ErrorHandling();
            this.brand.brand_id = brand.brand_id;
            this.brand.brand_name = brand.brand_name;
            this.brand.brand_status = brand.brand_status;

        },
        clearForm() {
            this.edit = false;
            this.brand.brand_id = null;
            this.brand.brand_name = '';
            this.brand.gallary_id = "";
            this.gallary_path = "";
            this.display_form = 0;
        },
        sorting(sortBy) {
            this.sortBy = sortBy;
            this.sortType = this.sortType == 'asc' || this.sortType == 'ASC' ? this.sortType = 'desc' : this.sortType = 'asc';
            this.fetchbrands();
        },
        setSelectedLanguage(selectedLanguage) {
            this.selectedLanguage = selectedLanguage;
            console.log("i am clicked", selectedLanguage)
        },
        toggleImageSelect(){
            this.showModal = !this.showModal;
        },
        setImage(gallary){
            console.log(gallary);
            this.gallary_path = gallary.gallary_path,
            this.brand.gallary_id = gallary.gallary_id;
        }
    },
    mounted() {

        var token = localStorage.getItem('token');
        this.token = {
            headers: {
                Authorization: `Bearer ${token}`
            }
        };
        this.fetchbrands();
    }
};
</script>