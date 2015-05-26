<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Field;
use AppBundle\Entity\GameBoard;
use AppBundle\Entity\Game;
use AppBundle\Entity\Task;
use AppBundle\Entity\Player;
use AppBundle\Entity\Person;

class DefaultController extends Controller
{
    /**
     * @Route("", name="homepage")
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl("NewGame"));
    }
    
    /**
     * @Route("/show/{id}", name="showBoard")
     */
    public function showAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $gameBoard = $em->getRepository("AppBundle:GameBoard")->find($em);
        if(!$gameBoard)
        {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }
        
        $em->remove($gameBoard);
        $em->flush();
        
        
        return $this->render("AppBundle:default:x.html.twig" );
    }
    
    /**
     * @Route("/new", name="newBoard")
     */
    public function newAction(Request $request)
    {
        
//        $game = new Game(["Kamil", "Michal"], 2);
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($game);
//        $em->flush();
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));
        
        $form = $this->createFormBuilder($task)
            ->add('task', 'text')
            ->add('dueDate', 'date')
            ->add('save', 'submit', array('label' => 'Create Task'))
            ->getForm();
            
        $form->handleRequest($request);
        
        if($form->isValid())
        {
            return $this->render("AppBundle:default:x.html.twig", array('form' => $form->createView(), 'task' => $task)); 
        }
        
        return $this->render("AppBundle:default:x.html.twig", array('form' => $form->createView(),));
        //return $this->redirect($this->generateUrl("showBoard", ["id" => $gameBoard->getId()]));
        
//        return $this->render("AppBundle:default:x.html.twig" );
    }
    
    /**
     * @Route("/NewGame", name="NewGame")
     */
    public function newGameAction(Request $request)
    {
        $game = new Game();
        $form = $this->createFormBuilder($game)
                ->add('name', 'text')
                ->add('New', 'submit')
                ->getform();
    
        $form->handleRequest($request);
        
        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();
            
            $game = $this->getDoctrine()->getRepository("AppBundle:game")->findOneBy(['name' => $game->getName()]);
            
            return $this->redirect($this->generateUrl("newPlayer", ['gameId' => $game->getId()]));
        }
        
        return $this->render("AppBundle:default:index.html.twig", ['form' => $form->createView()]);
    }

    /**
     * @Route("/Game/{gameId}/NewPlayer", name="newPlayer")
     */
    public function newPlayerAction(Request $request, $gameId)
    {
        $em = $this->getDoctrine()->getManager();
        
        $game = $this->loadGame($gameId);
        
        $player = new Person();
        $form = $this->createFormBuilder($player)
                ->add('name', 'text')
                ->add('Dodaj', 'submit')
                ->getForm();
        $form->handleRequest($request);
        
        if($form->isValid())
        {
            $game->addPlayer($player->getName());
            $em->persist($game);
            $em->flush();
            
            $session = $this->getRequest()->getSession();
            $session->set(0, $player->getName());
            
            return $this->redirect($this->generateUrl("newPlayer", ['gameId' => $gameId]));
        }
        
        
        return $this->render("AppBundle:default:AddPlayer.html.twig", ['form' => $form->createView(), 'game' => $game]);
    }
    
    /**
     * @Route("/Game/{gameId}/Play", name="game")
     */
    public function playGameAction(Request $request, $gameId)
    {
        $game = $this->loadGame($gameId);
        $session = $this->getRequest()->getSession();
        
        for($i = 0; $i < count($game->players); $i++)   
        {
            if($game->players[$i]->getname() == $game->getcurrentPlayer()->getname())
            {
                $form = $this->createFormBuilder()
                ->add('Wykonaj ruch', 'submit')
                ->getForm();
                $form->handleRequest($request);
                if($form->isValid())
                {
                    
                    return $this->redirect($this->generateUrl("game", ['gameId' => $gameId, 'form' => $form->createView(), 'move' => true]));
                }
                return $this->render("AppBundle:default:Game.html.twig", ['move' => true, 'form' => $form->createView(), 'data' => $game]);
            }
        }
        
        
        return $this->render("AppBundle:default:Game.html.twig", ['move' => false, 'data' => $game]);
    }
    
    public function loadGame($gameId)
    {
        $game = $this->getDoctrine()->getRepository("AppBundle:Game")->findOneBy(['id' => $gameId]);
        
        if(!$game)
        {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }
        
        return $game;
    }
    
}
    