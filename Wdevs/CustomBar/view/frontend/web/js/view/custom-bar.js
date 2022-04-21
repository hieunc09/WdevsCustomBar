define([
    'uiComponent',
    'ko',
    'Magento_Customer/js/customer-data'
], function (Component, ko, customerData) {
    'use strict';

    return Component.extend({
        customBarContent: ko.observable(null),
        initialize: function () {
            var self = this;
            self._super();
            customerData.reload(['custom_bar']);
            customerData.get('custom_bar').subscribe(function () {
                self.customBarContent(customerData.get('custom_bar')().content);
            });
        }
    });
});
