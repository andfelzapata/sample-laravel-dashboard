/**
 * Get partial views from server.
 */
var DashboardPartial = (function(){

    var _getPartialView = function () {

        return $.ajax({
            url: _url,
            async: true,
        });

    };

    return  {
        get: function (url) {
            _url = url;
            return _getPartialView();
        }

    };

}());


/**
 * Display errors.
 */
var serverError = (function (response) {

    var defaultMessage = 'There seems to be a problem with the server,' +
        'please try again or contact support if problem persists.';

    var message = response.responseJSON.error || defaultMessage;

    return swal({title: "Whoops!",
            text: message,
            type: "error",
            confirmButtonColor: "#DA4453",
            confirmButtonText: "Ok"},
        function(){
            window.location.href = '/dashboard';
        });

});
/**
 * Parent View
 *
 * All other views render inside this container.
 */
var ContainerView = Backbone.View.extend({

    // Container for dashboard partials.
    ChildView: null,

    render: function() {
        if(this.ChildView) {
            this.$el.html(this.ChildView.$el);
            this.ChildView.delegateEvents();
            return this;
        }
    }
});

/**
 * Return admin accounts view.
 */
var AdminAccountsView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route; // eg. /admin/dashboard/accounts.
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return application's users view.
 */
var UsersView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return system notifications view.
 */
var SystemNotificationsView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return users subscription plans view.
 */
var PlansView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return plant library view.
 */
var PlantLibraryView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return culinary plants library.
 */
var CulinaryPlantLibraryView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return pest library view.
 */
var PestLibraryView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return procedure library view.
 */
var ProcedureLibraryView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return website pages view.
 */
var WebsitePagesView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return categories view.
 */
var CategoriesView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return journal entries view.
 */
var JournalView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return glossary words view.
 */
var GlossaryView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return links
 */
var LinksView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return user's suggestions messages view.
 */
var UserSuggestionsView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return what's this messages view.
 */
var WhatsThisView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return general messages out.
 */
var GeneralMessagesView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return payment api settings view.
 */
var PaymentConnectorView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return outbound api's connections settings view.
 */
var ApisConnectionView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return admin dashboard profile view.
 */
var AdminProfileView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});

/**
 * Return admin dashboard settings view.
 */
var AdminDashboardSettingsView = Backbone.View.extend({

    initialize: function(ob) {
        var url = ob.route;
        this.render(url);
    },

    render: function(url) {
        var self = this;

        DashboardPartial.get(url).done(function(partial){
            self.$el.html(partial);

        }).error(function(partial) {
            serverError();
        });

        return self;
    }
});
/* resources/src/routers/app-router.js */

/**
 * Application Main Router
 */
