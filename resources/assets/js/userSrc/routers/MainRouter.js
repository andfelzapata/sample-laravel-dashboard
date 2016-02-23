var MainRouter = Backbone.Router.extend({

    routes: {
        "": "showHome",
        "about": "showAbout",
        "help": "showHelp",
        "terms-of-use": "showTerms",
        "community-rules": "showRules",
        "privacy-policy": "showPolicy",
        "glossary": "showGlossary",
        "contact": "showContact",
        "login": "showLogin",
        "register": "showRegister",
        "plans": "showPlans",
        "browse/plants": "showPlants",
        "browse/pests": "showPests",
        "browse/procedures": "showProcedures"


    },

    showHome: function() {
        GardenRev.MainController.showHome();
    },

    showAbout: function() {
        GardenRev.MainController.showAbout();
    },

    showHelp: function() {
        GardenRev.MainController.showHelp();
    },

    showTerms: function () {
        GardenRev.MainController.showTerms();
    },

    showRules: function() {
        GardenRev.MainController.showRules();
    },

    showPolicy: function() {
        GardenRev.MainController.showPolicy();
    }

});