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
                    <div class="col-md-6">
                        <label>Product Colors</label>
                        <fieldset class="form-group">
                            <multiselect 
                                v-model="color" 
                                :options="colors" 
                                :custom-label="nameWithLang" 
                                placeholder="Select one" 
                                label="color" track-by="id" 
                                :multiple="true"  
                                :taggable="true" 
                                @input="setColor" 
                                @remove='removeColor' 
                            />
                            <small class="form-text text-danger" v-if="errors.has('product_type')" v-text="errors.get('product_type')"></small>
                        </fieldset>
                    </div>
                    <div class="col-md-6">
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
                    <div class="col-md-6">
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
                    </div>
                    <div class="col-md-6">
                        <div class="switch-h d-flex justify-content-between align-items-center border p-2 mb-3">
                            <label class="text-dark mb-0">Is Feature</label>
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
                    <!-- <div class="col-md-6">
                        <label>Units</label>
                        <fieldset class="form-group mb-3">
                            <select @change="setUnit($event.target.value)" class="form-control single-select w-100 mb-3 categories-select ms-offscreen" v-model="product_unit">
                                <option value="">Select Unit</option>
                                <option v-for="unit in units" v-bind:value="unit.id" :key='unit.id'>
                                    {{ unit.detail == null ? '' : (unit.detail[0] ? unit.detail[0].name : '') }}
                                </option>
                            </select>
                        </fieldset>
                        <small class="form-text text-danger" v-if="errors.has('product_unit')" v-text="errors.get('product_unit')"></small>
                    </div> -->
                    <!-- Size of Box -->
                    <div class="col-md-6 mb-3">
                        <label>Size of Box (pcs/box)</label>
                        <input type="number" class="form-control" placeholder="Please enter amount of tiles in a box" />
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

                    <!-- Size -->
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Width (mm)</label>
                                <input type="number" class="form-control" placeholder="Width of tile (mm)" > 
                                <small class="form-text text-danger" v-if="errors.has('width')" v-text="errors.get('width')"></small>
                            </div>
                            <div class="col-md-6">
                                <label>Length (mm)</label>
                                <input type="number" class="form-control" placeholder="Length of tile(mm)">
                                <small class="form-text text-danger" v-if="errors.has('length')" v-text="errors.get('length')"></small>
                            </div>
                        </div>
                    </div>
                    <!-- Shades -->
                    <div class="col-sm-6 mb-3">
                        <label>Shades</label>
                        <select class="form-control">
                            <option>Please select the shade</option>
                        </select>
                    </div>
                    <!-- Room -->
                    <div class="col-sm-6 mb-3">
                        <label>Kitchen/Foyer/Bathroom</label>
                        <select class="form-control">
                            <option>Select one option</option>
                            <option value='kitchen'>Kitchen</option>
                            <option value='foyer'>Foyer</option>
                            <option value='bathroom'>Bathroom</option>
                        </select>
                    </div>
                    <!-- Materials -->
                    <div class="col-sm-6 mb-3">
                        <label>Material</label>
                        <select class="form-control">
                            <option>Select one option</option>
                        </select>
                    </div>
                    <!-- Finish -->
                    <div class="col-sm-6 mb-3">
                        <label>Finish</label>
                        <select class="form-control">
                            <option>Select one option</option>
                        </select>
                    </div>
                    <!-- Look & Trend -->
                    <div class="col-sm-6 mb-3">
                        <label>Look & Trend</label>
                        <select class="form-control">
                            <option>Select one option</option>
                        </select>
                    </div>
                    <!-- Shapes -->
                    <div class="col-sm-6 mb-3">
                        <label>Shapes</label>
                        <select class="form-control">
                            <option>Select one option</option>

                        </select>
                    </div>
                    <!-- Made in USA -->
                    <div class="col-sm-6 mb-3">
                        <label>Made in USA</label>
                        <div class="switch-h d-flex justify-content-between align-items-center border p-2">
                            <label class="text-dark mb-0">Made in USA</label>
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
                    <div class="col-md-6">
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
                    </div>

                    <!-- Speciality -->
                    <div class="col-md-6 mb-3">
                        <label>Speciality</label>
                        <input class="form-control" type="text" placeholder="Speciality" />
                    </div>

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
            units: [],
            new_sku: [],
            brands: [],
            attributes: [],
            variations: [],
            product_type: 'variable',
            attribute: '',
            selectedAttribute: [],
            product_status: true,
            is_featured: true,
            is_points: true,
            product_unit: '',
            product_weight: '',
            brand_id: '',
            price: '',
            sku: '',
            color:'',
            discount_price: '',
            product_min_order: '',
            product_max_order: '',
            combinationPrice: {},
            combinationSku: {},
            combinationGallery: {},
            combinationGalleryPath: {},
            variationData: {},
            combinations: [],
            combinationDetail: [],
            allVariations: [],
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
        fetchUnits() {
            this.$parent.$parent.loading = true;
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};

            axios.get('/api/admin/unit?getAllData=1&getDetail=1', config)
                .then(res => {
                    if (res.data.status == "Success") {
                        this.units = res.data.data;
                    }
                })
                .finally(() => (this.$parent.$parent.loading = false));
        },
        fetchAttributes() {
            this.$parent.$parent.loading = true;
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};

            axios.get('/api/admin/attribute?getAllData=1&getDetail=1', config)
                .then(res => {
                    if (res.data.status == "Success") {
                        this.attributes = res.data.data;
                    }
                })
                .finally(() => (this.$parent.$parent.loading = false));
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
        setUnit(value) {
            this.$emit('setUnitInChild', value);
        },
        setBrand(value) {
            this.$emit('setBrandInChild', value);
        },
        setProductWeight(value) {
            this.$emit('setProductWeightInChild', value);
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
        setProductType(value) {
            this.$emit('setProductTypeInChild', value);
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

        setAttributes(value) {
            this.$emit('setAttributesInChild', value);
        },
        isActive(value) {
            this.$emit('isActiveInChild', value);
        },
        setActive(value) {
            this.$emit('setActiveInChild', value);
        },
        setColor(value, id) {
            this.$emit("setColorInChild", value[value.length - 1].id, 'push');
        },
        removeColor(removedOption, id) {
            this.$emit("setColorInChild", removedOption.id, 'remove');
        },
        setCombinationPrice(name, price) {
            console.log(name, price)
            var newprice = price != null ? price : this.price;
            if (this.combinationPrice[name] == null) {
                this.combinationPrice[name] = newprice;
            }
            this.$emit('setCombinationPriceInChild', name, newprice);
        },
        setCombinationSku(name, sku) {
            console.log(name, sku);
            var newsku = sku != null ? sku : this.sku;

            this.$emit('setCombinationSkuInChild', name, newsku);
        },
        setCombinationGallery(name) {
            if (this.combinationGallery[name] == null) {
                this.combinationGallery[name] = 0;
            }
            this.$emit('setCombinationGalleryInChild', name, this.combinationGallery[name]);
        },
        unsetVariationData() {
            this.variations = [];
            this.variationData = {};
            this.selectedAttribute = [];
            this.combinationDetail = [];
            this.combinationPrice = {};
            this.combinationSku = {};
            this.combinationGallery = {};
            this.combinations = [];
            this.combinationGalleryPath = {};
            this.displayClearBtn = 0;

        },
        setVariations(name) {
            if (this.edit == 0 && (this.price == '' || this.sku == '')) {
                this.$toaster.error('Price or Sku Field can"t be empty');
                return
            }

            this.$emit('setVariationsInChild', name, this.variationData[name]);
            // Check variation is selected against every attribute
            var totalVariations = 0;

            for (var i = 0; i < this.selectedAttribute.length; i++) {
                // console.log(this.variationData[i]);
                if (this.variationData['variation_' + this.selectedAttribute[i]].length > 0) {
                    totalVariations = parseInt(totalVariations) + 1;
                }
            }

            if (this.selectedAttribute.length != totalVariations) {
                this.combinationDetail = [];
                return;
            }
            if (this.edit == 0) {
                this.displayClearBtn = 1;
            }

            // create product combinations
            this.combinationDetail = [];
            this.combinationPrice = {};
            this.combinationSku = {};
            this.combinationGallery = {};
            this.combinations = [];
            for (var i = 0; i < this.selectedAttribute.length; i++) {
                this.combinations.push(this.variationData['variation_' + this.selectedAttribute[i]]);
            }

            this.makeCombinationData();

        },

        makeCombinationData() {
            var res = this.cartesian(this.combinations);
            console.log(this.lastSku, "last sku");
            var new_sku, sku_no;
            new_sku = this.lastSku;
            for (var i = 0; i < res.length; i++) {
                var arr = {};
                var price = 'combination_price_';
                var sku = 'combination_sku_';
                var gallary = 'combination_gallary_';
                var variation_name = '';
                for (var j = 0; j < res[i].length; j++) {
                    if (this.allVariations[res[i][j]] == null) {
                        continue;
                    }
                    if (res[i].length - 1 == j) {

                        if (!this.edit) {
                            arr.new_sku = this.sku + '-' + (i + 1);
                            arr.price = this.price;
                        }
                        variation_name += this.allVariations[res[i][j]] == null ? '' : this.allVariations[res[i][j]];
                        arr.variation_name = variation_name;

                        arr.price = price + res[i][j];
                        arr.sku = sku + res[i][j];
                        arr.gallary = gallary + res[i][j];
                        if (!this.edit) {
                            this.setCombinationPrice(arr.price, null);
                            this.combinationSku[arr.sku] = arr.new_sku;
                            this.setCombinationSku(arr.sku, null);
                        }
                    } else {
                        variation_name += this.allVariations[res[i][j]] == null ? '' : this.allVariations[res[i][j]] + ' - ';

                        price = price + res[i][j] + '_';
                        sku = sku + res[i][j] + '_';
                        gallary = gallary + res[i][j] + '_';
                    }
                }
                if (arr.hasOwnProperty('price') != false) {

                    this.combinationDetail.push(arr);
                }

            }
            // console.log(this.edit_combination_detail.length);
            if (this.combinationDetail.length > 0 && this.edit_combination_detail.length > 0) {
                for (var i = 0; i < res.length; i++) {
                    var variation_id = [];
                    var price_name = 'combination_price_';
                    var sku_name = 'combination_sku_';
                    var gallary_name = 'combination_gallary_';
                    for (var j = 0; j < res[i].length; j++) {
                        variation_id.push(res[i][j]);
                        if (res[i].length - 1 == j) {
                            price_name = price_name + res[i][j];
                            sku_name = sku_name + res[i][j];
                            gallary_name = gallary_name + res[i][j];

                            for (var j = 0; j < this.edit_combination_detail.length; j++) {
                                var is_combination = [];
                                var edit_variation_id = [];
                                for (var jj = 0; jj < this.edit_combination_detail[j].combination.length; jj++) {
                                    if (variation_id.indexOf(this.edit_combination_detail[j].combination[jj].variation_id) > -1) {
                                        is_combination.push(1);
                                    } else {
                                        is_combination.push(0);
                                    }

                                }
                                if (is_combination.indexOf(0) == -1) {
                                    // console.log(price_name + ' => ' + this.edit_combination_detail[j].price);
                                    this.combinationPrice[price_name] = this.edit_combination_detail[j].price;
                                    this.setCombinationPrice(price_name, this.edit_combination_detail[j].price);
                                    this.combinationSku[sku_name] = this.edit_combination_detail[j].sku;

                                    this.setCombinationSku(sku_name, this.edit_combination_detail[j].sku);
                                    this.combinationGalleryPath[gallary_name] = '/gallary/' + this.edit_combination_detail[j].gallary.gallary_name;
                                    this.combinationGallery[gallary_name] = this.edit_combination_detail[j].gallary.id;
                                    this.setCombinationGallery(gallary_name);
                                }

                            }
                        } else {
                            price_name = price_name + res[i][j] + '_';
                            sku_name = sku_name + res[i][j] + '_';
                            gallary_name = gallary_name + res[i][j] + '_';
                        }
                    }

                }
            }

        },

        formatNumberLength(num, length) {
            var r = "" + num;
            while (r.length < length) {
                r = "0" + r;
            }
            return r;
        },

        searchVariationName(variation_id) {
            for (var i = 0; i < this.variations.length; i++) {
                for (var j = 0; i < this.variations[i].variations.length; j++) {
                    if (this.variations[i].variations[j].id == variation_id) {
                        return this.variations[i].variations[j].detail == null ? '' : this.variations[i].variations[j].detail[0].name;
                    }
                }
            }
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
        getVariation() {
            this.$parent.$parent.loading = true;
            var token = localStorage.getItem('token');
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            };
            var responseData = {};

            if (this.selectedAttribute.indexOf(this.attribute) < 0) {
                this.selectedAttribute.push(this.attribute);
                this.setAttributes(this.attribute);
            } else {
                this.$parent.$parent.loading = false;
                return false;
            }
            var name = 'variation_' + this.attribute;
            this.$set(this.variationData, name, []);

            axios.get('/api/admin/attribute/' + this.attribute + '?getVariation=1&getDetail=1', config)
                .then(res => {
                    if (res.data.status == "Success") {
                        this.variations.push(res.data.data);
                        // this.variations = res.data.data;
                    }
                })
                .finally(() => (this.$parent.$parent.loading = false));
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
    watch: {
        product(newVal, oldVal) {
            console.log(newVal, "newval");
            this.editChild = this.$parent.edit;
            this.product_type = newVal.product_type;
            this.sku = newVal.sku;

            this.product_status = newVal.product_status == 'inactive' ? 0 : 1;
            this.is_featured = newVal.is_featured == true || newVal.is_featured == 'true' ? 1 : 0;
            this.is_points = newVal.is_points == true || newVal.is_points == 'true' ? 1 : 0;
            this.product_unit = newVal.product_unit;
            this.brand_id = newVal.brand_id;
            this.price = parseFloat(newVal.price);

            this.discount_price = newVal.discount_price;
            this.product_max_order = newVal.product_max_order;
            this.product_min_order = newVal.product_min_order;
            this.product_weight = newVal.product_weight;

            console.log(this.sku, "sku")
            if (newVal.product_type == 'variable') {

                this.edit_combination_detail = newVal.combination_detail;

                newVal.attributes.map((attribute_id, index) => {
                    this.attribute = attribute_id;
                    this.getVariation();

                    setTimeout(() => {
                        for (var i = 0; i < newVal.combination[attribute_id].variations.length; i++) {
                            this.variationData['variation_' + attribute_id].push(newVal.combination[attribute_id].variations[i].product_variation.id);
                        }
                        this.setVariations('variation_' + attribute_id);
                    }, 3000);

                    // this.setVariations('variation_'+attribute_id);
                });

            }

        }
    },
    mounted() {
        var token = localStorage.getItem('token');
        this.token = {
            headers: {
                Authorization: `Bearer ${token}`
            }
        };
        this.fetchUnits();
        this.fetchBrands();
        this.fetchAttributes();
        this.fetchColors();
    },
    props: ['product', 'errors', 'edit'],
};
</script>