var Router = Backbone.Router.extend({

    // Base url for backend service.
    baseUrl: '/admin/dashboard/',

    // Parent container
    container: null,

    // Child views containers
    accountsView: null,
    usersView: null,
    systemNotificationsView: null,
    plansView: null,
    plantLibraryView: null,
    culinaryPlantLibraryView: null,
    procedureLibraryView: null,
    pestLibraryView: null,
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

    // Definition of global event bindings.
    bindGlobalEvents: function() {
        $('body').on('click', '.menu-toggle.sidebar-close', this.bindSidebarClose);
        $('body').on('click', '.menu-toggle.sidebar-open', this.bindSidebarOpen);
        $('body').on('click', '.sidebar-nav li', this.bindSidebarItems);
    },

    // Application routes.
    routes: {
        "accounts": "showAccounts",
        "users": "showUsers",
        "system-notifications": "showSystemNotifications",
        "plans": "showPlans",
        "plant-library": "showPlantLibrary",
        "culinary-plant-library": "showCulinaryPlantLibrary",
        "pest-library": "showPestLibrary",
        "procedure-library": "showProcedureLibrary",
        "website-pages": "showWebsitePages",
        "categories": "showCategories",
        "journal": "showJournal",
        "glossary": "showGlossary",
        "links": "showLinks",
        "user-suggestions": "showUserSuggestions",
        "whats-this": "showWhatsThis",
        "general-messages": "showGeneralMessages",
        "payment-connection": "showPaymentConnector",
        "apis-connection": "showApisConnection",
        "profile": "showProfile",
        "settings": "showSettings"

    },

    /**
     * Admin user accounts
     */
    showAccounts: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.accountsView = new AdminAccountsView({ route: this.baseUrl + url });

        this.container.ChildView = this.accountsView;
        this.container.render();
    },

    /**
     * Application users list.
     */
    showUsers: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.usersView = new UsersView({ route: this.baseUrl + url });

        this.container.ChildView = this.usersView;
        this.container.render();
    },


    /**
     * System notifications
     */
    showSystemNotifications: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.systemNotificationsView = new SystemNotificationsView({ route: this.baseUrl + url });

        this.container.ChildView = this.systemNotificationsView;
        this.container.render();
    },

    /**
     * User subscription plans
     */
    showPlans: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.plansView = new PlansView({ route: this.baseUrl + url });

        this.container.ChildView = this.plansView;
        this.container.render();
    },

    /**
     * Plant library.
     */
    showPlantLibrary: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.plantLibraryView = new PlantLibraryView({ route: this.baseUrl + url });

        this.container.ChildView = this.plantLibraryView;
        this.container.render();
    },

    /**
     * Culinary plant library
     */
    showCulinaryPlantLibrary: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.culinaryPlantLibraryView = new CulinaryPlantLibraryView({ route: this.baseUrl + url });

        this.container.ChildView = this.culinaryPlantLibraryView;
        this.container.render();
    },

    /**
     * Pest library
     */
    showPestLibrary: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.pestLibraryView = new PestLibraryView({ route: this.baseUrl + url });

        this.container.ChildView = this.pestLibraryView;
        this.container.render();
    },

    /**
     * Procedure library
     */
    showProcedureLibrary: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.procedureLibraryView = new ProcedureLibraryView({ route: this.baseUrl + url });

        this.container.ChildView = this.procedureLibraryView;
        this.container.render();
    },

    /**
     * Webiste pages
     */
    showWebsitePages: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.websitePagesView = new WebsitePagesView({ route: this.baseUrl + url });

        this.container.ChildView = this.websitePagesView;
        this.container.render();
    },

    /**
     * Categories
     */
    showCategories: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.categoriesView = new CategoriesView({ route: this.baseUrl + url });

        this.container.ChildView = this.categoriesView;
        this.container.render();
    },

    /**
     * Journal
     */
    showJournal: function () {
        var url = Backbone.history.location.hash.substr(1);
        this.journalView = new JournalView({ route: this.baseUrl + url });

        this.container.ChildView = this.journalView;
        this.container.render();
    },

    /**
     * Glossary
     */
    showGlossary: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.glossaryView = new GlossaryView({ route: this.baseUrl + url });

        this.container.ChildView = this.glossaryView;
        this.container.render();
    },

    /**
     * Links
     */
    showLinks: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.linksView = new LinksView({ route: this.baseUrl + url });

        this.container.ChildView = this.linksView;
        this.container.render();
    },

    /**
     * User Suggestions
     */
    showUserSuggestions: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.userSuggestionsView = new UserSuggestionsView({ route: this.baseUrl + url });

        this.container.ChildView = this.userSuggestionsView;
        this.container.render();
    },

    /**
     * What's this
     */
    showWhatsThis: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.whatsThisView = new WhatsThisView({ route: this.baseUrl + url });

        this.container.ChildView = this.whatsThisView;
        this.container.render();
    },

    /**
     * General messages out.
     */
    showGeneralMessages: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.generalMessagesView = new GeneralMessagesView({ route: this.baseUrl + url });

        this.container.ChildView = this.generalMessagesView;
        this.container.render();
    },

    /**
     * Payment connection api
     */
    showPaymentConnector: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.paymentConnectionView = new PaymentConnectorView({ route: this.baseUrl + url });

        this.container.ChildView = this.paymentConnectionView;
        this.container.render();
    },

    /**
     * Outbound api's connection
     */
    showApisConnection: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.apisConnectionView = new ApisConnectionView({ route: this.baseUrl + url });

        this.container.ChildView = this.apisConnectionView;
        this.container.render();
    },

    /**
     * Admin profile
     */
    showAdminProfile: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.adminProfileView = new AdminProfileView({ route: this.baseUrl + url });

        this.container.ChildView = this.adminProfileView;
        this.container.render();
    },

    /**
     * Admin dashboard settings
     */
    showAdminDashboardSettings: function () {
        var url = Backbone.history.location.hash.substr(1); // url part after hash e.g #accounts
        this.adminDashboardSettingsView = new AdminDashboardSettingsView({ route: this.baseUrl + url });

        this.container.ChildView = this.adminDashboardSettingsView;
        this.container.render();
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


(function(exports, $){

    //document ready
    $(function(){

        /**
         *
         * Globals

         */

        WINDOW = $(window);
        DOCUMENT = $(document);
        BODY   = $('body');
        CONTAINER_ELEMENT = $("#body-container");

        /**
         * Initializes de app's Routes Controller.
         *
         */
        AppRouter = new Router();

        /**
         * Start Backbone url history.
         *
         */
        Backbone.history.start();

    });

}(this, jQuery));
//# sourceMappingURL=admin.js.map
