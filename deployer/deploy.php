<?php

namespace Deployer;

require 'recipe/magento2.php';

set('keep_releases', 2);
add('shared_files', ['pub/.htaccess', 'pub/robots.txt', 'app/etc/env.php', 'var/.maintenance.ip', 'cron.sh', '.env.local']);
set('artifact_file', 'artifact.tar.gz');
set('artifact_dir', '.');

desc('Remove jobs of bin/magento queue:consumers:start');
task('magento:remove-append-consumers', function () {
    run("ps -ef | grep 'bin/magento queue:consumers:start' | grep -v grep | awk '{print $2}' | xargs -r kill -9");
});

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:setup',
    'deploy:lock',
    'deploy:release',
    'artifact:upload',
    'artifact:extract',
    'deploy:shared',
    'deploy:clear_paths',
    'magento:upgrade:db',
    'magento:remove-append-consumers',
    'magento:cache:flush',
    'deploy:symlink',
    'deploy:unlock',
    'deploy:cleanup',
    'deploy:success',
]);

after('deploy:failed', 'deploy:unlock');
