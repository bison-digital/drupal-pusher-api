(function ($, Drupal, drupalSettings) {
    Drupal.behaviors.pusherApiBehavior = {
        attach: function (context, settings) {
            once('pusherInit', 'html').forEach(function (element) {
                window.pusherApiPusher = new Pusher(drupalSettings.pusherApi.key, {
                    cluster: drupalSettings.pusherApi.cluster
                });
            })
        }
    };
})(jQuery, Drupal, drupalSettings, once);
