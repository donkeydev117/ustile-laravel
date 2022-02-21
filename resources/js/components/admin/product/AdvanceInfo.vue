<template>
<div>
    <div class="card card-custom gutter-b bg-white border-0">
        <div class="card-header border-0 align-items-center">
            <h3 class="card-label mb-0 font-weight-bold text-body">Advance Information
            </h3>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group row">
                    <div class="col-md-6 mb-3">
                        <div class="switch-h d-flex justify-content-between align-items-center border p-2">
                            <label class="text-dark mb-0">Is Active?</label>
                            <div class="custom-control switch custom-switch-info custom-switch custom-control-inline mr-0">
                                <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    id="customSwitchcolor445"
                                    :value="product_status"
                                    v-model="product_status"
                                    v-on:input="setProductStatus($event.target.value)" 
                                />
                                <label class="custom-control-label mr-1" for="customSwitchcolor445"></label>
                            </div>
                        </div>
                        <small class="form-text text-danger" v-if="errors.has('product_status')" v-text="errors.get('product_status')"></small>
                    </div>
                    <div class="col-md-6">
                        <div class="switch-h d-flex justify-content-between align-items-center border p-2 mb-3">
                            <label class="text-dark mb-0">Is Featured</label>
                            <div class="custom-control switch custom-switch-info custom-switch custom-control-inline mr-0">
                                <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    id="features"
                                    :value="is_featured"
                                    v-model="is_featured"
                                    v-on:input="setIsFeatured($event.target.value)" 
                                />
                                <label class="custom-control-label mr-1" for="features"></label>
                            </div>
                        </div>
                        <small class="form-text text-danger" v-if="errors.has('is_featured')" v-text="errors.get('is_featured')"></small>
                    </div>
                  
                    <div class="col-md-6">
                        <label>Brands *</label>
                        <fieldset class="form-group mb-3">
                            <select 
                                @change="setBrand($event.target.value)" 
                                class="form-control single-select w-100 mb-3 categories-select ms-offscreen" 
                                v-model="brand_id"
                            >
                                <option value="">Select Brand</option>
                                <option v-for="brand in brands" v-bind:value="brand.brand_id" :key='brand.brand_id' :selected="brand_id">
                                    {{ brand.brand_name }}
                                </option>
                            </select>
                        </fieldset>
                        <small class="form-text text-danger" v-if="errors.has('brand_id')" v-text="errors.get('brand_id')"></small>
                    </div>
                    <!-- Room -->
                    <div class="col-sm-6 mb-3">
                        <label>Kitchen/Foyer/Bathroom *</label>
                         <multiselect 
                            v-model="application" 
                            :options="applications" 
                            placeholder="Select Applications" 
                            label="name" 
                            track-by="value" 
                            :multiple="true" 
                            :taggable="true"
                            @input='setApplication'
                            @remove='removeApplication'
                        >
                        </multiselect>
                        <small class="form-text text-danger" v-if="errors.has('room')" v-text="errors.get('room')"></small>
                    </div>
                    <!-- Materials -->
                    <div class="col-sm-6 mb-3">
                        <label>Material *</label>
                        <select class="form-control" @change='setMaterial($event.target.value)' v-model='material'>
                            <option value="">Select one option</option>
                            <option v-for="m_material in materials" :key='m_material.id' :value='m_material.id'>{{ m_material.name}}</option>
                        </select>
                        <small class="form-text text-danger" v-if="errors.has('material')" v-text="errors.get('material')"></small>

                    </div>
                     <!-- SKU -->
                    <div class="col-md-6">
                        <label>SKU *</label>
                        <fieldset class="form-group mb-3">
                            <input 
                                type="text" 
                                id="type-max" 
                                class="form-control text-dark" 
                                placeholder="Enter Sku" 
                                v-on:input="setProductsku($event.target.value)" 
                                v-model="sku"
                            />
                        </fieldset>
                        <small class="form-text text-danger" v-if="errors.has('sku')" v-text="errors.get('sku')"></small>
                    </div>
                   
                   
                    <div class="col-md-6">
                        <label>Price *</label>
                        <fieldset class="form-group mb-3">
                            <input 
                                type="text" 
                                class="form-control text-dark" 
                                placeholder="Enter Price" 
                                v-on:input="setPrice($event.target.value)" 
                                v-model="price"
                            />
                        </fieldset>
                        <small class="form-text text-danger" v-if="errors.has('price')" v-text="errors.get('price')"></small>
                    </div>
                    <div class="col-md-6">
                        <label>Discount Price</label>
                        <fieldset class="form-group mb-3">
                            <input 
                                type="text" 
                                class="form-control text-dark" 
                                placeholder="Enter Discount Price" 
                                v-on:input="setDiscountPrice($event.target.value)" 
                                v-model="discount_price"
                            />
                        </fieldset>
                        <small class="form-text text-danger" v-if="errors.has('discount_price')" v-text="errors.get('discount_price')"></small>
                    </div>
                    <!-- <div class="col-md-6">
                        <label>Minimum Order</label>
                        <fieldset class="form-group mb-3">
                            <input 
                                type="text" 
                                id="type" 
                                class="form-control text-dark" 
                                placeholder="Enter Minimum Order" 
                                v-on:input="setProductMinOrder($event.target.value)" 
                                v-model="product_min_order" 
                            />
                        </fieldset>
                        <small class="form-text text-danger" v-if="errors.has('product_min_order')" v-text="errors.get('product_min_order')"></small>
                    </div>
                    <div class="col-md-6">
                        <label>Maximum Order</label>
                        <fieldset class="form-group mb-3">
                            <input 
                                type="text" 
                                id="type-max" 
                                class="form-control text-dark" 
                                placeholder="Enter Maximum Order" 
                                v-on:input="setProductMaxOrder($event.target.value)" 
                                v-model="product_max_order" 
                            />
                        </fieldset>
                        <small class="form-text text-danger" v-if="errors.has('product_max_order')" v-text="errors.get('product_max_order')"></small>
                    </div> -->
                   

                       <!-- Made in USA -->
                    <div class="col-sm-6 mb-3">
                        <div class="switch-h d-flex justify-content-between align-items-center border p-2">
                            <label class="text-dark mb-0">Made in USA</label>
                            <div class="custom-control switch custom-switch-info custom-switch custom-control-inline mr-0">
                                <input 
                                    type="checkbox"
                                    class="custom-control-input"
                                    id="madeInUsa"
                                    :value="made_in_usa"
                                    v-model="made_in_usa"
                                    v-on:input="setMadeInUsa($event.target.value)"
                                />
                                <label class="custom-control-label mr-1" for="madeInUsa"></label>
                            </div>
                        </div>
                    </div>
                     <div class="col-sm-6 mb-3">
                        <label>Shipping Status *</label>
                         <multiselect 
                            v-model="shipping" 
                            :options="shipping_status" 
                            placeholder="Select shipping status" 
                            label="name" 
                            track-by="value" 
                            :multiple="true" 
                            :taggable="true"
                            @input='setShippingStatus'
                            @remove='removeShippingStatus'
                        >
                        </multiselect>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-custom gutter-b b-white border-0">
        <div class="card-header border-0 align-items-center">
            <h3 class="card-label mb-0 font-weight-bold text-body">Variants</h3>
            <button class="btn btn-primary btn-sm" @click.prevent='displayCreateVariationModal()'>Create</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Color</th>
                                    <th>Shade</th>
                                    <th>Finish</th>
                                    <th>Look</th>
                                    <th>Shape</th>
                                    <th>Box Size</th>
                                    <th>Width</th>
                                    <th>Length</th>
                                    <th>Price</th>
                                    <th>SKU</th>
                                    <th>Primary</th>
                                    <th>Media</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, index) in variants" :key='index'>
                                    <td>{{ v.name }}</td>
                                    <td>{{v.color.color}}</td>
                                    <td>{{v.shade.name}}</td>
                                    <td>{{v.finish.name}}</td>
                                    <td>{{v.look.name}}</td>
                                    <td>{{v.shape.name}}</td>
                                    <td>{{v.box_size}}</td>
                                    <td>{{v.width == "" ? "" : v.width + '"'}} </td>
                                    <td>{{v.length == "" ? "" : v.length + '"'}}</td>
                                    <td>{{v.price}}</td>
                                    <td>{{v.sku}}</td>
                                    <td>{{v.is_primary == 1 ? "Primary" : ""}}</td>
                                    <td>
                                        <button v-if='v.media==""' class="btn btn-sm btn-primary" @click.prevent="toggleImageSelect(index)">Add</button>
                                        <img v-if="v.media != null" :src="v.media.gallary_path" class='variant-image' />
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" @click.prevent="removeVariant(index)">Remove</button>
                                        <button class="btn btn-primary btn-sm" @click.prevent="showEditVariantModal(index)">Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <a data-toggle="pill" @click.prevent="setActive('info-tab')" :class="{ active: isActive('info-tab') }" class="btn btn-dark swipe-to-top cta ">Back</a>
            <a data-toggle="pill" href="#" class="btn btn-primary cta ml-2" @click.prevent="setActive('seo-tab')" :class="{ active: isActive('seo-tab') }">Continue</a>
        </div>
    </div>
    <attach-image @toggleImageSelect="toggleImageSelect" :showModal="showModal" @setImage="setImage" />
    <attach-image @toggleImageSelect="toggleImageSelectForNew" :showModal="showImageSelectModalForNewVariant" @setImage="setImageForNewVariant" />

    
    <div class="modal fade" :class="{'show': showCreateVariationModal }" tabindex="-1" role="dialog" :style="[showCreateVariationModal ? {'display': 'block !important'} : {'display': 'none'}]" style="overflow: scroll; z-index: 1">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Variation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label class="control-label" for="variation-title">Name</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        placeholder="Variation Name"
                                        id="variation-title" 
                                        v-model="variant.name" 
                                    />
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="control-label" for="variation-color">Color</label>
                                    <select class="form-control"  v-on:change='changeColor($event.target.value)' id="variation-color" >
                                        <option value=''></option>
                                        <option v-for='c in colors' :key='c.id' :value='c.id'>{{c.color}}</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="control-label" for="variation-shade">Shade</label>
                                    <select class="form-control"  v-on:change='changeShade($event.target.value)' id="variation-shade">
                                        <option value=''></option>
                                        <option v-for='s in shades' :key='s.id' :value='s.id'>{{s.name}}</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="control-label" for="variation-finish">Finish</label>
                                    <select class="form-control" v-on:change="changeFinish($event.target.value)" id="variation-finish">
                                        <option value=''></option>
                                        <option v-for='f in finishes' :key='f.id' :value='f.id'>{{ f.name }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="control-label" for="variation-look">Look</label>
                                    <select class="form-control"  v-on:change='changeLook($event.target.value)' id="variation-look">
                                        <option value=''></option>
                                        <option v-for='lt in looktrends' :key='lt.id' :value='lt.id'>{{lt.name}}</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="control-label" for="variation-shape">Shape</label>
                                    <select class="form-control" v-on:change='changeShape($event.target.value)'  id="variation-shape">
                                        <option value=''></option>
                                        <option v-for='sh in shapes' :key='sh.id' :value='sh.id' >{{ sh.name }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="control-label" for="variation-boxsize">Box Size</label>
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        placeholder="Box size *"
                                        v-model="variant.box_size" 
                                        id="variation-boxsize"
                                    />
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="control-label" for="variation-width">Width</label>
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        placeholder="Width(inch) *" 
                                        v-model='variant.width' 
                                        id="variation-width"
                                    > 
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="control-label" for="variation-length">Length</label>
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        placeholder="Length(inch) *" 
                                        v-model='variant.length'
                                        id="variation-length"
                                    >
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="control-label" for="variation-price">Price</label>
                                    <input 
                                        class="form-control"
                                        type="number"
                                        step='0.1' 
                                        placeholder="Price *" 
                                        v-model='variant.price'
                                        id="variation-price"
                                    />
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="control-label" for="variation-sampleprice">Sample Price</label>
                                    <input 
                                        class="form-control"
                                        type="number"
                                        step='0.1' 
                                        placeholder="Sample Price *" 
                                        v-model='variant.sample_price'
                                        id="variation-sampleprice"
                                    />
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="control-label" for="variation-sku">SKU</label>
                                    <input 
                                        class="form-control"
                                        placeholder="SKU *" 
                                        v-model='variant.sku'
                                        id="variation-sku"
                                    />
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="control-label" for='variation-primary'>Primary Variation</label>
                                    <select class="form-control" id="variation-primary" v-model='variant.is_primary'>
                                        <option value='0'>No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 form-group">
                                    <div class="">
                                        <button class="btn btn-primary btn-sm" @click.prevent="toggleImageSelectForNew()">Add Media</button>
                                    </div>
                                    <div class="mt-2">
                                        <img 
                                            v-if="variant.media != null"
                                            :src="variant.media.gallary_path"
                                            class='variant-image'
                                            style='width: 100px;height:100px'
                                        />
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click.prevent='createVariant()'>Create</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click.prevent="hideCreateVariationModal()">Close</button>
                </div>
            </div>
        </div>
    </div>


</div>
</template>

<script>
import Multiselect from 'vue-multiselect'

export default {
    components: {
        Multiselect
    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            colors: [],
            materials: [],
            shades: [],
            finishes: [],
            looktrends: [],
            shapes: [],
            applications: [
                { value : 'kitchen', name: "Kitchen"},
                { value : 'foyer', name: "Foyer"},
                { value : 'bathroom', name: "Bathroom"},
            ],
            application: [],
            material: '',
            made_in_usa: 1,
            specialty: '',
            brands: [],
            shipping_status: [],
            shipping:[],
            product_type: 'simple',
            product_status: true,
            is_featured: true,
            is_points: true,
            brand_id: '',
            price: '',
            sku: '',
            discount_price: '',
            product_min_order: '',
            product_max_order: '',
            showModal: false,
            showCreateVariationModal: false,
            currentSelectedGalleryName: '',
            lastSku: '',
            token: [],
            edit_combination_detail: [],
            editChild: false,
            displayClearBtn: 0,
            variants: [],
            showImageSelectModalForNewVariant : false,
            editMediaIndex: -1,
            variant: {
                name: "",
                color: '',
                shade: '',
                finish: '',
                look: '',
                shape: '',
                box_size: '',
                width: '',
                length: '',
                price: this.price,
                sample_price: "",
                sku: this.sku,
                is_primary : 0,
                media: null
            },
        };
    },
    methods: {
        fetchColors() {
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};
            axios.get("/api/admin/color", config)
                .then(res => {
                    this.colors = res.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        fetchBrands() {
            this.$parent.$parent.loading = true;
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};

            axios.get('/api/admin/brand?getAllData=1', config)
                .then(res => {
                    if (res.data.status == "Success") {
                        this.brands = res.data.data;
                        this.brand_id = this.product.brand_id;
                    }
                })
                .finally(() => (this.$parent.$parent.loading = false));
        },
        fetchMaterials(){
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};
            axios.get("/api/admin/material", config)
                .then(res => {
                    this.materials = res.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        fetchShades(){
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};
            axios.get("/api/admin/shade", config)
                .then(res => {
                    this.shades = res.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        fetchFinishes(){
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};
            axios.get("/api/admin/finish", config)
                .then(res => {
                    this.finishes = res.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        fetchLookTrends(){
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};
            axios.get("/api/admin/looktrend", config)
                .then(res => {
                    this.looktrends = res.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        fetchShapes(){
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};
            axios.get("/api/admin/shape", config)
                .then(res => {
                    this.shapes = res.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },

        fetchShippingStatus(){
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};
            axios.get("/api/admin/get_all_shipping_status", config)
                .then(res => {
                    // this.shapes = res.data;
                    console.log(res.data);
                    const data = res.data.data.map((item, index) => {
                        console.log("item:", item);
                        return {
                            value: item.id,
                            name : item.name
                        }
                    })

                    this.shipping_status = data;
                })
                .catch(error => {
                    console.log(error);
                })
        },

        setMaterial(value){
            this.$emit('setMaterialInChild', value);
        },
        setMadeInUsa(value){
            this.$emit('setMadeInUsaInChild', value);
        },
        setSepcialty(value){
            this.$emit('setSpecialtyInChild', value);
        },

        setBrand(value) {
            this.$emit('setBrandInChild', value);
        },
        setProductsku(value) {
            this.$emit('setProductskuInChild', value);
        },
        setPrice(value) {
            this.$emit('setPriceInChild', value);
        },
        setDiscountPrice(value) {
            this.$emit('setDiscountPriceInChild', value);
        },
        setProductStatus(value) {
            this.$emit('setProductStatusInChild', value);
        },
        setIsFeatured(value) {
            this.$emit('setIsFeaturedInChild', value);
        },
        setIsPoints(value) {
            this.$emit('setIsPointsInChild', value);
        },
        isActive(value) {
            this.$emit('isActiveInChild', value);
        },
        setActive(value) {
            this.$emit('setActiveInChild', value);
        },
        setApplication(value, id) {
            this.$emit("setApplicationInChild", value[value.length - 1].value, 'push');
        },
        removeApplication(removedOption, id) {
            this.$emit("setApplicationInChild", removedOption.value, 'remove');
        },
        setShippingStatus(value, id) {
            this.$emit("setShippingInChild", value[value.length - 1].value, 'push');
        },
        removeShippingStatus(removedOption, id) {
            this.$emit("setShippingInChild", removedOption.value, 'remove');
        },
        changeColor(colorId){
            if(colorId == '') {
                this.variant.color = '';
                return;
            }
            const color = this.colors.find(c => c.id == colorId);
            this.variant.color = color;
        },
        changeShade(shadeId){
            if(shadeId == ''){
                this.variant.shade = '';
                return;
            }
            const shade = this.shades.find(s => s.id == shadeId);
            this.variant.shade = shade
        },
        changeFinish(finishId){
            if(finishId == ''){
                this.variant.finish = '';
                return;
            }
            const finish = this.finishes.find(s => s.id == finishId);
            this.variant.finish = finish;
        },
        changeShape(shapeId){
            if(shapeId == ''){
                this.variant.shade = '';
                return;
            }
            const shape = this.shapes.find(s => s.id == shapeId);
            this.variant.shape = shape;
        },
        changeLook(lookId) {
            if(lookId == ''){
                this.variant.look = '';
                return;
            }
            const look = this.looktrends.find(s => s.id == lookId);
            this.variant.look = look;
        },
        formatNumberLength(num, length) {
            var r = "" + num;
            while (r.length < length) {
                r = "0" + r;
            }
            return r;
        },

        cartesian(args) {
            var r = [],
                max = args.length - 1;

            function helper(arr, i) {
                for (var j = 0, l = args[i].length; j < l; j++) {
                    var a = arr.slice(0); // clone arr
                    a.push(args[i][j]);
                    if (i == max)
                        r.push(a);
                    else
                        helper(a, i + 1);
                }
            }
            helper([], 0);
            return r;
        },
        
        validateVariant(){
            if( this.variant.name == '' ||
                this.variant.color == '' ||
                this.variant.shade == '' ||
                this.variant.finish == '' ||
                this.variant.look == '' ||
                this.variant.shape == '' ||
                this.variant.box_size == '' ||
                this.variant.width == '' ||
                this.variant.length == '' ||
                this.variant.price == '' ||
                this.variant.sku == ''
            ) return false;
            return true;
        },
        createVariant(){
            if(!this.validateVariant()){
                alert("Invalid Variation!");
                return;
            }
            this.variants = [...this.variants, this.variant];
            this.$emit('setVarinatInChild', this.variant);
            this.showCreateVariationModal = false;
            this.variant = {
                name: "",
                color: '',
                shade: '',
                finish: '',
                look: '',
                shape: '',
                box_size: '',
                width: '',
                length: '',
                price: '',
                sample_price:"",
                sku: '',
                is_primary: 0,
                media: ''
            };
        },
        displayCreateVariationModal(){
            this.showCreateVariationModal = true;
        },
        hideCreateVariationModal(){
            this.showCreateVariationModal = false;
        },

        removeVariant(index){
            const variants = [...this.variants];
            variants.splice(index, 1);
            this.variants = variants;
            this.$emit('removeVariantInChild', index);
        },

        toggleImageSelect(index) {
            this.editMediaIndex = index;
            this.showModal = !this.showModal;
        },
        toggleImageSelectForNew(){
            this.showImageSelectModalForNewVariant = !this.showImageSelectModalForNewVariant;
        },
        setImageForNewVariant(gallary){
            console.log(gallary);
            this.variant.media = gallary;
        },
        setImage(gallary) {
            this.variants[this.editMediaIndex].media = gallary;
            this.$emit('setVariantImageInChild', this.editMediaIndex, gallary);
        }
    },
    mounted() {
        var token = localStorage.getItem('token');
        this.token = {
            headers: {
                Authorization: `Bearer ${token}`
            }
        };
        this.fetchBrands();
        this.fetchColors();
        this.fetchMaterials();
        this.fetchShades();
        this.fetchFinishes();
        this.fetchLookTrends(); 
        this.fetchShapes();
        this.fetchShippingStatus();
    },
     watch: {
        product(newVal, oldVal) {
            this.editChild = this.$parent.edit;
            this.product_type = newVal.product_type;
            this.sku = newVal.sku;
            this.brand_id = newVal.brand_id;
            newVal.variants.map((variant, index) => {
                if(variant.media){
                    const media = {
                        gallary_id: variant.media.id,
                        gallary_path : "/gallary/" + variant.media.name
                    };
                    this.variants = [...this.variants, {...variant, media}]
                } else {
                    this.variants = [...this.variants, variant]
                }
            })

            this.material = newVal.material;
            this.price = newVal.price;
            this.discount_price = newVal.discount_price;
            this.made_in_usa = newVal.made_in_usa;
            this.is_featured = newVal.is_featured;
            this.is_active = newVal.is_active;
            newVal.applications.map(a => {
                const app = this.applications.find(b => b.value === a);
                this.application = [...this.application, app]
            });
            const shippingStatus = this.shipping_status;
            console.log(shippingStatus);
            if(newVal.shipping_status){
                this.shipping = newVal.shipping_status.map(function(item, index){
                    const shippingItem = shippingStatus.find((s) => s.value == item);
                    return shippingItem;
                });
            }
           
            // console.log(this.shipping);
        }
    },
    props: ['product', 'errors', 'edit'],
};
</script>

<style scoped>
    .btn-sm {
        padding: 0.25rem 0.5rem !important;
        font-size: 0.875rem !important;
        line-height: 1.5 !important;
        border-radius: 0.2rem !important;
    }
    .variant-image {
        width: 50px;
        height: 50px;
    }
</style>
