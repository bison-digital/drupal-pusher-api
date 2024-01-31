(function ($, Drupal, drupalSettings) {
    Drupal.behaviors.pusherApiBehavior = {
        attach: function (context, settings) {
            once('pusherInit', 'html').forEach(function (element) {
                window.pusherApiPusher = new Pusher(drupalSettings.pusherApi.key, {
                  cluster: drupalSettings.pusherApi.cluster,
                  authEndpoint: "/admin/pusher-api/authentication",
                });
            })
        }
    };
})(jQuery, Drupal, drupalSettings, once);
