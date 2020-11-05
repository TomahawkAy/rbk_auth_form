<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AddUserCommand extends Command
{
    protected static $defaultName = 'app:add:user';
    protected $encoder;
    protected $manager;
    public function  __construct($name = null,UserPasswordEncoderInterface $e,EntityManagerInterface $manager)
    {
        parent::__construct($name);
        $this->encoder = $e;
        $this->manager = $manager;
    }
    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = new User();
        $password = 'test';
        $user->setUsername('falt');
        $user->setRoles(array('ROLE_USER'));
        $user->setPassword($this->encoder->encodePassword($user,$password));
        $this->manager->persist($user);
        $this->manager->flush();
        return Command::SUCCESS;
    }
}
