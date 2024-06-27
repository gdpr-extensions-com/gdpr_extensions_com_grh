<?php

declare(strict_types=1);

namespace GdprExtensionsCom\GdprExtensionsComGrh\Tests\Unit\Domain\Model;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 */
class gdprgoogle_reviewsliderTest extends UnitTestCase
{
    /**
     * @var \GdprExtensionsCom\GdprExtensionsComGrh\Domain\Model\gdprgoogle_reviewslider|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \GdprExtensionsCom\GdprExtensionsComGrh\Domain\Model\gdprgoogle_reviewslider::class,
            ['dummy']
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function dummyTestToNotLeaveThisFileEmpty(): void
    {
        self::markTestIncomplete();
    }
}
