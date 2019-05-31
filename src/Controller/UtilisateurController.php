<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Pari;
use App\Entity\InfoPari;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Repository\MatcheRepository;
use App\Form\PariInformationsType;
use Symfony\Component\HttpFoundation\Session\Session;
use \ParagonIE\Halite\KeyFactory;
use \ParagonIE\Halite\HiddenString;
use \ParagonIE\Halite\Symmetric\Crypto;
use \ParagonIE\Halite\Asymmetric\EncryptionPublicKey;
use \ParagonIE\Halite\Cookie;
use App\Service\MessageGenerator;
use App\Entity\People;
use App\Form\PeopleType;
use Doctrine\Common\Persistence\ObjectManager;
use \Exception;
class UtilisateurController extends AbstractController
{

     /**
     * @Route("/forgot", name="forgot_password")
     */
    
    


    /**
     * @Route("/create_user", name="create_user")
     */
    public function createUser(Request $request, ObjectManager $manager, UserRepository $repo){
        /**
         *cryptage des données 
         *envoie de mail
         */
        $people = new People();
        $form = $this->createForm(PeopleType::class, $people);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user->setIsAdmin(false);
            $manager->persist($user);
            $manager->flush();
            
        return $this->redirectToRoute('home');
        }

        return $this->render('utilisateur/create_user.html.twig',[
            'formulaire' => $form->createView()
        ]);
    }
    /**
     * @Route("/user/match_ouverts", name="match_ouverts")
     * @Route("/user/match_ouverts/{succ}", name="pari_success")
     */
    public function parisOuverts(MatcheRepository $repos, $succ = null){
        $matchs = $repos->findAll();
        $success = ($succ != null)? "paris efectue avec succes" : "";
        return  $this->render('utilisateur/parisOuverts.html.twig',[
            'matchs' => $matchs, 'success' => $success
        ]);
    }

    /**
     * @Route("user/parier/{id}", name="parier")
     */
    public function parier(Request $request, $id, MatcheRepository $repoMatch, UserRepository $reposPari){
        $match = $repoMatch->find($id);
        $pariInfo = new InfoPari();
        $form = $this->createFormBuilder($pariInfo)
                ->add('verdict', ChoiceType::class, [
                    'choices'=>[
                        $match->getEquipe1() => $match->getEquipe1(),
                        $match->getEquipe2() => $match->getEquipe2(),
                        'null' => 'null'
                    ],
                ])
                ->add('montant')
                ->getForm();

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            if($pariInfo->getMontant()>0){
                $user = $reposPari->findOneBy(['login' => $request->getSession()->get('login')]);
                $pari = new Pari();
                $pari->setParieur($user)
                     ->setMatche($match)
                     ->setVainqueur($pariInfo->getVerdict())
                     ->setMontant($pariInfo->getMontant())
                     ->setGain(0);
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($pari);
                $manager->flush();
                   return  $this->redirectToRoute('pari_success',array('succ' => "success"));
            }
            return  $this->render('utilisateur/parisOuverts.html.twig',[
                'formInfoPari' => $form->createView(),'match' => $match, "error" => "vous devez choisir un verdict et saisir un montant poisitif"
            ]);
        }
        return  $this->render('utilisateur/parisOuverts.html.twig',[
            'formInfoPari' => $form->createView(), 'match'=> $match
        ]);
    }
     /**
     * @Route("/user/mes_paris", name="mes_paris")
     */
    public function mesParis(){
        return  $this->render('utilisateur/mesParis.html.twig');
    }

     /**
     * @Route("/user/deconnexion", name="deconnexion")
     */
    public function deconnexion(){
        return  $this->redirectToRoute('home');
    }

    /**
     * @Route("user/menu", name="menu")
     */
    public function menu(){
        return  $this->render('utilisateur/menuUser.html.twig');
    }

    /**
     * @Route("/confirm_pass", name="confirm")
     */

    public function confirm(Request $request){
        $query = $request->query->all();
        dump($query);
        throw new Exception("je suiskn");
    }

    /**
     * @Route("/{param}", name="home")
     
     */
    public function home($param = null, Request $request, UserRepository $repo, MessageGenerator $message,\Swift_Mailer $mailer)
    {
        
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $user_test = $repo->findOneBy(['login'=> $user->getLogin(), 'password'=>$user->getPassword()]);
            if($user_test !=null){
                $request->getSession()->set('login',$user->getLogin());
                return $this->redirectToRoute('menu');
            }else{
                return $this->render('home.html.twig', [
                    'formulaire' => $form->createView(), 'error' => "login ou mot de passe incorrect",
                ]); 
            }
        }
        return $this->render('home.html.twig', [
            'formulaire' => $form->createView(), 
            'message_send' => $param,
        ]); 
    }

}
