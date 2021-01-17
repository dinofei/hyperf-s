<?php

declare(strict_types=1);

namespace App\Command;

use Psr\Container\ContainerInterface;
use Hyperf\Command\Annotation\Command;
use Hyperf\Devtool\Generator\GeneratorCommand;

/**
 * @Command
 */
class RepoCommand extends GeneratorCommand
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        parent::__construct('gen:repo');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('创建模型仓库类');
    }

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/repo.stub';
    }

    protected function getDefaultNamespace(): string
    {
        return $this->getConfig()['namespace'] ?? 'App\\Repo';
    }
}
