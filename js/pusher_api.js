(function ($, Drupal, drupalSettings) {
    Drupal.behaviors.myModuleBehavior = {
        attach: function (context, settings) {
            // Initialize Pusher and make it globally accessible
            window.myDrupalPusher = new Pusher(drupalSettings.pusherApi.appId, {
                cluster: drupalSettings.pusherApi.cluster
            });
        }
    };
})(jQuery, Drupal, drupalSettings);
