<?php declare(strict_types=1);

use PHPUnit\Logging\XML\LogWriter;

require __DIR__ . '/vendor/autoload.php';

$log = (new LogWriter('/tmp/test.xml'))->start( '2ee7e4d4-29e9-4af4-9e42-70e7a3d50764', new DateTimeImmutable('now'));

$env = $log->startEnvironment(PHP_OS, gethostname(), 'demouser');

$php = $env->startPHP(PHP_VERSION);
$php->addExtension('the-extension', '1.2.3');
$php->done();

$phpunit = $env->startPHPUnit('10.1.0', 'phar');
$ext = $phpunit->addExtension(LogWriter::class, 'composer');
$ext->addParameter('testName', 'paramValue');
$ext->done();
$phpunit->done();
$env->done();

$conf = $log->startConfiguration();
$conf->done();

$suite = $log->startTestSuite('fubar');

$class = $suite->addTestClass('./some.php', 1, 'some\class', 'whatever');
$method = $class->startTestMethod(15, 'testMethodName');

$method->writeDataProvider('dataProviderSource.php', 16, 'some\Provider', 'provideMe');
$method->writeDependency('./someDependency.php', 17, 'Some\DependencyClass', 'dependMethod');

$run = $method->startRun('run-id', 'some-pretty-name', 'dataset-name', 16, 'passed');
$run->writeRisky('risky message');

$run->writeDeprection('php', './someOddFile.php', 21, 'The message');
$run->writeNotice('user', './noticeFile.php', 22, 'Notice message');
$run->writeWarning('user', './warningFile.php', 22, 'Warning message');
$run->writeError('user', './errorFile.php', 22, 'Error message');
$run->writeReason('reason message');
$run->writeTelemetry('123', '456');
$run->done();

$method->done();
$class->done();


$summary = $suite->startSummary(5, 10);
$summary->writeIssuesSummary(1,2,3,4,5);
$summary->writeOutcomeSummary(1,2,3,4,5);
$summary->writeTelemetry('678', '654');
$summary->done();

$suite->done();

$summary = $log->startSummary(15, 23, 1024);
$summary->writeIssuesSummary(1,2,3,4,5);
$summary->writeOutcomeSummary(1,2,3,4,5);
$summary->writeTelemetry('123', '456');
$summary->done();


$log->done();

