(function ($, Drupal, drupalSettings) {
    Drupal.behaviors.pusherApiBehavior = {
        attach: function (context, settings) {
            once('pusherInit', 'html').forEach(function (element) {
                window.pusherApiPusher = new Pusher(drupalSettings.pusherApi.key, {
                    cluster: drupalSettings.pusherApi.cluster,
                    userAuthentication: {
                        endpoint: "/admin/pusher-api/authentication",
                        transport: "ajax",
                        params: {},
                        headers: {},
                        paramsProvider: null,
                        headersProvider: null,
                        customHandler: null,
                    },
                });
            })
        }
    };
})(jQuery, Drupal, drupalSettings, once);
