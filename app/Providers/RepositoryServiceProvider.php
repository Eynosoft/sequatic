<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\\Common\\Repositories\\Base\\MasterCountryRepositoryInterface', 'App\\Common\\Repositories\\MasterCountryRepository');
        $this->app->bind('App\\Common\\Repositories\\Base\\InquiryRepositoryInterface', 'App\\Common\\Repositories\\InquiryRepository');
        $this->app->bind('App\\Common\\Repositories\\Base\\uploadDirectoryRepositoryInterface', 'App\\Common\\Repositories\\uploadDirectoryRepository');

        $this->app->bind('App\\Common\\Repositories\\Base\\PanelsRepositoryInterface', 'App\\Common\\Repositories\\PanelsRepository');
        $this->app->bind('App\\Common\\Repositories\\Base\\PanelImageRepositoryInterface', 'App\\Common\\Repositories\\PanelImageRepository');
        $this->app->bind('App\\Common\\Repositories\\Base\\PanelFieldRepositoryInterface', 'App\\Common\\Repositories\\PanelFieldRepository');
        $this->app->bind('App\\Common\\Repositories\\Base\\MasterFieldRepositoryInterface', 'App\\Common\\Repositories\\MasterFieldRepository');

        $this->app->bind('App\\Common\\Repositories\\Base\\DirectoryFilesRepositoryInterface', 'App\\Common\\Repositories\\DirectoryFilesRepository');
        $this->app->bind('App\\Common\\Repositories\\Base\\TReferenceTableRepositoryInterface', 'App\\Common\\Repositories\\TReferenceTableRepository');
        $this->app->bind('App\\Common\\Repositories\\Base\\PanelSettingRepositoryInterface', 'App\\Common\\Repositories\\PanelSettingRepository');
        $this->app->bind('App\\Common\\Repositories\\Base\\InquiryDetailRepositoryInterface', 'App\\Common\\Repositories\\InquiryDetailRepository');

        $this->app->bind('App\\Common\\Repositories\\Base\\T2dReferenceTableRepositoryInterface', 'App\\Common\\Repositories\\T2dReferenceTableRepository');
        $this->app->bind('App\\Common\\Repositories\\Base\\SupportPanel4sideRepositoryInterface', 'App\\Common\\Repositories\\SupportPanel4sideRepository');
        $this->app->bind('App\\Common\\Repositories\\Base\\SupportPanelA4sideRepositoryInterface', 'App\\Common\\Repositories\\SupportPanelA4sideRepository');
        $this->app->bind('App\\Common\\Repositories\\Base\\SupportPanelB4sideRepositoryInterface', 'App\\Common\\Repositories\\SupportPanelB4sideRepository');

        $this->app->bind('App\\Common\\Repositories\\Base\\AllEmailsRepositoryInterface', 'App\\Common\\Repositories\\AllEmailsRepository');
        $this->app->bind('App\\Common\\Repositories\\Base\\EmailTemplateRepositoryInterface', 'App\\Common\\Repositories\\EmailTemplateRepository');
        $this->app->bind('App\\Common\\Repositories\\Base\\UserRepositoryInterface', 'App\\Common\\Repositories\\UserRepository');


    }
}
