define([
        'jquery',
        'uiComponent',
        'ko'
    ], function ($, Component, ko) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Primak_QuoteDate/addingtime'
            },
            initialize: function () {
                this._super();
            },
            getAddDate: function () {
                return window.checkoutConfig.addingtime;
            }
        });
    }
);
