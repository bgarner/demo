<?php

namespace App\Http\ViewCreators;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\StoreApi\StoreInfo;
use App\Skin;
use App\Models\StoreApi\Banner;
use Session;
use File;
use Config;
use Debugbar;

class StoreFooterCreator
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $storeNumber;
    protected $storeInfo;
    protected $bannerInfo;
    protected $languages;
    protected $currentLang;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->storeNumber = RequestFacade::segment(1);
        $this->storeInfo = StoreInfo::getStoreInfoByStoreId($this->storeNumber);
        $this->bannerInfo = Banner::find($this->storeInfo->banner_id);
        $this->languages = Config::get('languages');
        $this->currentLang = Session::get('language');
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('storeNumber', $this->storeNumber)
             ->with('storeInfo', $this->storeInfo)
             ->with('bannerInfo', $this->bannerInfo)
             ->with('languages', $this->languages)
             ->with('currentLang', $this->currentLang);
    }
}
