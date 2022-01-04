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
            <div id="accordion">
                <div class="card">
                    <?php foreach($projects as $project) {?>
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <?php echo $project['project'] -> title; ?>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        <?php renderProjects($project['children']);?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        <?php
    }
}
