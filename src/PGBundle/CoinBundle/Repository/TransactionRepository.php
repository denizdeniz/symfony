<?php

namespace App\PGBundle\CoinBundle\Repository;

use App\PGBundle\CoinBundle\Entity\Transaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Transaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transaction[]    findAll()
 * @method Transaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransactionRepository extends ServiceEntityRepository
{
	protected $entityManager;
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Transaction::class);
        $this->entityManager = $this->getEntityManager();

    }

    public function addTransaction($username, $amount, $hash){

	    $transaction = new Transaction();
	    $transaction->setUsername($username);
	    $transaction->setHash($hash);
	    $transaction->setAmount($amount);

	    $this->entityManager->persist($transaction);

	    $this->entityManager->flush();
    }

    public function getTransactionAmount($hash){

    	$transaction = $this->entityManager->getRepository(Transaction::class)->findOneBy(["hash" => $hash]);
    	return $transaction;
    }


}
