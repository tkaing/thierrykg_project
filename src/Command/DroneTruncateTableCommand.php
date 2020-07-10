<?php

namespace App\Command;

use App\Entity\DroneUser;
use App\Entity\DroneSession;
use App\Entity\DroneSessionDetails;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DroneTruncateTableCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'run:drone-truncate-table';

    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a new user.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create a user...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /*$cmd = $this->manager->getClassMetadata(DroneUser::class);
        $connection = $this->manager->getConnection();
        $dbPlatform = $connection->getDatabasePlatform();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $q = $dbPlatform->getTruncateTableSql($cmd->getTableName());
        $connection->executeUpdate($q);
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
        $output->writeln('Drone: User successfully truncated!');*/

        $cmd = $this->manager->getClassMetadata(DroneSession::class);
        $connection = $this->manager->getConnection();
        $dbPlatform = $connection->getDatabasePlatform();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $q = $dbPlatform->getTruncateTableSql($cmd->getTableName());
        $connection->executeUpdate($q);
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
        $output->writeln('Drone: Session successfully truncated!');

        $cmd = $this->manager->getClassMetadata(DroneSessionDetails::class);
        $connection = $this->manager->getConnection();
        $dbPlatform = $connection->getDatabasePlatform();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $q = $dbPlatform->getTruncateTableSql($cmd->getTableName());
        $connection->executeUpdate($q);
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
        $output->writeln('Drone: Session Details successfully truncated!');

        return 0;
    }
}