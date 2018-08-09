<?php
use packager\{
    cli\Console, Event, JavaExec, Packager, Vendor
};
use php\io\Stream;

/**
 * Class AndroidPlugin
 * @jppm-task-prefix android
 *
 * @jppm-task build as build
 * @jppm-task init as init
 */
class AndroidPlugin
{
    public function init(Event $e)
    {
        $packageData = $e->package()->toArray();
        $androidData = $packageData['android'];

        if (!isset($packageData['deps']['jphp-android-ext']))
        {
            Console::log('-> Installing android extension ...');

            Tasks::run('add', [
                'jphp-android-ext'
            ]);
        }

        Console::log('-> init gradle');

        (new GradlePlugin($e))->install($e);

        $sources = $packageData['sources'];

        foreach ($sources as $key => $source)
            $sources[$key] = '"' . $source . '"';
    }

    public function generateBuild(string $file, array $androidData)
    {
	Console::log('-> generate build.gradle for android ...');        

	$buildScript = "buildscript {
    repositories {
        jcenter()
    }
    dependencies {
        classpath 'org.javafxports:jfxmobile-plugin:1.3.8'
    }
}

apply plugin: 'org.javafxports.jfxmobile'

repositories {
    mavenLocal()
    jcenter()
}

dependencies {
    compile files('build/{$file}')
}

jfxmobile {
    javafxportsVersion = '8.60.9'

    android {
        compileSdkVersion = {$androidData['sdk']}
        buildToolsVersion = '{$androidData['sdk-tools']}'
    }
}

mainClassName = \"org.venity.jphp.ext.android.UXAndroidApplication\"";

        \php\io\Stream::putContents('./build.gradle', $buildScript);
    }

    public function build(Event $event)
    {
        Console::log('-> starting build jar ...');

        Tasks::run('build');

        $androidData = $event->package()->toArray()['android'];
        $buildFileName = "{$event->package()->getName()}-{$event->package()->getVersion('last')}";

        Console::log('-> unpack jar');

        \php\lib\fs::makeDir('./build/out');

        $zip = new \compress\ZipArchive(\php\lib\fs::abs('./build/' . $buildFileName . '.jar'));
        $zip->readAll(function (\compress\ZipArchiveEntry $entry, ?Stream $stream) {
            Console::log(' -> unpack ' . $entry->name);
            if (!$entry->isDirectory())
            {
                \php\lib\fs::makeFile(\php\lib\fs::abs('./build/out/' . $entry->name));
                \php\lib\fs::copy($stream, \php\lib\fs::abs('./build/out/' . $entry->name));
            }
            else \php\lib\fs::makeDir(\php\lib\fs::abs('./build/out/' . $entry->name));
        });

        Console::log('-> starting compiler ...');

        $process = new \php\lang\Process([
            'java', '-jar', './phb2class.jar',
            '--src', './build/out',
            '--dest', './build/compile.jar'
        ], './');

        $exit = $process->inheritIO()->startAndWait()->getExitValue();

        if ($exit != 0) return;

        $this->generateBuild('compile.jar', $androidData);
        
        Console::log('-> starting build apk ...');

        /** @var \php\lang\Process $process */
        $process = (new GradlePlugin($event))->gradleProcess([
            'android'
        ])->inheritIO()->startAndWait();

        if ($process->getExitValue() == 0)
            Console::log('-> building done!');
    }
}
