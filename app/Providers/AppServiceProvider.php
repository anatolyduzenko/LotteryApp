<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerFilters();
    }

    public function registerFilters()
    {
        $smarty = $this->app['view']->getSmarty();
        $smarty->registerFilter('post', [$this, 'add_header_comment']);
    }

    /**
     * @param $tpl_source
     * @param $smarty
     * @return string
     */
    public function add_header_comment($tpl_source, $smarty)
    {
        return "<?php echo \"<!-- Created by Smarty From ServiceProvider! -->\n\"; ?>\n".$tpl_source;
    }
}
