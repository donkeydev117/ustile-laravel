<?php
use App\Models\Admin\Setting;
use App\Models\Admin\CurrentTheme;
use App\Models\Admin\Currency;
use App\Models\DemoSettings;
use App\Models\Admin\ProjectTag;

if(!function_exists("getSetting")){

    function getSetting(){
        $settings = Setting::whereNotIn('type',['app_general','app_display_in_setting','app_notification_setting','app_login_signup'])->get();
        $normalizdSetting = [];
        foreach($settings as $setting){
            $normalizdSetting[$setting->key] = $setting->value; 
        }

        $demoSettings = DemoSettings::where('ip',\Request::ip())->first();
        if($demoSettings){
            $normalizdSetting['header_style'] = $demoSettings->header_style;
            $normalizdSetting['Footer_style'] = $demoSettings->footer_style;
            $normalizdSetting['slider_style'] = $demoSettings->slider_style;
            $normalizdSetting['banner_style'] = $demoSettings->banner_style;
            $normalizdSetting['card_style'] = $demoSettings->cart_style;
            $normalizdSetting['product_detail'] = $demoSettings->product_page_style;
            $normalizdSetting['shop'] = $demoSettings->shop_style;
            $normalizdSetting['color'] = $demoSettings->color;

        }
        // dd($normalizdSetting);
        return $normalizdSetting;
   }
}   


if(!function_exists("homePageBuilderJson")){

    function homePageBuilderJson(){
        $currentThemeSetting = [];
        if(CurrentTheme::first()){
            $currentThemeSetting = CurrentTheme::first()->home_setting;
            $currentThemeSetting =  json_decode($currentThemeSetting,true);
        }
       
        return $currentThemeSetting;
    }
}


if(!function_exists("currencyConvertor")){

    function currencyConvertor($value){
        $currency = Currency::where('id',1)->first();
        if($currency){
            $calculatedValue = $value*$currency->exchange_rate;

            if($currency == 'left'){
                $currency->code.' '.$calculatedValue;
            }else{
                $calculatedValue.' '.$currency->code;
            }
        }
    }
}

if(!function_exists('getProjectTags')){
    function getProjectTags(){
        $tags = ProjectTag::where("is_active", 1)->get();
        return $tags;
    }
}

if(!function_exists('renderProjects')){
    function renderProjects($projects){
        ?>
            
        <?php foreach($projects as $project) {?>
        <div id="accordion-<?php echo $project['project']->id?>">
            <div class="card">
                <div class="card-header" id="headingOne-<?=$project['project']->id ?>">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#project-<?php echo $project['project']->id ?>" aria-expanded="true" aria-controls="collapseOne">
                            <?php echo $project['project'] -> title; ?>
                        </button>
                    </h5>
                </div>
                <div id="project-<?php echo $project['project']->id ?>" class="collapse show" aria-labelledby="headingOne-<?=$project['project']->id ?>" data-parent="#accordion-<?php echo $project['project']->id?>">
                    <div class="card-body">
                        <div class="row">
                        <?php foreach($project['products'] as $product) { ?>
                            <div class="col-sm-3 col-md-3">
                                <div class="div-class">
                                    <div class="product product13 ratingstar">
                                        <article>
                                            <div class="thumb">
                                                <div class="product-hover d-none d-lg-block d-xl-block">
                                                    <div class="icons">
                                                        <a href="javascript:void(0)" class="wishlist-icon icon active swipe-to-top" data-toggle="tooltip"
                                                            data-placement="bottom" title="" data-original-title="Wishlist" data-id="<?php echo $product->product->id;?>" >
                                                            <i class="fas fa-heart"></i>
                                                        </a>
                                                        <div class="icon swipe-to-top quick-view-icon" data-tooltip="tooltip" data-placement="bottom" title="" data-original-title="Quick View" data-id="<?php echo $product->product->id;?>">
                                                            <i class="fas fa-eye"></i>
                                                        </div>
                                                        <div class="icon swipe-to-top project-icon" data-tooltip="tooltip" data-placement="bottom" title="Add to Project" data-original-title="Add to Project" data-toggle="modal" data-target="#addToProjectModal" data-id="<?php echo $product->product->id;?>">
                                                            <i class="fas fa-folder" data-fa-transform="rotate-90"></i>
                                                        </div>
                                                        <div 
                                                            class="icon swipe-to-top remove-icon" 
                                                            data-tooltip="tooltip" 
                                                            data-placement="bottom" 
                                                            title="Remove from project" 
                                                            data-original-title="Remove from project" 
                                                            data-id="<?php echo $product->product->id;?>"
                                                            data-projectId="<?php echo $project['project']->id;?>" 
                                                        >
                                                            <i class="fas fa-trash" data-fa-transform="rotate-90"></i>
                                                        </div>
                                                    </div>
                                                    <a class="btn btn-block btn-secondary swipe-to-top product-card-link" href="javascript:void(0)"
                                                        data-toggle="tooltip" data-placement="bottom" title=""
                                                        data-original-title="View Detail">View Detail</a>
                                                </div>
                                                <img class="img-fluid product-card-image" src="<?php echo $product->product->gallary->detail[0]->path; ?>" alt="<?php echo $product->product->detail[0]->title; ?>">
                                            </div>
                                            <div class="content">
                                                <h5 class="title"><a href="javascript:void(0)" class="product-card-name"><?php echo $product->product->detail[0]->title; ?></a></h5>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                                <div class="mb-3">
                                <?php foreach($product->tags as $tag){ ?>
                                    <span class="badge badge-secondary"><?php echo $tag->tag; ?></span>
                                <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    <?php renderProjects($project['children']);?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
                
        <?php
    }
}
