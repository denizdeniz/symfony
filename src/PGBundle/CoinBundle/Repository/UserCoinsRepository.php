<?php

namespace App\PGBundle\CoinBundle\Repository;

use App\PGBundle\CoinBundle\Entity\UserCoins;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserCoins|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCoins|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCoins[]    findAll()
 * @method UserCoins[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCoinsRepository extends ServiceEntityRepository
{
	protected $entityManager;
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserCoins::class);
        $this->entityManager = $this->getEntityManager();
    }

    public function addAmount($username, $amount){

    	 $userCoins = new UserCoins();

    	 $userCoins->setUsername($username);
    	 $userCoins->setBalance($amount);

    	 $this->entityManager->persist($userCoins);

    	 $this->entityManager->flush();
    }

    public function updateAmount($username, $amount){


    	$userCoins = $this->entityManager->getRepository(UserCoins::class)->findOneBy(["username" => $username]);
    	$balance = $userCoins->getBalance();
    	$amount += $balance;
    	$userCoins->setBalance($amount);
    	$this->entityManager->flush();

    	return $amount;
    }


}
