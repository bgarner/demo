<?php

namespace App\Http\ViewCreators;

use Illuminate\View\View;
use App\Models\Auth\Role\RoleComponent;

class AdminSidenavCreator
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $components;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        $this->components = RoleComponent::getAccessibleComponentNameList();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        
        $view->with('roleComponents', $this->components);
    }
}