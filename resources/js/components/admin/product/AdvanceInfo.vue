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
                        <label>&nbsp;</label>
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
                    <!-- <div class="col-md-6">
                        <div class="switch-h d-flex justify-content-between align-items-center border p-2 mb-3">
                            <label class="text-dark mb-0">Is Point</label>
                            <div class="custom-control switch custom-switch-info custom-switch custom-control-inline mr-0">
                                <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    id="customSwitchcolor446"
                                    :value="is_points"
                                    v-model="is_points"
                                    v-on:input="setIsPoints($event.target.value)" 
                                />
                                <label class="custom-control-label mr-1" for="customSwitchcolor446"></label>
                            </div>
                        </div>
                        <small class="form-text text-danger" v-if="errors.has('is_points')" v-text="errors.get('is_points')"></small>
                    </div> -->
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

                   
                    <div class="col-md-6">
                        <label>Brands</label>
                        <fieldset class="form-group mb-3">
                            <select @change="setBrand($event.target.value)" class="form-control single-select w-100 mb-3 categories-select ms-offscreen" v-model="brand_id">
                                <option value="">Select Brand</option>
                                <option v-for="brand in brands" v-bind:value="brand.brand_id" :key='brand.brand_id'>
                                    {{ brand.brand_name }}
                                </option>
                            </select>
                        </fieldset>
                        <small class="form-text text-danger" v-if="errors.has('brand_id')" v-text="errors.get('brand_id')"></small>
                    </div>

                 
                    <!-- Room -->
                    <div class="col-sm-6 mb-3">
                        <label>Kitchen/Foyer/Bathroom</label>
                        <select class="form-control" @change='setRoom($event.target.value)'>
                            <option>Select one option</option>
                            <option value='kitchen'>Kitchen</option>
                            <option value='foyer'>Foyer</option>
                            <option value='bathroom'>Bathroom</option>
                        </select>
                        <small class="form-text text-danger" v-if="errors.has('room')" v-text="errors.get('room')"></small>
                    </div>
                    <!-- Materials -->
                    <div class="col-sm-6 mb-3">
                        <label>Material</label>
                        <select class="form-control" @change='setMaterial($event.target.value)'>
                            <option>Select one option</option>
                            <option v-for="m_material in materials" :key='m_material.id' :value='m_material.id'>{{ m_material.name}}</option>
                        </select>
                        <small class="form-text text-danger" v-if="errors.has('material')" v-text="errors.get('material')"></small>

                    </div>
                   
                   
                    <div class="col-md-6">
                        <label>Price</label>
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
                    <!-- SKU -->
                    <div class="col-md-6">
                        <label>SKU</label>
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
                   
                </div>
            </form>
        </div>
    </div>

    <div class="card card-custom gutter-b b-white border-0">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Product Colors</label>
                    <multiselect 
                        v-model="color" 
                        :options="colors" 
                        placeholder="Select Colors" 
                        label="color" track-by="id" 
                        :multiple="true"  
                        :taggable="true" 
                        @input="setColor" 
                        @remove='removeColor' 
                    />
                    <small class="form-text text-danger" v-if="errors.has('colors')" v-text="errors.get('colors')"></small>
                </div>
                <!-- Shades -->
                <div class="col-sm-6 mb-3">
                    <label>Shades</label>
                    <select class="form-control" @change='setShade($event.target.value)'>
                        <option>Please select the shade</option>
                        <option v-for='s in shades' :key='s.id' :value='s.id'>{{s.name}}</option>
                    </select>
                    <small class="form-text text-danger" v-if="errors.has('shade')" v-text="errors.get('shade')"></small>
                </div>
                <!-- Finish -->
                <div class="col-sm-6 mb-3">
                    <label>Finish</label>
                    <select class="form-control" @change='setFinish($event.target.value)'>
                        <option>Select one option</option>
                        <option v-for='f in finishes' :key='f.id' :value='f.id'>{{ f.name }}</option>
                    </select>
                    <small class="form-text text-danger" v-if="errors.has('finish')" v-text="errors.get('finish')"></small>

                </div>
                <!-- Look & Trend -->
                <div class="col-sm-6 mb-3">
                    <label>Look & Trend</label>
                    <select class="form-control" @change='setLookTrend($event.target.value)'>
                        <option>Select one option</option>
                        <option v-for='lt in looktrends' :key='lt.id' :value='lt.id'>{{lt.name}}</option>
                    </select>
                    <small class="form-text text-danger" v-if="errors.has('look_trend')" v-text="errors.get('look_trend')"></small>
                    
                </div>
                <!-- Shapes -->
                <div class="col-sm-6 mb-3">
                    <label>Shapes</label>
                    <select class="form-control" @change='setShape($event.target.value)'>
                        <option>Select one option</option>
                        <option v-for='sh in shapes' :key='sh.id' :value='sh.id' >{{ sh.name }}</option>
                    </select>
                    <small class="form-text text-danger" v-if="errors.has('shape')" v-text="errors.get('shape')"></small>
                </div>
                <!-- Size of Box -->
                <div class="col-md-6 mb-3">
                    <label>Size of Box (pcs/box)</label>
                    <input 
                        type="number" 
                        class="form-control" 
                        placeholder="Please enter amount of tiles in a box"
                        v-on:input="setBoxSize($event.target.value)" 
                        v-model="boxSize" 
                    />
                </div>
                    <!-- Size -->
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Width (mm)</label>
                            <input type="number" class="form-control" placeholder="Width of tile (mm)" v-model='width' v-on:input='setWidth($event.target.value)' > 
                            <small class="form-text text-danger" v-if="errors.has('width')" v-text="errors.get('width')"></small>
                        </div>
                        <div class="col-md-6">
                            <label>Length (mm)</label>
                            <input type="number" class="form-control" placeholder="Length of tile(mm)" v-model='length' v-on:input='setLength($event.target.value)'>
                            <small class="form-text text-danger" v-if="errors.has('length')" v-text="errors.get('length')"></small>
                        </div>
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
            boxSize: '',
            width:'',
            length: '',
            shade:'',
            room: '',
            material: '',
            finish: '',
            look_trend: '',
            shape: '',
            made_in_usa: 1,
            specialty: '',
            new_sku: [],
            brands: [],
            product_type: 'simple',
            product_status: true,
            is_featured: true,
            is_points: true,
            brand_id: '',
            width: '',
            length: '',
            shade: '',
            price: '',
            sku: '',
            color:'',
            discount_price: '',
            product_min_order: '',
            product_max_order: '',
            showModal: false,
            currentSelectedGalleryName: '',
            lastSku: '',
            token: [],
            edit_combination_detail: [],
            editChild: false,
            displayClearBtn: 0,
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
        
        setColor(value, id) {
            this.$emit("setColorsInChild", value[value.length - 1].id, 'push');
        },
        removeColor(removedOption, id) {
            this.$emit("setColorsInChild", removedOption.id, 'remove');
        },
        setBoxSize(value) {
            this.$emit('setBoxSizeInChild', value);
        },
        setWidth(value){
            this.$emit('setWidthInChild', value);
        },
        setLength(value){
            this.$emit('setLengthInChild', value);
        },
        setShade(value){
            this.$emit('setShadeInChild', value);
        },
        setRoom(value){
            this.$emit('setRoomInChild', value);
        },
        setMaterial(value){
            this.$emit('setMaterialInChild', value);
        },
        setFinish(value){
            this.$emit('setFinishInChild', value);
        },
        setLookTrend(value){
            this.$emit('setLookTrendInChild', value);
        },
        setShape(value){
            this.$emit('setShapeInChild', value);
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
        setProductMinOrder(value) {
            this.$emit('setProductMinOrderInChild', value);
        },
        setProductMaxOrder(value) {
            this.$emit('setProductMaxOrderInChild', value);
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
        toggleImageSelect(name) {
            this.showModal = !this.showModal;
            this.currentSelectedGalleryName = name;
        },
        setImage(gallary) {
            // console.log(gallary);
            this.combinationGalleryPath[this.currentSelectedGalleryName] = gallary.gallary_path;
            this.combinationGallery[this.currentSelectedGalleryName] = gallary.gallary_id;
            this.setCombinationGallery(this.currentSelectedGalleryName);
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
    },
    props: ['product', 'errors', 'edit'],
};
</script>
