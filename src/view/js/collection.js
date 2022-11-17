define([
    'lib/ko',
    'view/js/elem'
], function(ko, Element) {
    return Element.extend({
        elems: ko.observable([]),
        initialize: function () {
           alert('123123');
           this._super();
        }
    });
});
