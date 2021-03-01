<?php

declare(strict_types=1);

namespace InpsydeUsers;

use Mockery;
use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Brain\Monkey;
use Brain\Monkey\Actions;
use Brain\Monkey\Functions;

class AdminTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    protected function setUp(): void
    {
        parent::setUp();
        Monkey\setUp();
    }

    public function testInit()
    {
        Actions\expectAdded('admin_menu')->atLeast()->once();
        Actions\expectAdded('admin_init')->atLeast()->once();

        (new Admin())->__construct();
    }

    protected function tearDown(): void
    {
        Monkey\tearDown();
        parent::tearDown();
        Mockery::close();
    }
}
