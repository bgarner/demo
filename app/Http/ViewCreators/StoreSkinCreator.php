<?php

namespace App\Http\ViewCreators;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\StoreInfo;
use App\Skin;
use Session;


class StoreSkinCreator
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $storeNumber;
    protected $skin;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->storeNumber = RequestFacade::segment(1);
        $storeInfo = StoreInfo::getStoreInfoByStoreId($this->storeNumber);
        $this->skin = Skin::getSkin($storeInfo->banner_id);
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

        $view->with('skin', $this->skin)
             ->with('currentLang', $this->currentLang);
    }
}
