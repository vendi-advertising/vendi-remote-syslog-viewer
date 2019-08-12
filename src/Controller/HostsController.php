<?php

namespace App\Controller;

use App\Constants\SyslogFacilities;
use App\Constants\SyslogPriorities;
use App\Repository\SyslogEventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class HostsController extends AbstractController
{
    private $syslogEventRepository;

    public function __construct(SyslogEventRepository $syslogEventRepository)
    {
        $this->syslogEventRepository = $syslogEventRepository;
    }

    /**
     * @Route("/hosts", name="hosts")
     */
    public function index()
    {
        $hosts = $this
            ->syslogEventRepository
            ->getAllUniqueHosts()
        ;

        return $this->render('hosts/index.html.twig', [
            'hosts' => $hosts,
        ]);
    }

    /**
     * @Route("/hosts/{hostname}", name="single_host_info", requirements={"hostname"=".+"})
     */
    public function host_details(string $hostname, Request $request)
    {

        $criteria = [
            'FromHost' => $hostname,
        ];

        $facilities = $request->query->get('facility');
        if($facilities){
            $criteria['Facility'] = array_values($facilities);
        }else{
            $facilities = [];
        }

        $priorities = $request->query->get('priority');
        if($priorities){
            $priorities = array_values($priorities);
        }else{
            $priorities = [0, 1, 2, 3, 4];
        }

        $criteria['Priority'] = $priorities;

        return $this->render('hosts/single_host_info.html.twig', [
            'events' => $this->syslogEventRepository->findBy($criteria),
            'all_facilities' => SyslogFacilities::get_all(),
            'all_priorities' => SyslogPriorities::get_all(),
            'selected_facilities' => array_values($facilities),
            'selected_priorities' => array_values($priorities),
        ]);
    }
}
