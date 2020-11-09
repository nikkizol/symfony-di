<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Capitalize;
use App\Entity\Master;
use App\Entity\Dash;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class SimpleController extends AbstractController
{
    /**
     * @Route("/", name="simple")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $message = '';
        if ($request->request->get('message')) {
            $message = $request->request->get('message');
        }

        if ($request->request->get('method') == 'Capitalize') {
            $transform = new Capitalize();
        } else {
            $transform = new Dash();
        }

        $logger = new Logger('Master');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../../log/log.info', Logger::INFO));

        $master = new Master($message, $transform, $logger);
        $transformedMessage = $master->getMessage();
        return $this->render('simple/index.html.twig', [
            'message' => $transformedMessage
        ]);

    }


}
