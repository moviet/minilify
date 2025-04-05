<?php
class JSTest extends Base
{
    /** TESTS WITH ONE FILE **/

    public function testPackOneDefaultRelative()
    {
        $file = $this->Minis->js('/resources/js/scripts-1.js', 'js/scripts-1.js')->getFilePath();

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1']);

        unlink($file);

        $file = $this->cache.'/js/scripts-1.js';

        $this->assertFileNotExists($file, sprintf('File %s not exists', $file));
    }

    public function testPackOneDefaultAbsolute()
    {
        $file = $this->Minis->js('/resources/js/scripts-1.js', '/cache/js/scripts-1.js')->getFilePath();

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1']);

        unlink($file);

        $file = $this->cache.'/js/scripts-1.js';

        $this->assertFileNotExists($file, sprintf('File %s not exists', $file));
    }

    public function testPackOneNoTimestampRelative()
    {
        $this->Minis->setConfig(['check_timestamps' => false]);

        $this->Minis->js('/resources/js/scripts-1.js', 'js/scripts-1.js');

        $file = $this->cache.'/js/scripts-1.js';

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1']);

        unlink($file);

        $this->Minis->setConfig(['check_timestamps' => true]);
    }

    public function testPackOneNoTimestampAbsolute()
    {
        $this->Minis->setConfig(['check_timestamps' => false]);

        $this->Minis->js('/resources/js/scripts-1.js', '/cache/js/scripts-1.js');

        $file = $this->cache.'/js/scripts-1.js';

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1']);

        unlink($file);

        $this->Minis->setConfig(['check_timestamps' => true]);
    }

    public function testPackOneAutonameRelative()
    {
        $file = $this->Minis->js('/resources/js/scripts-1.js', 'js/')->getFilePath();

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1']);

        unlink($file);
    }

    public function testPackOneAutonameAbsolute()
    {
        $file = $this->Minis->js('/resources/js/scripts-1.js', '/cache/js/')->getFilePath();

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1']);

        unlink($file);
    }

    /** TESTS WITH MULTIPLE FILES **/

    public function testPackMultipleDefaultRelative()
    {
        $file = $this->Minis->js([
            '/resources/js/scripts-1.js',
            '/resources/js/scripts-2.js'
        ], 'js/scripts.js')->getFilePath();

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1', '_TEST_INI_FILE2', '_TEST_END_FILE2']);

        unlink($file);

        $file = $this->cache.'/js/scripts.js';

        $this->assertFileNotExists($file, sprintf('File %s not exists', $file));
    }

    public function testPackMultipleDefaultAbsolute()
    {
        $file = $this->Minis->js([
            '/resources/js/scripts-1.js',
            '/resources/js/scripts-2.js'
        ], '/cache/js/scripts.js')->getFilePath();

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1', '_TEST_INI_FILE2', '_TEST_END_FILE2']);

        unlink($file);

        $file = $this->cache.'/js/scripts.js';

        $this->assertFileNotExists($file, sprintf('File %s not exists', $file));
    }

    public function testPackMultipleNoTimestampRelative()
    {
        $this->Minis->setConfig(['check_timestamps' => false]);

        $file = $this->Minis->js([
            '/resources/js/scripts-1.js',
            '/resources/js/scripts-2.js'
        ], 'js/scripts.js');

        $file = $this->cache.'/js/scripts.js';

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1', '_TEST_INI_FILE2', '_TEST_END_FILE2']);

        unlink($file);

        $this->Minis->setConfig(['check_timestamps' => true]);
    }

    public function testPackMultipleNoTimestampAbsolute()
    {
        $this->Minis->setConfig(['check_timestamps' => false]);

        $file = $this->Minis->js([
            '/resources/js/scripts-1.js',
            '/resources/js/scripts-2.js'
        ], '/cache/js/scripts.js');

        $file = $this->cache.'/js/scripts.js';

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1', '_TEST_INI_FILE2', '_TEST_END_FILE2']);

        unlink($file);

        $this->Minis->setConfig(['check_timestamps' => true]);
    }

