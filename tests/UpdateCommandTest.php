<?php

namespace Orchestra\DuskUpdater\Tests;

use PHPUnit\Framework\TestCase;
use Orchestra\DuskUpdater\UpdateCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class UpdateCommandTest extends TestCase
{
    /** @test */
    public function it_can_update_to_specific_version()
    {
        $app = new Application('Dusk Updater', '1.0.0');
        $app->add(new UpdateCommand());

        $command = $app->find('update');

        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName(),
            'version' => '73.0.3683.68',
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString("ChromeDriver binary successfully installed for version 73.0.3683.68.\n", $output);
    }

    /** @test */
    public function it_can_update_to_major_version()
    {
        $app = new Application('Dusk Updater', '1.0.0');
        $app->add(new UpdateCommand());

        $command = $app->find('update');

        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName(),
            'version' => '74',
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString("ChromeDriver binary successfully installed for version 74", $output);
    }
}
