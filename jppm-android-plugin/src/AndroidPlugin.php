<?php
use packager\{
    cli\Console, Event, JavaExec, Packager, Vendor
};
use php\io\Stream;

/**
 * Class AndroidPlugin
 * @jppm-task-prefix android
 *
 * @jppm-task build_apk as apk
 * @jppm-task build_adb as apk-adb
 * @jppm-task build_release as apk-release
 * @jppm-task test_desktop as desktop-run
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
            Console::log('-> installing android extension ...');

            Tasks::run('add', [
                'jphp-android-ext'
            ]);
        }

        Console::log('-> install gradle ...');

        (new GradlePlugin($e))->install($e);

        Console::log("-> prepare jphp compiler ...");

        \php\lib\fs::makeDir('./.venity/');
        \php\lib\fs::makeFile('./.venity/compiler.jar');

        Stream::putContents('./.venity/compiler.jar', Stream::getContents("res://compiler.jar"));
    }

    public function generateBuild(string $file, array $androidData)
    {

	    Console::log('-> generate build.gradle file ...');

	$buildScript = "buildscript {
    repositories {
        jcenter()
    }
    dependencies {
        classpath 'org.javafxports:jfxmobile-plugin:1.3.10'
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
        compileSdkVersion  = {$androidData['sdk']}
        buildToolsVersion  = '{$androidData['sdk-tools']}'
        applicationPackage = '{$androidData['package-name']}'
    }
}

mainClassName = \"org.venity.jphp.ext.android.UXAndroidApplication\"";

        \php\io\Stream::putContents('./build.gradle', $buildScript);
    }

    public function gradle_build(string $task, Event $event)
    {
        $this->init($event);

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
            'java', '-jar', './.venity/compiler.jar',
            '--src', './build/out',
            '--dest', './build/compile.jar'
        ], './');

        $exit = $process->startAndWait()->getExitValue();

        // ->inheritIO()

        if ($exit != 0) {
            Console::log("[ERROR] Error compiling your хомно php code");
            return;
        } else
            Console::log(" -> done");

        $this->generateBuild('compile.jar', $androidData);
        
        Console::log('-> starting gradle ...');

        /** @var \php\lang\Process $process */
        $process = (new GradlePlugin($event))->gradleProcess([
            $task
        ])->inheritIO()->startAndWait();

        exit($process->getExitValue());
    }

    public function build_apk(Event $event)
    {
        $this->gradle_build('android', $event);
    }

    public function build_adb(Event $event)
    {
        $this->gradle_build('androidInstall', $event);
    }

    public function build_release(Event $event)
    {
        $this->gradle_build('androidRelease', $event);
    }

    public function test_desktop(Event $event)
    {
        $this->gradle_build('run', $event);
    }
}
