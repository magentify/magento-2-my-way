<?php

namespace Deployer;

set('magerun_remote', './vendor/bin/n98-magerun2');
set('magerun_local', './vendor/bin/n98-magerun2');
set('db_pull_strip_tables', ['@stripped']);

desc('Pull Magento database to local');
task('magento:db-pull', function () {
    $fileName = uniqid('dbdump_', true);
    $stripTables = implode(' ', get('db_pull_strip_tables'));
    $remoteDump = "/tmp/$fileName.sql.gz";

    writeln('➤ Dumping... ');
    run("cd {{current_path}} && {{magerun_remote}} db:dump -n --strip=\"$stripTables\"  -c gz $remoteDump");

    writeln('➤ Downloading... ');
    $localDump =  tempnam(sys_get_temp_dir(), 'deployer_') . '.sql.gz';
    download($remoteDump, $localDump);
    run("rm $remoteDump");

    writeln('➤ Importing... ');
    runLocally("cd {{local_magento_path}} && {{magerun_local}} db:import -n --drop-tables -c gz $localDump");
    runLocally("rm $localDump");

    writeln('➤ Running setup:upgrade...');
    runLocally('cd {{local_magento_path}} && {{magerun_local}} setup:upgrade');

    writeln('Done!');
});
