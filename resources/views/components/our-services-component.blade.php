<h2>{{ __('site.our_services') }}</h2>
<div class="row row-30 justify-content-md-center">
    <div class="col-md-6 col-lg-4">
        <!-- Box Chloe-->
        <article class="box-chloe box-chloe_secondary">
            <div class="box-chloe__icon linearicons-window"></div>
            <div class="box-chloe__main">
                <h4 class="box-chloe__title text-21">{{ __('site.service_template_title') }}</h4>
                <p>{{ __('site.service_template_text') }}</p>
                <a class="button button-sm button-default button-ujarak"
                   href="{{ route('pages.page', 'template-implementation') }}">{{ __('site.view_details') }}</a>
            </div>
        </article>
    </div>
    <div class="col-md-6 col-lg-4">
        <!-- Box Chloe-->
        <article class="box-chloe box-chloe_secondary">
            <div class="box-chloe__icon linearicons-code"></div>
            <div class="box-chloe__main">
                <h4 class="box-chloe__title text-21">{{ __('site.service_refactoring_title') }}</h4>
                <p>{{ __('site.service_refactoring_text') }}</p>
                <a class="button button-sm button-default button-ujarak"
                   href="{{ route('pages.page', 'legacy-code-refactoring') }}">{{ __('site.view_details') }}</a>
            </div>
        </article>
    </div>
    <div class="col-md-6 col-lg-4">
        <!-- Box Chloe-->
        <article class="box-chloe box-chloe_secondary">
            <div class="box-chloe__icon linearicons-chart-settings"></div>
            <div class="box-chloe__main">
                <h4 class="box-chloe__title">{{ __('site.service_cms_title') }}</h4>
                <p>{{ __('site.service_cms_text') }}</p>
                <a class="button button-sm button-default button-ujarak"
                   href="{{ route('pages.page', 'crm-and-cms-systems') }}">{{ __('site.view_details') }}</a>
            </div>
        </article>
    </div>
    <div class="col-md-6 col-lg-4">
        <!-- Box Chloe-->
        <article class="box-chloe box-chloe_secondary">
            <div class="box-chloe__icon linearicons-desktop"></div>
            <div class="box-chloe__main">
                <h4 class="box-chloe__title">{{ __('site.service_web_apps_title') }}</h4>
                <p>{{ __('site.service_web_apps_text') }}</p>
                <a class="button button-sm button-default button-ujarak"
                   href="{{ route('pages.page', 'web-applications') }}">{{ __('site.view_details') }}</a>
            </div>
        </article>
    </div>
    <div class="col-md-6 col-lg-4">
        <!-- Box Chloe-->
        <article class="box-chloe box-chloe_secondary">
            <div class="box-chloe__icon linearicons-bug"></div>
            <div class="box-chloe__main">
                <h4 class="box-chloe__title">{{ __('site.service_qa_title') }}</h4>
                <p>{{ __('site.service_qa_text') }}</p>
                <a class="button button-sm button-default button-ujarak"
                   href="{{ route('pages.page', 'qa-testing') }}">{{ __('site.view_details') }}</a>
            </div>
        </article>
    </div>
    <div class="col-md-6 col-lg-4">
        <!-- Box Chloe-->
        <article class="box-chloe box-chloe_secondary">
            <div class="box-chloe__icon linearicons-laptop-phone"></div>
            <div class="box-chloe__main">
                <h4 class="box-chloe__title">{{ __('site.service_responsive_title') }}</h4>
                <p>{{ __('site.service_responsive_text') }}</p>
                <a class="button button-sm button-default button-ujarak"
                   href="{{ route('pages.page', 'responsive-web-apps') }}">{{ __('site.view_details') }}</a>
            </div>
        </article>
    </div>
</div>
<style>
    .text-21 {
        font-size: 21px;
        line-height: 1.4;
    }
</style>
