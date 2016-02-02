/* resources/src/routers/app-router.js */

/**
 * Application Main Router
 */
var Router = Backbone.Router.extend({

    /**
     * Base url for backend service.
     */
    baseUrl: '/admin/dashboard/',
    /**
     * Parent Container
     */
    container: null,
    /**
     * Child views containers
     */
    accountsView: null,
    usersView: null,
    systemNotificationsView: null,
    plansView: null,
    /**
     * Plants
     */
    plantLibraryView: null, // Shows collection of plants
    plantShowView: null, // Shows single plant
    plantAddView: null, // Shows form for creating plant
    plantEditView: null, // Shows form for editing plant
    /**
     * Users
     */
    userEditView: null,
    /**
     * Culinary Plants
     */
    culinaryPlantLibraryView: null,
    culinaryPlantEditView: null,
    culinaryPlantCreateView: null,
    /**
     * Procedures
     */
    procedureLibraryView: null,
    procedureAddView: null,
    procedureEditView: null,
    /**
     * Alerts
     */
    alertLibraryView: null,
    alertAddView: null,
    alertEditView: null,
    /**
     * Pests
     */
    pestLibraryView: null,
    pestCreateView: null,
    pestEditView: null,
    /**
     *
     */
    websitePagesView: null,
    categoriesView: null,
    journalView: null,
    glossaryView: null,
    linksView: null,
    userSuggestionsView: null,
    whatsThisView: null,
    generalMessagesView: null,
    paymentConnectionView: null,
    apisConnectionView: null,
    adminProfileView: null,
    adminDashboardSettingsView: null,

    initialize: function() {
        this.bindGlobalEvents(); // All admin dashboard bindings should go here.
        this.container = new ContainerView({ el: CONTAINER_ELEMENT }); // Create view parent container.
    },

    /**
     * Definition of global event bindings.
     */
    bindGlobalEvents: function() {
        $('body').on('click', '.menu-toggle.sidebar-close', this.bindSidebarClose);
        $('body').on('click', '.menu-toggle.sidebar-open', this.bindSidebarOpen);
        $('body').on('click', '.sidebar-nav li', this.bindSidebarItems);
    },

    /**
     * Application routes.
     */
    routes: {
        "accounts": "showAccounts",
        "users": "showUsers",
        "users?page:num": "showUsers",
        "users/create": "createUser",
        "users/:id/edit": "editUser",
        "system-notifications": "showSystemNotifications",
        "plans": "showPlans",
        /**
         * Plants Routes
         */
        "plants": "showPlantLibrary",
        "plants/create": "createPlant",
        "plants/:id/edit": "editPlant",
        /**
         * Culinary Routes
         */
        "culinary-plants": "showCulinaryPlantLibrary",
        "culinary-plants/create": "createCulinaryPlant",
        "culinary-plants/:id/edit": "editCulinaryPlant",
        /**
         * Pest Routes
         */
        "pests": "showPestLibrary",
        "pests/create": "createPest",
        "pests/:id/edit": "editPest",
        /**
         * Procedures Routes
         */
        "procedures": "showProcedureLibrary",
        "procedures/create": "createProcedure",
        "procedures/:id/edit": "editProcedure",
        /**
         * Alerts Routes
         */
        "alerts": "showAlertLibrary",
        "alerts/create": "createAlert",
        "alerts/:id/edit": "editAlert",
        /**
         * Web Pages Routes
         */
        "pages": "showWebsitePages",
        /**
         * Categories Routes
         */
        "categories": "showCategories",
        "categories/create": "createCategory",
        /**
         * Journals Routes
         */
        "journals": "showJournal",
        /**
         * Glossary Routes
         */
        "glossary": "showGlossary",
        /**
         * Links Routes
         */
        "links": "showLinks",
        /**
         * User Suggestions Routes
         */
        "user-suggestions": "showUserSuggestions",
        /**
         * What's This Messages Routes
         */
        "whats-this": "showWhatsThis",
        /**
         * General Messages Rotues
         */
        "general-messages": "showGeneralMessages",
        /**
         * Payment Connections Routes
         */
        "payment-connection": "showPaymentConnector",
        /**
         * Apis Connections Routes
         */
        "apis-connection": "showApisConnection",
        /**
         * Admin Profile Routes
         */
        "profile": "showAdminProfile",
        /**
         * Dashboard Settings Routes
         */
        "settings": "showAdminDashboardSettings",
        /**
         * Dashboard Logout
         */
        "logout": "adminLogout"

    },

    /****************************
     * Admin User Accounts
     ****************************/
    showAccounts: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.accountsView = new AdminAccountsView({ route: this.baseUrl + url });

        this.container.ChildView = this.accountsView;
        this.container.render();
    },

    /****************************
     * Show Application Users
     ****************************/
    showUsers: function () {
        var url = Backbone.history.location.hash.substr(1);
        var model = new User();

        this.usersView = new UsersView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.usersView;
        this.container.render();
    },


    /****************************
     * System Notifications
     ****************************/
    showSystemNotifications: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.systemNotificationsView = new SystemNotificationsView({ route: this.baseUrl + url });

        this.container.ChildView = this.systemNotificationsView;
        this.container.render();
    },

    /****************************
     * User subscription plans
     ****************************/
    showPlans: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.plansView = new PlansView({ route: this.baseUrl + url });

        this.container.ChildView = this.plansView;
        this.container.render();
    },

    /****************************
     * Edit User
     ****************************/
    editUser: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new User();
 
        var user = new User();
        var profile = new Profile();
        var settings = new Settings();
        var payment = new Payment();
        
        this.userEditView = new EditUserView({ user: user, profile: profile, settings: settings, payment: payment, route: this.baseUrl + url });


        this.container.ChildView = this.userEditView;
        this.container.render();
    },

    /****************************
     * Create User
     ****************************/
    createUser: function() {
        var url = Backbone.history.location.hash.substr(1);
        var user = new User();
        var profile = new Profile();
        var settings = new Settings();

        this.userCreateView = new CreateUserView({ 
                                                    user: user,
                                                    profile: profile,
                                                    settings: settings,
                                                    route: this.baseUrl + url 
                                                  });

        this.container.ChildView = this.userCreateView;
        this.container.render();
    },

    /****************************
     * Plant Library Views
     ****************************/
    showPlantLibrary: function () {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Plant();
        this.plantLibraryView = new PlantLibraryView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.plantLibraryView;
        this.container.render();
    },

    createPlant: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Plant();

        this.plantCreateView = new CreatePlantView({ model:  model, route: this.baseUrl + url });

        this.container.ChildView = this.plantCreateView;
        this.container.render();
    },

    editPlant: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Plant();

        this.plantEditView = new EditPlantView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.plantEditView;
        this.container.render();
    },

    /*******************************
     * Culinary Plant Library Views
     *******************************/
    showCulinaryPlantLibrary: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.culinaryPlantLibraryView = new CulinaryPlantLibraryView({ route: this.baseUrl + url });

        this.container.ChildView = this.culinaryPlantLibraryView;
        this.container.render();
    },

    createCulinaryPlant: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new CulinaryPlant();

        this.plantCreateView = new CreateCulinaryPlantView({ model:  model, route: this.baseUrl + url });

        this.container.ChildView = this.culinaryPlantCreateView;
        this.container.render();
    },

    editCulinaryPlant: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new CulinaryPlant();

        this.plantEditView = new EditCulinaryPlantView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.culinaryPlantEditView;
        this.container.render();
    },

    /****************************
     * Pest Library Views
     ****************************/
    showPestLibrary: function () {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Pest();
        this.pestLibraryView = new PestLibraryView({model: model, route: this.baseUrl + url });

        this.container.ChildView = this.pestLibraryView;
        this.container.render();
    },

    createPest: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Pest();

        this.pestCreateView = new CreatePestView({ model:  model, route: this.baseUrl + url });

        this.container.ChildView = this.pestCreateView;
        this.container.render();
    },

    editPest: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Pest();

        this.pestEditView = new EditPestView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.pestEditView;
        this.container.render();
    },

    /****************************
     * Procedure Library Views
     ****************************/
    showProcedureLibrary: function () {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Procedure();

        this.procedureLibraryView = new ProcedureLibraryView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.procedureLibraryView;
        this.container.render();
    },

    createProcedure: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Procedure();

        this.procedureCreateView = new CreateProcedureView({ model:  model, route: this.baseUrl + url });

        this.container.ChildView = this.procedureCreateView;
        this.container.render();
    },

    editProcedure: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Procedure();

        this.procedureEditView = new EditProcedureView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.procedureEditView;
        this.container.render();
    },


    /****************************
     * Alert Library Views
     ****************************/
    showAlertLibrary: function () {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Alert();

        this.alertLibraryView = new AlertLibraryView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.alertLibraryView;
        this.container.render();
    },

    createAlert: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Alert();

        this.alertCreateView = new CreateAlertView({ model:  model, route: this.baseUrl + url });

        this.container.ChildView = this.alertCreateView;
        this.container.render();
    },

    editAlert: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Alert();

        this.alertEditView = new EditAlertView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.alertEditView;
        this.container.render();
    },

    /****************************
     * Website Pages Views
     ****************************/
    showWebsitePages: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.websitePagesView = new WebsitePagesView({ route: this.baseUrl + url });

        this.container.ChildView = this.websitePagesView;
        this.container.render();
    },

    /****************************
     * Categories Views
     ****************************/
    showCategories: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.categoriesView = new CategoriesView({ route: this.baseUrl + url });

        this.container.ChildView = this.categoriesView;
        this.container.render();
    },

    createCategory: function () {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Category();

        this.categoryCreateView = new CreateCategoryView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.categoryCreateView;
        this.container.render();
    },

    editCategory: function() {
        var url = Backbone.history.location.hash.substr(1);
        var model = new Category();

        this.categoryCreateView = new EditCategoryView({ model: model, route: this.baseUrl + url });

        this.container.ChildView = this.categoryEditView;
        this.container.render();
    },

    /****************************
     * Journal Views
     ****************************/
    showJournal: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.journalView = new JournalView({ route: this.baseUrl + url });

        this.container.ChildView = this.journalView;
        this.container.render();
    },

    /****************************
     * Glossary Views
     ****************************/
    showGlossary: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.glossaryView = new GlossaryView({ route: this.baseUrl + url });

        this.container.ChildView = this.glossaryView;
        this.container.render();
    },

    /****************************
     * Categories Views
     ****************************/
    showLinks: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.linksView = new LinksView({ route: this.baseUrl + url });

        this.container.ChildView = this.linksView;
        this.container.render();
    },

    /****************************
     * User Suggestions Views
     ****************************/
    showUserSuggestions: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.userSuggestionsView = new UserSuggestionsView({ route: this.baseUrl + url });

        this.container.ChildView = this.userSuggestionsView;
        this.container.render();
    },

    /****************************
     * What's This Views
     ****************************/
    showWhatsThis: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.whatsThisView = new WhatsThisView({ route: this.baseUrl + url });

        this.container.ChildView = this.whatsThisView;
        this.container.render();
    },

    /****************************
     * General Messages Out Views
     ****************************/
    showGeneralMessages: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.generalMessagesView = new GeneralMessagesView({ route: this.baseUrl + url });

        this.container.ChildView = this.generalMessagesView;
        this.container.render();
    },

    /******************************
     * Payment Connection Api Views
     *****************************/
    showPaymentConnector: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.paymentConnectionView = new PaymentConnectorView({ route: this.baseUrl + url });

        this.container.ChildView = this.paymentConnectionView;
        this.container.render();
    },

    /******************************
     * Outbound Api's Connection  Views
     *****************************/
    showApisConnection: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.apisConnectionView = new ApisConnectionView({ route: this.baseUrl + url });

        this.container.ChildView = this.apisConnectionView;
        this.container.render();
    },

    /****************************
     * Admin Profile Views
     ****************************/
    showAdminProfile: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.adminProfileView = new AdminProfileView({ route: this.baseUrl + url });

        this.container.ChildView = this.adminProfileView;
        this.container.render();
    },

    /*********************************
     * Admin Dashboard Settings Views
     ********************************/
    showAdminDashboardSettings: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.adminDashboardSettingsView = new AdminDashboardSettingsView({ route: this.baseUrl + url });

        this.container.ChildView = this.adminDashboardSettingsView;
        this.container.render();
    },

    adminLogout: function () {

        ServerCall.request('GET', '/admin/dashboard/logout', '').success( function() {

            $(location).attr('href','/admin/login');
            //$(location).prop('pathname', '/admin/dashboard/login');

        })

    },

    /*****************************
     * Definition of global events
     ******************************/

    // Hide left arrow/ Show right arrow
    bindSidebarClose: function(e) {
        e.preventDefault();
        $("#menu-sidebar").hide();
        $(this).hide();
        $(".sidebar-open").show();
    },

    // Hide right arrow/ Show left arrow
    bindSidebarOpen: function (e) {
        e.preventDefault();
        $("#menu-sidebar").show();
        $(this).hide();
        $(".sidebar-close").show();
    },

    // Add active class to selected menu item.
    bindSidebarItems: function(e) {
        $(".sidebar-nav li").removeClass('sidebar-menu-item-active')
        $(this).addClass('sidebar-menu-item-active');
    }

});
