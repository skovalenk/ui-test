define(['underscore', 'lib/class'], function (_, Class) {
    return Class.extend({
        deps: [],
        initialize: function () {
            const uiComponentContent = document.getElementById('ui-component-base').innerText;
            const nodes = JSON.parse(uiComponentContent);

        },

        loadDeps: function (nodes) {
            _.each(nodes, function (childNodes, name) {
                const componentClass = childNodes.arguments.data.component;

                if (childNodes.hasOwnProperty('children')) {
                    this.loadDeps(childNodes.children)
                } else {
                    require([componentClass], function (Component) {
                        this.deps[name] = new Component(childNodes)
                    })
                }
            })
        }
    });
})
