<?php

namespace Deployer;

set('media_pull_exclude_dirs', ['catalog/product/', 'import/']);

desc('Pull Magento media to local');
task('magento:media-pull', function () {
    $remotePath = '{{current_path}}/pub/media/';
    $localPath = rtrim(get('local_magento_path'), '/') . '/pub/media/';

    $excludedList = "/tmp/" . uniqid('list_', true);
    foreach (get('media_pull_exclude_dirs') as $dir) {
        runLocally("echo '$dir' >> $excludedList");
    }

    $config = [
        'options' => ["--exclude-from=$excludedList"],
        'timeout' => get('default_timeout')
    ];

    download($remotePath, $localPath, $config);
    runLocally("rm $excludedList");
});
