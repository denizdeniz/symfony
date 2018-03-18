<?php

namespace App\PGBundle\CoinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\PGBundle\CoinBundle\Entity\UserCoins;
use App\PGBundle\CoinBundle\Entity\Transaction;

use App\Entity\User;


use Psr\Log\LoggerInterface;

class IndexController extends Controller
{
    public function renderIndexAction()
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $username = $user->getUsername();
        $userCoins = $this->getDoctrine()->getRepository(UserCoins::class)->findOneBy(["username" => $username]);
        $balance = 0;

        if($userCoins)
            $balance = $userCoins->getBalance();

        return $this->render('coin/index.html.twig', array('coins' => $balance));

    }

    /**
    * @return \Symfony\Component\HttpFoundation\JsonResponse
    * @Route("/buy")

    */
    public function buyCoinAction(Request $request,LoggerInterface $logger)
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();
        if(!is_object($user)){
            return new JsonResponse(['error' => 'Please login first!'], 400);
        }
        $username = $user->getUsername();

        $hash = hash('sha1',$this->generateRandomString());

        $newBalance = $amount = $request->request->get('amount');

        $transaction = $this->getDoctrine()->getRepository(Transaction::class)->addTransaction($username,$newBalance, $hash);

        $entityManager = $this->getDoctrine()->getManager();

        $userCoins = $entityManager->getRepository(UserCoins::class)->findOneBy(["username" => $username]);

        if (!$userCoins) {
            $userCoins = $this->getDoctrine()->getRepository(UserCoins::class)->addAmount($username,$newBalance);
        }else{
            $newBalance = $this->getDoctrine()->getRepository(UserCoins::class)->updateAmount($username,$newBalance);
        }

        $logger->info($username." bought $amount coins with the $hash.");

        return new JsonResponse(['hash' => $hash,'balance' => round($newBalance,2)]);

   }
    /**
    * @return \Symfony\Component\HttpFoundation\JsonResponse
    * @Route("/validate")
    */
    public function verifyAction(Request $request)
    {
        $hash = $request->request->get('hash');
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $transaction = $this->getDoctrine()->getRepository(Transaction::class)->getTransactionAmount($hash);
        if(!$transaction){
            return new JsonResponse(['status' =>false, 'error' => 'Invalid hash supplied!'], 400);
        }
        return new JsonResponse(['amount' => $transaction->getAmount()]);

    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        list($usec, $sec) = explode(' ', microtime());
        srand($sec + $usec * 1000000);
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}