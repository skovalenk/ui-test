define([
    'lib/ko',
    'lib/class'
], function(ko, Class) {
    return Class.extend({
        initialize: function (config) {
            this.data = config;
            this._super();
        },
        getTemplate: function () {
            return this.data['template']
        }
    });
});
