<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GardenRevolution\Services\UserService;

use App\GardenRevolution\Responders\Admin\Contracts\UsersResponderInterface;

class DashboardController extends Controller
{
    private $userService;

    public function __construct(UserService $userService) 
    {
        $this->userService = $userService;
        $this->middleware('auth');
    }

    /**
     * Show default dashboard view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
    	return view('admin.dashboard.default');
    }

    public function accounts()
    {
        return view('admin.dashboard.admin-accounts.accounts');
    }

    public function users(UsersResponderInterface $responder)
    {
        $payload = $this->userService->getUsers();
        $responder->setPayload($payload);
        return $responder->respond();
    }

    public function systemNotifications()
    {
        return view('admin.dashboard.system-notifications.system-notifications');
    }

    public function plans()
    {
        return view('admin.dashboard.plans.plans');
    }

    public function plantLibrary()
    {
        return view('admin.dashboard.plant-library.plant-library');
    }

    public function culinaryPlantLibrary()
    {
        return view('admin.dashboard.culinary-plant-library.culinary-plant-library');
    }

    public function pestLibrary()
    {
        return view('admin.dashboard.pest-library.pest-library');
    }

    public function procedureLibrary()
    {
        return view('admin.dashboard.procedure-library.procedure-library');
    }

    public function websitePages()
    {
        return view('admin.dashboard.website-pages.website-pages');
    }

    public function categories()
    {
        return view('admin.dashboard.categories.categories');
    }

    public function journal()
    {
        return view('admin.dashboard.journal.journal');
    }

    public function glossary()
    {
        return view('admin.dashboard.glossary.glossary');
    }

    public function links()
    {
        return view('admin.dashboard.links.links');
    }

    public function userSuggestions()
    {
        return view('admin.dashboard.user-suggestions.user-suggestions');
    }

    public function whatsThis()
    {
        return view('admin.dashboard.whats-this.whats-this');
    }

    public function generalMessages()
    {
        return view('admin.dashboard.general-messages.general-messages');
    }

    public function paymentConnection()
    {
        return view('admin.dashboard.payment-connection.payment-connection');
    }

    public function apisConnection()
    {
        return view('admin.dashboard.apis-connection.apis');
    }

    public function profile()
    {
        return view('admin.dashboard.profile.profile');
    }

    public function settings()
    {
        return view('admin.dashboard.settings.settings');
    }

}
