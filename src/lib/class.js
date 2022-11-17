define(['underscore'], function (_) {
    let Class = function () {
        //this
        this.initialize.apply(this, arguments);
    }

    Class.prototype = {
        initialize: () => {
            console.error('Parent construct call')
        }
    };
    Class.prototype.constructor = Class;

    _.extend(Class, {
        extend: function (childClass) {
            let parent = this,
                parentProto = parent.prototype,
                child = function () {
                    if (typeof this.initialize !== 'undefined') {
                        this.initialize.apply(this, arguments)
                    } else {
                        parentProto.initialize.apply(this, arguments)
                    }
                }

            _.each(childClass, (method, name) => {
                if (parentProto.hasOwnProperty(name)) {
                    //child['initialize']
                    childClass[name] = function () {
                        this._super = function () {
                            parentProto[name].apply(this, arguments);
                        }

                        method.apply(this, arguments);
                    }
                }
            })
            child.extend = parent.extend;
            child.prototype = childClass;
            child.constructor = child;
            return child;
        }
    });

    return Class;
})
