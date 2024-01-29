# Pusher API

Pusher API is a developer module that provides an integration point between Drupal and [Pusher](https://pusher.com/).

This module provides a framework for supplementary modules to build upon and extend.

## Sub modules

- Pusher xyz
- ...



For a full description of the module, visit the
[project page](https://www.drupal.org/project/pusher_api).

Submit bug reports and feature suggestions, or track changes in the
[issue queue](https://www.drupal.org/project/issues/pusher_api).


## Table of contents

- Requirements
- Installation
- Configuration


## Requirements

This module requires no modules outside of Drupal core.


## Installation

```bash
composer require drupal/pusher_api:^3.0.0
```

## Configuration

1. Go to www.pusher.com and create a new app.
2. Locate your app keys and add them to the settings.php under the `default` key. This is a minimum requirement for this 
module and dependent modules to function. Any additional `apps` 
   ```
    // Pusher API settings.
    $settings['pusher_api'] = [
      'default' => [
        'app_id' => '__APP_ID__',
        'key' => '__KEY__',
        'secret' => '__SECRET__',
        'options' => [
          'cluster' => '__CLUSTER__',
          'useTLS' => TRUE,
        ],
      ]
    ];
    ```
3. Navigate to Administration > Extend and enable the module.