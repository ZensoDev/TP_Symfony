<?php

namespace MediaRemoteBundle\Controller\Admin;

use MediaRemoteBundle\Entity\MediaRemote;
use MediaRemoteBundle\Entity\Remote;
use MediaRemoteBundle\Form\RemoteType;
use Proxies\__CG__\MediaRemoteBundle\Entity\Media;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;


class RemoteController extends Controller
{

    /**
     * @param string $name
     * @throws NotFoundHttpException
     * @return array
     */
    private function getMediaRemote($name): array
    {
        if (!($mediaRemote = $this->getDoctrine()
            ->getManager()
            ->getRepository(MediaRemote::class)
            ->findByRemoteName($name))) {
            throw new NotFoundHttpException("Remote not found");
        }
        return $mediaRemote;


    }


    /**
     * @Route("/remote", name="remote")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction(Request $request)
    {
        return $this->redirectToRoute("remote_get", [
            "remote_name" => $this->getDoctrine()
                ->getManager()
                ->getRepository(MediaRemote::class)
//                ->findOneBy(["remoteName" => $request->get("remote_name")]);
                ->findDefaultRemoteName()
        ]);

    }

    /**
     * @Route("/remote/{remote_name}",
     *      name="remote_get",     *
     * requirements={"remote_name"="[A-Za-z]{3,32}"},
     *     methods="GET"
     *     )
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function getAction(Request $request)
    {
        $etag = md5($request->getUri());
        dump($request->getETags());
        dump($etag);
        if (!$this->get("session")->getFlashBag()->get("switch")){
            $response = new Response();
            $response->setNotModified();
            return $response;
        }


        // La clef c'est une partie de l'id de l'item
        $key = md5($request->get("remote_name"));
        //Le cache c'est le dossier pool
        $cache = $this->get('cache.app');
        //L'item c'est le fichier dans pool
        $item = $cache->getItem($key); //c'est le fichier dans le cache
        //On vérifie que la donnée est accessible
        if (!$item->isHit()){
            dump("pas de cache");
            //on recherche la donnée dans la BDD
            $mediaRemote = $this->getMediaRemote($request->get("remote_name"));
            //on met la donnée dans le fichier
            $item->set($mediaRemote);
            //On sauvegarde le fichier
            $cache->save($item);
            //Sinon on récupère la donnée depuis l'item
        } else {
            dump("du cache");
            $mediaRemote = $item->get();

            //reveiller les proxies morts
            foreach ($mediaRemote as $value){
                $value->setMedia(
                  $this->getDoctrine()->getManager()->merge($value->getMedia())
                );
            }
        }

        //obtenir la liste

        $response = $this->render('@MediaRemote/Remote/index.html.twig', array(
            "mediaRemote" => $mediaRemote,
            "form" => $this->get("form.factory")->create(RemoteType::class, $mediaRemote[0]->getRemote())->createView()
        ));
        $response->setEtag($etag);
        return $response;
    }


    /**
     * @Route("/remote/{remote_name}",
     *      name="remote_post",     *
     * requirements={"remote_name"="^[A-Z]{1}[a-z]{2,15}$"},
     *     methods="POST"
     *     )
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function postAction(Request $request)
    {

        $this->get("cache.app")
            ->deleteItem(md5($request->get("remote_name")));

        //obtenir la liste
        $mediaRemote = $this->getMediaRemote($request->get("remote_name"));
        $form = $this->get("form.factory")->create(RemoteType::class, $mediaRemote[0]->getRemote());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //dump("je veux traiter l'info");
            try {
                $this->getDoctrine()->getManager()->flush();
                $response = $this->redirectToRoute("remote_get", ["remote_name"
                => $mediaRemote[0]->getRemote()->getRemoteName()]);
                $response->setEtag(null);
                return $response;
            } catch (Throwable $e) {
                $form->addError(new FormError("name.exists"));
            }
        }
        return $this->render('@MediaRemote/Remote/index.html.twig', array(
            "mediaRemote" => $mediaRemote,
            "form" => $form->createView()
        ));

    }

}
