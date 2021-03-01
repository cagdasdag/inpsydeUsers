<?php

declare(strict_types=1);

namespace InpsydeUsers;

use Mockery;
use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Brain\Monkey;
use Brain\Monkey\Actions;
use Brain\Monkey\Functions;

class FrontTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    protected function setUp(): void
    {
        parent::setUp();
        Monkey\setUp();
    }

    public function testInit()
    {
        Actions\expectAdded('wp_ajax_getUserDetail')->atLeast()->once();
        Actions\expectAdded('wp_ajax_nopriv_getUserDetail')->atLeast()->once();

        (new Front())->__construct();
    }

    public function testTemplatePathList()
    {

        Functions\expect('get_template_directory')
            ->once()
            ->andReturn('themeurl');
        define('INPSYDE_DIR_PATH', 'test/');

        $front = new Front();
        $templatePaths = $front->templatePathList();

        // Check is template path set correctly
        self::assertIsArray($templatePaths);
        self::assertArrayHasKey('userTable', $templatePaths);
        self::assertArrayHasKey('userDetails', $templatePaths);
        self::assertNotEmpty($templatePaths['userTable']['path']);
        self::assertNotEmpty($templatePaths['userDetails']['path']);
    }

    protected function tearDown(): void
    {
        Monkey\tearDown();
        parent::tearDown();
        Mockery::close();
    }
}