    public function testPackMultipleAutonameRelative()
    {
        $file = $this->Minis->js([
            '/resources/js/scripts-1.js',
            '/resources/js/scripts-2.js'
        ], 'js/')->getFilePath();

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1', '_TEST_INI_FILE2', '_TEST_END_FILE2']);

        unlink($file);
    }

    public function testPackMultipleAutonameAbsolute()
    {
        $file = $this->Minis->js([
            '/resources/js/scripts-1.js',
            '/resources/js/scripts-2.js'
        ], '/cache/js/')->getFilePath();

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1', '_TEST_INI_FILE2', '_TEST_END_FILE2']);

        unlink($file);
    }

    public function testPackMultipleLocal()
    {
        $this->Minis->setConfig(['environment' => 'local']);

        $packed = $this->Minis->js([
            '/resources/js/scripts-1.js',
            '/resources/js/scripts-2.js'
        ], 'js/');

        $file = $packed->getFilePath();

        $this->assertFileNotExists($file, sprintf('File %s not exists', $file));

        $this->assertTrue(substr_count($packed->render(), '</script>') === 2, 'Local environment get 2 tags to original files');

        $this->Minis->setConfig(['environment' => 'testing']);
    }

    /** TESTS DIRECTORY **/

    public function testPackDirectoryDefaultRelative()
    {
        $file = $this->Minis->jsDir('/resources/js/', 'js/all.js')->getFilePath();

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1', '_TEST_INI_FILE2', '_TEST_END_FILE2']);

        unlink($file);

        $file = $this->cache.'/js/all.js';

        $this->assertFileNotExists($file, sprintf('File %s not exists', $file));
    }

    public function testPackDirectoryDefaultAbsolute()
    {
        $file = $this->Minis->jsDir('/resources/js/', '/cache/js/all.js')->getFilePath();

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1', '_TEST_INI_FILE2', '_TEST_END_FILE2']);

        unlink($file);

        $file = $this->cache.'/js/all.js';

        $this->assertFileNotExists($file, sprintf('File %s not exists', $file));
    }

    public function testPackDirectoryNoTimestampRelative()
    {
        $this->Minis->setConfig(['check_timestamps' => false]);

        $this->Minis->jsDir('/resources/js/', 'js/all.js');

        $file = $this->cache.'/js/all.js';

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1', '_TEST_INI_FILE2', '_TEST_END_FILE2']);

        unlink($file);

        $this->Minis->setConfig(['check_timestamps' => true]);
    }

    public function testPackDirectoryNoTimestampAbsolute()
    {
        $this->Minis->setConfig(['check_timestamps' => false]);

        $this->Minis->jsDir('/resources/js/', '/cache/js/all.js');

        $file = $this->cache.'/js/all.js';

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1', '_TEST_INI_FILE2', '_TEST_END_FILE2']);

        unlink($file);

        $this->Minis->setConfig(['check_timestamps' => true]);
    }

    public function testPackDirectoryAutonameRelative()
    {
        $file = $this->Minis->jsDir('/resources/js/', 'js/')->getFilePath();

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1', '_TEST_INI_FILE2', '_TEST_END_FILE2']);

        unlink($file);
    }

    public function testPackDirectoryAutonameAbsolute()
    {
        $file = $this->Minis->jsDir('/resources/js/', '/cache/js/')->getFilePath();

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1', '_TEST_INI_FILE2', '_TEST_END_FILE2']);

        unlink($file);
    }

    public function testPackDirectoryAutonameAbsoluteRecursive()
    {
        $file = $this->Minis->jsDir('/resources/', '/cache/js/', true)->getFilePath();

        $this->assertFileExists($file, sprintf('File %s was created successfully', $file));

        $this->checkContents($file, ['_TEST_INI_FILE1', '_TEST_END_FILE1', '_TEST_INI_FILE2', '_TEST_END_FILE2']);

        unlink($file);
    }
}
